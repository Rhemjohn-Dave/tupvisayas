<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class EmaiAiService
{
    public function isEnabled(): bool
    {
        if (! config('emai.ai.enabled', true)) {
            return false;
        }

        return filled(config('emai.ai.api_key'));
    }

    /**
     * Ask Groq using grounded campus FAQ context.
     *
     * @param  list<array{question?: string, answer?: string}>  $contextFaqs
     * @return array{answer: string, used_ai: bool}|null
     */
    public function answer(string $message, array $contextFaqs = []): ?array
    {
        if (! $this->isEnabled()) {
            return null;
        }

        $apiKey = (string) config('emai.ai.api_key');
        $baseUrl = rtrim((string) config('emai.ai.base_url'), '/');
        $model = (string) config('emai.ai.model', 'llama-3.1-8b-instant');

        $system = $this->systemPrompt();
        $user = $this->userPrompt($message, $contextFaqs);
        $cacheKey = $this->cacheKey($model, $message, $contextFaqs);

        if (config('emai.ai.cache.enabled', true)) {
            $cached = Cache::get($cacheKey);
            if (is_array($cached) && filled($cached['answer'] ?? null)) {
                return [
                    'answer' => (string) $cached['answer'],
                    'used_ai' => true,
                ];
            }
        }

        try {
            $request = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout((int) config('emai.ai.timeout', 20));

            if (! config('emai.ai.verify_ssl', true)) {
                $request = $request->withoutVerifying();
            }

            $response = $request->post($baseUrl.'/chat/completions', [
                'model' => $model,
                'temperature' => (float) config('emai.ai.temperature', 0.2),
                'max_tokens' => (int) config('emai.ai.max_tokens', 350),
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $user],
                ],
            ]);

            if (! $response->successful()) {
                Log::warning('E-Mai Groq request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            $text = trim((string) data_get($response->json(), 'choices.0.message.content', ''));
            if ($text === '') {
                return null;
            }

            if (config('emai.ai.cache.enabled', true)) {
                Cache::put(
                    $cacheKey,
                    ['answer' => $text],
                    now()->addMinutes((int) config('emai.ai.cache.ttl_minutes', 360))
                );
            }

            return [
                'answer' => $text,
                'used_ai' => true,
            ];
        } catch (Throwable $e) {
            Log::warning('E-Mai Groq exception', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * @param  list<array{question?: string, answer?: string}>  $contextFaqs
     */
    private function cacheKey(string $model, string $message, array $contextFaqs): string
    {
        $fingerprint = [
            'model' => $model,
            'message' => Str::lower(trim($message)),
            'context' => array_map(fn (array $faq) => [
                'q' => (string) ($faq['question'] ?? ''),
                'a' => (string) ($faq['answer'] ?? ''),
            ], $contextFaqs),
        ];

        return 'emai.ai.answer.'.sha1(json_encode($fingerprint, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '');
    }

    private function systemPrompt(): string
    {
        $name = (string) config('emai.name', 'E-Mai');
        $campus = 'Technological University of the Philippines Visayas (TUP Visayas)';

        return implode("\n", [
            "You are {$name} (Electronics Machine AI), a friendly AI assistant for {$campus}.",
            'You can answer general questions about technology, engineering, computing, mathematics, science, studying tips, and Philippine PRC board exams (requirements overview, exam tips, common subjects, how licensure generally works).',
            'You can also answer light general questions (for example simple math or definitions) in a short, helpful way.',
            'When the visitor asks about TUP Visayas admissions, programs, schedules, fees, requirements, officials, or campus services:',
            '- Prefer the campus knowledge snippets provided in the user message.',
            '- Do not invent official campus policies, fees, dates, or decisions.',
            '- If campus-specific details are missing, say what you know generally and suggest the Admissions or Contact page for official confirmation.',
            'For PRC board exams: give practical general guidance only; remind users to verify latest requirements on the official PRC website.',
            'Keep answers clear and concise (about 2–6 short sentences unless a short list is needed). Use plain language.',
            'When asked about PRC / board exam ratings for TUP Visayas programs: use campus knowledge if it contains ratings or performance text; if ratings are not in the knowledge, say published figures are on the college Board exam ratings page / program page and that the visitor should verify the latest national results on the official PRC website. Do not invent pass rates.',
            'Be warm and encouraging. Do not mention Groq/Llama unless asked who powers you.',
            'If asked who you are: say you are E-Mai, Electronics Machine AI, the TUP Visayas website assistant.',
        ]);
    }

    /**
     * @param  list<array{question?: string, answer?: string}>  $contextFaqs
     */
    private function userPrompt(string $message, array $contextFaqs): string
    {
        $lines = ["Visitor question:\n{$message}", '', 'Optional campus knowledge (use when the question is about TUP Visayas):'];

        if ($contextFaqs === []) {
            $lines[] = '(No campus FAQ snippets matched closely.)';
        } else {
            foreach ($contextFaqs as $index => $faq) {
                $n = $index + 1;
                $q = trim((string) ($faq['question'] ?? ''));
                $a = trim((string) ($faq['answer'] ?? ''));
                $lines[] = "{$n}. Q: {$q}";
                $lines[] = "   A: {$a}";
            }
        }

        $lines[] = '';
        $lines[] = 'Answer helpfully. Use campus knowledge for TUP-specific facts; use your general knowledge for technology, PRC board exams, studying, and other non-campus questions.';

        return implode("\n", $lines);
    }
}
