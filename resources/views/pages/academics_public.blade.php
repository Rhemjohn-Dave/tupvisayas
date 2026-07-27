@extends('layouts.app')

@section('title', $collegePage->college . ' - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Programs, board exam ratings, and college information for ' . $collegePage->college . ' at TUP Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="{{ $collegePage->college }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($collegePage->cover_photo)
        <meta property="og:image" content="{{ asset('storage/' . $collegePage->cover_photo) }}">
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
    @endif
@endsection

@section('content')
    <div class="site-page site-page--college">
        @include('pages.academics.partials.college-masthead')

        <div class="college-body">
            <div class="uitc-tabs college-tabs" data-uitc-tabs>
                <div class="uitc-tabs__nav" role="tablist" aria-label="{{ $collegePage->college }} program sections">
                    <button type="button" class="uitc-tabs__btn is-active" role="tab" aria-selected="true"
                        aria-controls="college-panel-courses" id="college-tab-courses"
                        data-uitc-tab="college-panel-courses">Programs</button>
                    <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                        aria-controls="college-panel-board" id="college-tab-board"
                        data-uitc-tab="college-panel-board">Board exam ratings</button>
                    <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                        aria-controls="college-panel-history" id="college-tab-history"
                        data-uitc-tab="college-panel-history">About</button>
                </div>

                <div id="college-panel-courses" class="uitc-tabs__panel is-active" role="tabpanel"
                    aria-labelledby="college-tab-courses">
                    @if ($collegePage->courses->count())
                        <div class="college-program-grid">
                            @foreach ($collegePage->courses as $course)
                                @php
                                    $words = preg_split('/\s+/', trim($course->name));
                                    $initials = '';
                                    foreach ($words as $w) {
                                        if ($w !== '') {
                                            $initials .= strtoupper(mb_substr($w, 0, 1));
                                            if (strlen($initials) >= 2) {
                                                break;
                                            }
                                        }
                                    }
                                    $excerpt = filled($course->description)
                                        ? \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($course->description))), 140)
                                        : 'Learn more about curriculum, outcomes, and how to apply to this program.';
                                @endphp
                                <article class="college-program" id="course-{{ $course->id }}">
                                    @if ($course->logo)
                                        <img class="college-program__logo"
                                            src="{{ asset('storage/' . $course->logo) }}" alt="" loading="lazy">
                                    @else
                                        <div class="college-program__logo college-program__logo--placeholder"
                                            aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                                    @endif
                                    <h3 class="college-program__title">{{ $course->name }}</h3>
                                    <p class="college-program__excerpt">{{ $excerpt }}</p>
                                    <div class="college-program__actions">
                                        <a class="college-program__cta"
                                            href="{{ route('admissions.enrollment') }}">Apply Now</a>
                                        <a class="college-program__link"
                                            href="{{ route('academics.program', [$collegePage->routeSlug(), $course->slug]) }}">Details</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <p class="program-empty">No programs listed for this college at the moment.</p>
                    @endif
                </div>

                <div id="college-panel-board" class="uitc-tabs__panel" role="tabpanel"
                    aria-labelledby="college-tab-board" hidden>
                    <section class="college-info-panel" aria-labelledby="college-board-heading">
                        <h3 id="college-board-heading" class="college-info-panel__title">Board exam ratings</h3>
                        @if (filled($collegePage->board_exam_ratings))
                            <div class="site-prose site-prose--justify">
                                {!! clean($collegePage->board_exam_ratings) !!}
                            </div>
                        @else
                            <p class="program-empty">Board exam ratings will be published here soon.</p>
                        @endif
                    </section>
                </div>

                <div id="college-panel-history" class="uitc-tabs__panel" role="tabpanel"
                    aria-labelledby="college-tab-history" hidden>
                    <section class="college-info-panel" aria-labelledby="college-history-heading">
                        <h3 id="college-history-heading" class="college-info-panel__title">About the college</h3>
                        @if (filled($collegePage->history))
                            <div class="site-prose site-prose--justify">
                                {!! clean($collegePage->history) !!}
                            </div>
                        @else
                            <p class="program-empty">College history will be published here soon.</p>
                        @endif
                    </section>
                </div>
            </div>
        </div>

        @include('pages.academics.partials.college-cta')
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var root = document.querySelector('[data-uitc-tabs]');
            if (!root) return;

            var buttons = root.querySelectorAll('[data-uitc-tab]');
            var panels = root.querySelectorAll('.uitc-tabs__panel');

            function activateTab(button) {
                var targetId = button.getAttribute('data-uitc-tab');

                buttons.forEach(function(btn) {
                    btn.classList.remove('is-active');
                    btn.setAttribute('aria-selected', 'false');
                });

                panels.forEach(function(panel) {
                    panel.classList.remove('is-active');
                    panel.hidden = true;
                });

                button.classList.add('is-active');
                button.setAttribute('aria-selected', 'true');

                var panel = document.getElementById(targetId);
                if (panel) {
                    panel.classList.add('is-active');
                    panel.hidden = false;
                }
            }

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    activateTab(button);
                });
            });

            if (window.location.hash) {
                var hash = window.location.hash.replace('#', '');
                var match = root.querySelector('[data-uitc-tab="' + hash + '"]');
                if (match) {
                    activateTab(match);
                }
            }
        });
    </script>
@endsection
