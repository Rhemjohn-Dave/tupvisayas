<?php

namespace App\Services;

use App\Models\AdmissionTestSchedule;
use App\Models\CollegePage;
use App\Models\Course;
use App\Models\EmaiUnansweredLog;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class EmaiFaqService
{
  public function __construct(
    private readonly EmaiAiService $ai,
  ) {}

  /**
   * @return array{answer: string, question: ?string, confidence: float, links: list<array{label: string, url: string}>, matched: bool, source?: string}
   */
  public function answer(string $message, ?Request $request = null): array
  {
    $normalized = $this->normalize($message);
    $ranked = $this->rankedFaqs($normalized);
    $best = $ranked[0] ?? null;
    $bestScore = $best['score'] ?? 0.0;
    $minScore = (float) config('emai.ai.min_faq_score', 1.5);

    if ($best && $bestScore >= $minScore && $this->faqCoversIntent($normalized, $best['faq'])) {
      $faq = $best['faq'];

      return [
        'answer' => (string) $faq['answer'],
        'question' => (string) ($faq['question'] ?? ''),
        'confidence' => round(min($bestScore / 8, 1), 2),
        'links' => $this->resolveLinks($faq['links'] ?? []),
        'matched' => true,
        'source' => 'faq',
      ];
    }

    $contextFaqs = array_map(
      fn (array $row) => $row['faq'],
      array_slice($ranked, 0, (int) config('emai.ai.context_faqs', 8)),
    );

    // Prefer board-rating FAQs in AI context when the visitor asks about PRC/board results.
    if ($this->mentionsBoardRatings($normalized)) {
      $boardFaqs = array_values(array_filter(
        $this->allFaqs(),
        fn (array $faq) => ($faq['category'] ?? '') === 'board_ratings'
          || str_contains((string) ($faq['id'] ?? ''), 'board'),
      ));
      $contextFaqs = array_slice(array_merge($boardFaqs, $contextFaqs), 0, 10);
    }

    $aiResult = $this->ai->answer($message, $contextFaqs);
    if ($aiResult) {
      $links = $this->aiLinksFor($normalized, $best['faq'] ?? null);

      return [
        'answer' => $aiResult['answer'],
        'question' => null,
        'confidence' => 0.45,
        'links' => $links,
        'matched' => true,
        'source' => 'ai',
      ];
    }

    $this->logUnanswered($message, $request);

    return [
      'answer' => (string) config('emai.fallback'),
      'question' => null,
      'confidence' => 0.0,
      'links' => [
        $this->link('Admission procedure', 'admissions.enrollment'),
        $this->link('Contact', 'contact'),
      ],
      'matched' => false,
      'source' => 'fallback',
    ];
  }

  /**
   * @return list<array{faq: array<string, mixed>, score: float}>
   */
  private function rankedFaqs(string $normalized): array
  {
    $ranked = [];

    foreach ($this->allFaqs() as $faq) {
      $score = $this->score($normalized, $faq);
      if ($score <= 0) {
        continue;
      }
      $ranked[] = ['faq' => $faq, 'score' => $score];
    }

    usort($ranked, fn (array $a, array $b) => $b['score'] <=> $a['score']);

    return $ranked;
  }

  /**
   * @return list<array<string, mixed>>
   */
  public function allFaqs(): array
  {
    return array_merge(
      config('emai.faqs', []),
      $this->dynamicFaqs(),
    );
  }

  /**
   * @return list<array<string, mixed>>
   */
  private function dynamicFaqs(): array
  {
    try {
      return Cache::remember('emai.dynamic_faqs', 3600, function () {
        return array_merge(
          $this->contactFaqs(),
          $this->scheduleFaqs(),
          $this->collegeProgramFaqs(),
          $this->courseFaqs(),
          $this->boardExamFaqs(),
          $this->officialFaqs(),
        );
      });
    } catch (\Throwable $e) {
      report($e);

      return [];
    }
  }

  public static function clearCache(): void
  {
    Cache::forget('emai.dynamic_faqs');
  }

  /**
   * @return list<array<string, mixed>>
   */
  private function contactFaqs(): array
  {
    $contact = config('emai.contact', []);
    if ($contact === []) {
      return [];
    }

    $answer = implode(' ', array_filter([
      'Campus address: '.($contact['address'] ?? ''),
      'Telephone: '.($contact['phone'] ?? ''),
      isset($contact['website']) ? 'Website: '.$contact['website'] : null,
      isset($contact['admissions_email']) ? 'Admissions email: '.$contact['admissions_email'] : null,
      isset($contact['uitc_email']) ? 'UITC: '.$contact['uitc_email'] : null,
      isset($contact['transparency_email']) ? 'Transparency: '.$contact['transparency_email'] : null,
    ]));

    return [[
      'id' => 'dynamic-contact',
      'question' => 'How can I contact TUP Visayas?',
      'answer' => trim($answer),
      'keywords' => ['contact', 'phone', 'telephone', 'email', 'address', 'location', 'where', 'call', 'office', 'talisay', 'map', 'campus phone', 'phone number', 'number'],
      'category' => 'campus',
      'links' => [
        ['label' => 'Contact page', 'route' => 'contact'],
        ['label' => 'Admissions', 'route' => 'admissions.enrollment'],
      ],
    ]];
  }

  /**
   * @return list<array<string, mixed>>
   */
  private function scheduleFaqs(): array
  {
    $schedules = AdmissionTestSchedule::query()->published()->ordered()->get();

    if ($schedules->isEmpty()) {
      return [[
        'id' => 'dynamic-tupstat-dates-empty',
        'question' => 'When is the TUPSTAT exam?',
        'answer' => 'Admission test dates are not published on the website yet. Check the Admissions page regularly or contact the Admissions Office for the latest TUPSTAT schedule.',
        'keywords' => ['tupstat date', 'exam date', 'test date', 'schedule', 'when is the exam', 'when is tupstat', 'when tupstat', 'tupstat when', 'admission test', 'testing date'],
        'category' => 'admissions',
        'links' => [
          ['label' => 'Admission procedure', 'route' => 'admissions.enrollment'],
          ['label' => 'Contact', 'route' => 'contact'],
        ],
      ]];
    }

    $lines = $schedules->map(function (AdmissionTestSchedule $schedule) {
      $times = implode(', ', $schedule->timeLines());
      $line = $schedule->displayDate();
      if ($times !== '') {
        $line .= ' at '.$times;
      }
      $line .= ' — '.$schedule->venue;
      if ($schedule->venue_note) {
        $line .= ' ('.$schedule->venue_note.')';
      }
      if ($schedule->address) {
        $line .= ', '.$schedule->address;
      }

      return $line;
    })->implode('; ');

    $first = $schedules->first();
    $last = $schedules->last();
    $range = $schedules->count() === 1
      ? $first->displayDate()
      : $first->displayDate().' to '.$last->displayDate();

    return [[
      'id' => 'dynamic-tupstat-dates',
      'question' => 'When is the TUPSTAT exam?',
      'answer' => 'Published TUPSTAT schedules ('.$range.'): '.$lines.'. Schedules may change—always confirm on the Admissions page or with the Admissions Office.',
        'keywords' => ['tupstat date', 'exam date', 'test date', 'schedule', 'when is the exam', 'when is tupstat', 'when tupstat', 'tupstat when', 'admission test', 'testing date', 'venue', 'exam schedule'],
      'category' => 'admissions',
      'links' => [
        ['label' => 'View admission schedules', 'route' => 'admissions.enrollment'],
      ],
    ]];
  }

  /**
   * @return list<array<string, mixed>>
   */
  private function collegeProgramFaqs(): array
  {
    $faqs = [];

    CollegePage::query()
      ->with(['courses' => fn ($q) => $q->orderBy('name')])
      ->orderBy('college')
      ->get()
      ->each(function (CollegePage $college) use (&$faqs) {
        if ($college->courses->isEmpty()) {
          return;
        }

        $slug = $college->routeSlug();
        $short = match ($slug) {
          'coe' => 'COE',
          'coet' => 'COET',
          'coac' => 'COAC',
          default => Str::upper($slug),
        };

        $programList = $college->courses->pluck('name')->implode('; ');

        $faqs[] = [
          'id' => 'dynamic-college-'.$slug,
          'question' => 'What programs does '.$college->college.' offer?',
          'answer' => $college->college.' offers: '.$programList.'.',
          'keywords' => [
            strtolower($short),
            strtolower($slug),
            strtolower($college->college),
            'programs in '.$short,
            'courses in '.$short,
            'what programs',
          ],
          'category' => 'academics',
          'links' => [
            ['label' => 'View '.$short, 'route' => 'academics.show', 'params' => ['college' => $slug]],
            ['label' => 'All undergraduate programs', 'route' => 'academics.undergraduate'],
          ],
        ];
      });

    return $faqs;
  }

  /**
   * @return list<array<string, mixed>>
   */
  private function courseFaqs(): array
  {
    $faqs = [];

    Course::query()
      ->with('collegePage')
      ->orderBy('name')
      ->get()
      ->each(function (Course $course) use (&$faqs) {
        $college = $course->collegePage;
        if (! $college) {
          return;
        }

        $slug = $college->routeSlug();
        $keywords = $this->courseKeywords($course->name);

        if ($course->hasSection('description')) {
          $excerpt = Str::limit(trim(strip_tags((string) $course->description)), 280);

          $faqs[] = [
            'id' => 'dynamic-course-'.$course->id,
            'question' => 'Tell me about '.$course->name,
            'answer' => $excerpt,
            'keywords' => $keywords,
            'category' => 'academics',
            'links' => [
              [
                'label' => 'Program details',
                'route' => 'academics.program',
                'params' => ['college' => $slug, 'course' => $course->slug],
              ],
            ],
          ];
        }

        if ($course->hasSection('board_performance')) {
          $excerpt = Str::limit(trim(strip_tags((string) $course->board_performance)), 500);

          $faqs[] = [
            'id' => 'dynamic-course-board-'.$course->id,
            'question' => 'What is the PRC / board exam performance of '.$course->name.'?',
            'answer' => $excerpt !== ''
              ? $excerpt
              : 'Board performance details for '.$course->name.' are being prepared. Check the program page and the official PRC website for the latest licensure results.',
            'keywords' => array_merge($keywords, [
              'prc', 'board', 'rating', 'ratings', 'licensure', 'passer', 'passers', 'board exam', 'board performance',
            ]),
            'category' => 'board_ratings',
            'links' => [
              [
                'label' => $course->name.' board performance',
                'route' => 'academics.program',
                'params' => ['college' => $slug, 'course' => $course->slug],
              ],
              [
                'label' => 'College page',
                'route' => 'academics.show',
                'params' => ['college' => $slug],
              ],
            ],
          ];
        }

        if ($course->hasSection('faq')) {
          foreach ($this->parseFaqHtml((string) $course->faq) as $index => $pair) {
            $faqs[] = [
              'id' => 'dynamic-course-faq-'.$course->id.'-'.$index,
              'question' => $pair['question'],
              'answer' => $pair['answer'],
              'keywords' => array_merge($keywords, $this->tokenize($pair['question'])),
              'category' => 'academics',
              'links' => [
                [
                  'label' => $course->name,
                  'route' => 'academics.program',
                  'params' => ['college' => $slug, 'course' => $course->slug],
                ],
              ],
            ];
          }
        }
      });

    return $faqs;
  }

  /**
   * @return list<array<string, mixed>>
   */
  private function officialFaqs(): array
  {
    return Official::query()
      ->with('collegePage')
      ->orderBy('order')
      ->get()
      ->map(function (Official $official) {
        $scope = $official->collegePage
          ? ' for '.$official->collegePage->college
          : ' at TUP Visayas';

        $keywords = array_merge(
          $this->tokenize($official->position),
          $this->tokenize($official->name),
          ['official', 'director', 'dean', 'campus head', 'leadership'],
        );

        if ($official->collegePage) {
          $keywords[] = strtolower($official->collegePage->routeSlug());
        }

        $links = [];
        if ($official->collegePage && Route::has('academics.show')) {
          $links[] = [
            'label' => $official->collegePage->college,
            'route' => 'academics.show',
            'params' => ['college' => $official->collegePage->routeSlug()],
          ];
        } else {
          $links[] = ['label' => 'Campus officials', 'route' => 'officials'];
        }

        return [
          'id' => 'dynamic-official-'.$official->id,
          'question' => 'Who is the '.$official->position.'?',
          'answer' => $official->name.' serves as '.$official->position.$scope.'.',
          'keywords' => $keywords,
          'category' => 'campus',
          'links' => $links,
        ];
      })
      ->all();
  }

  /**
   * @return list<array<string, mixed>>
   */
  private function boardExamFaqs(): array
  {
    $faqs = [];

    CollegePage::query()
      ->orderBy('college')
      ->get()
      ->each(function (CollegePage $college) use (&$faqs) {
        $slug = $college->routeSlug();
        $short = match ($slug) {
          'coe' => 'COE',
          'coet' => 'COET',
          'coac' => 'COAC',
          default => Str::upper($slug),
        };

        $raw = trim(strip_tags((string) $college->board_exam_ratings));
        $answer = $raw !== ''
          ? Str::limit($raw, 600)
          : $college->college.' board exam ratings are published on the college Board exam ratings tab when available. For national licensure standings, also check the official PRC website.';

        $faqs[] = [
          'id' => 'dynamic-college-board-'.$slug,
          'question' => 'What is the PRC board exam rating of '.$college->college.' / '.$short.'?',
          'answer' => $answer,
          'keywords' => [
            'prc',
            'board',
            'rating',
            'ratings',
            'licensure',
            'passer',
            'passers',
            'board exam',
            strtolower($short),
            strtolower($slug),
            strtolower($college->college),
            'electronics engineering',
            'electrical engineering',
            'mechanical engineering',
            'computer engineering',
          ],
          'category' => 'board_ratings',
          'links' => [
            ['label' => $short.' board ratings', 'route' => 'academics.show', 'params' => ['college' => $slug]],
          ],
        ];
      });

    return $faqs;
  }

  /**
   * Reject FAQ hits that ignore key intent words in the visitor question (e.g. PRC rating).
   *
   * @param  array<string, mixed>  $faq
   */
  private function faqCoversIntent(string $normalized, array $faq): bool
  {
    $intentTerms = [
      'prc', 'board', 'rating', 'ratings', 'licensure', 'passer', 'passers',
      'percentage', 'schedule', 'tuition', 'fee', 'phone', 'email', 'address',
      'transferee', 'document', 'documents', 'quota',
    ];

    $haystack = $this->normalize(implode(' ', [
      (string) ($faq['question'] ?? ''),
      (string) ($faq['answer'] ?? ''),
      implode(' ', $faq['keywords'] ?? []),
      (string) ($faq['category'] ?? ''),
      (string) ($faq['id'] ?? ''),
    ]));

    foreach ($intentTerms as $term) {
      if (str_contains($normalized, $term) && ! str_contains($haystack, $term)) {
        return false;
      }
    }

    return true;
  }

  private function mentionsBoardRatings(string $normalized): bool
  {
    foreach (['prc', 'board exam', 'board rating', 'board ratings', 'licensure', 'passer', 'passers'] as $term) {
      if (str_contains($normalized, $term)) {
        return true;
      }
    }

    return str_contains($normalized, 'rating') && (
      str_contains($normalized, 'board')
      || str_contains($normalized, 'engineering')
      || str_contains($normalized, 'tup')
    );
  }

  /**
   * @param  array<string, mixed>|null  $bestFaq
   * @return list<array{label: string, url: string}>
   */
  private function aiLinksFor(string $normalized, ?array $bestFaq): array
  {
    if ($this->mentionsBoardRatings($normalized)) {
      $links = [];
      if (Route::has('academics.show')) {
        $college = 'coe';
        if (str_contains($normalized, 'coet') || str_contains($normalized, 'technology')) {
          $college = 'coet';
        } elseif (str_contains($normalized, 'coac') || str_contains($normalized, 'automation')) {
          $college = 'coac';
        }
        $links[] = [
          'label' => strtoupper($college).' board ratings',
          'url' => route('academics.show', ['college' => $college], false),
        ];
      }
      if (Route::has('academics.undergraduate')) {
        $links[] = $this->link('Undergraduate programs', 'academics.undergraduate');
      }

      return $links;
    }

    if ($bestFaq && ! empty($bestFaq['links'])) {
      $resolved = $this->resolveLinks($bestFaq['links']);
      if ($resolved !== []) {
        return $resolved;
      }
    }

    return [
      $this->link('Admission procedure', 'admissions.enrollment'),
      $this->link('Contact', 'contact'),
    ];
  }

  /**
   * @return list<array{question: string, answer: string}>
   */
  private function parseFaqHtml(string $html): array
  {
    $pairs = [];

    if (preg_match_all('/<summary[^>]*>(.*?)<\/summary>\s*(.*?)(?=<summary|$)/is', $html, $blocks, PREG_SET_ORDER)) {
      foreach ($blocks as $block) {
        $question = trim(strip_tags($block[1]));
        $answer = trim(strip_tags($block[2]));
        if ($question !== '' && $answer !== '') {
          $pairs[] = [
            'question' => $question,
            'answer' => Str::limit($answer, 400),
          ];
        }
      }
    }

    if ($pairs === [] && preg_match_all('/<h[34][^>]*>(.*?)<\/h[34]>\s*<p[^>]*>(.*?)<\/p>/is', $html, $blocks, PREG_SET_ORDER)) {
      foreach ($blocks as $block) {
        $question = trim(strip_tags($block[1]));
        $answer = trim(strip_tags($block[2]));
        if ($question !== '' && $answer !== '') {
          $pairs[] = [
            'question' => $question,
            'answer' => Str::limit($answer, 400),
          ];
        }
      }
    }

    return $pairs;
  }

  /**
   * @return list<string>
   */
  private function courseKeywords(string $name): array
  {
    $keywords = [$this->normalize($name)];
    $words = preg_split('/\s+/', $this->normalize($name)) ?: [];

    foreach ($words as $word) {
      if (strlen($word) >= 3) {
        $keywords[] = $word;
      }
    }

    if (preg_match_all('/\b[A-Z]{2,}\b/', $name, $acronyms)) {
      foreach ($acronyms[0] as $acro) {
        $keywords[] = strtolower($acro);
      }
    }

    return array_values(array_unique($keywords));
  }

  /**
   * @return list<string>
   */
  private function tokenize(string $value): array
  {
    return array_values(array_filter(
      preg_split('/\s+/', $this->normalize($value)) ?: [],
      fn (string $token) => strlen($token) >= 3,
    ));
  }

  /**
   * @param  array{question?: string, answer?: string, keywords?: list<string>}  $faq
   */
  private function score(string $normalized, array $faq): float
  {
    $score = 0.0;
    $question = $this->normalize((string) ($faq['question'] ?? ''));

    if ($question !== '' && ($normalized === $question || str_contains($question, $normalized) || str_contains($normalized, $question))) {
      $score += 6.0;
    }

    foreach ($faq['keywords'] ?? [] as $keyword) {
      $kw = $this->normalize((string) $keyword);
      if ($kw === '') {
        continue;
      }
      if ($normalized === $kw || str_contains($normalized, $kw)) {
        $score += max(1.2, min(3.5, strlen($kw) / 4));
      }
    }

    foreach (preg_split('/\s+/', $normalized) ?: [] as $token) {
      if (strlen($token) < 4) {
        continue;
      }
      if (str_contains($question, $token)) {
        $score += 0.35;
      }
    }

    return $score;
  }

  private function normalize(string $value): string
  {
    $value = mb_strtolower(trim($value));
    $value = str_replace(["’", "‘", "“", "”"], ["'", "'", '"', '"'], $value);
    $value = preg_replace('/[^\p{L}\p{N}\s\-\+×x]/u', ' ', $value) ?? $value;
    $value = preg_replace('/\s+/', ' ', $value) ?? $value;

    return trim($value);
  }

  /**
   * @param  list<array{label: string, route: string, params?: array<string, string>}>  $links
   * @return list<array{label: string, url: string}>
   */
  private function resolveLinks(array $links): array
  {
    $resolved = [];

    foreach ($links as $link) {
      if (empty($link['route']) || ! Route::has($link['route'])) {
        continue;
      }

      $resolved[] = [
        'label' => $link['label'],
        'url' => route($link['route'], $link['params'] ?? [], false),
      ];
    }

    return $resolved;
  }

  /**
   * @return array{label: string, url: string}
   */
  private function link(string $label, string $route): array
  {
    return [
      'label' => $label,
      'url' => route($route, [], false),
    ];
  }

  private function logUnanswered(string $message, ?Request $request): void
  {
    try {
      EmaiUnansweredLog::query()->create([
        'message' => Str::limit($message, 500),
        'ip_address' => $request?->ip(),
        'user_agent' => $request ? Str::limit((string) $request->userAgent(), 255) : null,
      ]);
    } catch (\Throwable) {
      // Do not break chat if logging table is unavailable.
    }
  }
}
