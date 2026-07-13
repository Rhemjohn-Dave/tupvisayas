@extends('layouts.app')

@section('title', $collegePage->college . ' - TUP Visayas')

@section('content')
    <div class="section site-page site-page--college">
        @if ($collegePage->cover_photo)
            <figure class="college-hero">
                <img src="{{ asset('storage/' . $collegePage->cover_photo) }}" alt="{{ $collegePage->college }} cover photo"
                    loading="eager">
            </figure>
        @endif

        <h1 class="site-page-title site-page-title--center">{{ $collegePage->college }}</h1>
        <p class="site-page-intro">Programs, faculty, and college information at TUP Visayas.</p>

        <div class="uitc-tabs" data-uitc-tabs>
            <div class="uitc-tabs__nav" role="tablist" aria-label="{{ $collegePage->college }} sections">
                <button type="button" class="uitc-tabs__btn is-active" role="tab" aria-selected="true"
                    aria-controls="college-panel-history" id="college-tab-history"
                    data-uitc-tab="college-panel-history">History</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="college-panel-courses" id="college-tab-courses"
                    data-uitc-tab="college-panel-courses">Courses offered</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="college-panel-dept" id="college-tab-dept"
                    data-uitc-tab="college-panel-dept">Department &amp; faculty</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="college-panel-org" id="college-tab-org"
                    data-uitc-tab="college-panel-org">Student organizations</button>
            </div>

            <div id="college-panel-history" class="uitc-tabs__panel is-active" role="tabpanel"
                aria-labelledby="college-tab-history">
                <section class="uitc-block" aria-labelledby="college-history-heading">
                    <h2 id="college-history-heading" class="site-section-title">History</h2>
                    @if (filled($collegePage->history))
                        <div class="site-prose site-prose--justify mission-card">
                            {!! clean($collegePage->history) !!}
                        </div>
                    @else
                        <p class="program-empty">College history will be published here soon.</p>
                    @endif
                </section>
            </div>

            <div id="college-panel-courses" class="uitc-tabs__panel" role="tabpanel"
                aria-labelledby="college-tab-courses" hidden>
                <section class="uitc-block" aria-labelledby="college-courses-heading">
                    <h2 id="college-courses-heading" class="site-section-title">Courses offered</h2>
                    @if ($collegePage->courses->count())
                        <div class="college-course-list">
                            @foreach ($collegePage->courses as $course)
                                <article class="college-course-card mission-card" id="course-{{ $course->id }}">
                                    <div class="college-course-card__media">
                                        @if ($course->logo)
                                            <img class="college-course-card__logo"
                                                src="{{ asset('storage/' . $course->logo) }}" alt="{{ $course->name }} logo"
                                                loading="lazy">
                                        @else
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
                                            @endphp
                                            <div class="college-course-card__logo college-course-card__logo--placeholder"
                                                aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                                        @endif
                                    </div>
                                    <div class="college-course-card__body">
                                        <h3 class="college-course-card__title">{{ $course->name }}</h3>
                                        @if ($course->description)
                                            <div class="site-prose college-course-card__desc">{!! clean($course->description) !!}</div>
                                        @endif
                                        <div class="college-course-card__actions">
                                            <a class="college-course-card__link"
                                                href="{{ route('academics.program', [$collegePage->routeSlug(), $course->slug]) }}">Learn more</a>
                                            <a class="college-course-card__cta"
                                                href="{{ route('admissions.enrollment') }}">Apply Now</a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <p class="program-empty">No courses listed for this college at the moment.</p>
                    @endif
                </section>
            </div>

            <div id="college-panel-dept" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="college-tab-dept"
                hidden>
                <section class="uitc-block" aria-labelledby="college-dept-heading">
                    <h2 id="college-dept-heading" class="site-section-title">Department &amp; faculty</h2>
                    @php
                        $departments = \App\Models\Department::where('college_page_id', $collegePage->id)
                            ->with('faculties')
                            ->get();
                    @endphp
                    @forelse ($departments as $department)
                        <article class="college-dept mission-card">
                            <header class="college-dept__header">
                                <h3 class="college-dept__title">{{ $department->name }}</h3>
                                <span class="college-dept__count">
                                    {{ $department->faculties->count() }}
                                    {{ $department->faculties->count() === 1 ? 'faculty member' : 'faculty members' }}
                                </span>
                            </header>

                            @if ($department->faculties->count())
                                <div class="college-faculty-grid">
                                    @foreach ($department->faculties as $faculty)
                                        @php
                                            $parts = collect(preg_split('/\s+/', trim($faculty->name)))->filter();
                                            $initials = $parts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                                        @endphp
                                        <div class="college-faculty-card">
                                            <div class="college-faculty-card__photo">
                                                @if ($faculty->photo)
                                                    <img src="{{ asset('storage/' . $faculty->photo) }}"
                                                        alt="{{ $faculty->name }}" loading="lazy">
                                                @else
                                                    <span class="college-faculty-card__placeholder"
                                                        aria-hidden="true">{{ $initials ?: 'TUP' }}</span>
                                                @endif
                                            </div>
                                            <div class="college-faculty-card__body">
                                                <p class="college-faculty-card__name">{{ $faculty->name }}</p>
                                                @if ($faculty->rank)
                                                    <p class="college-faculty-card__rank">{{ $faculty->rank }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="college-dept__empty">No faculty listed for this department yet.</p>
                            @endif
                        </article>
                    @empty
                        <p class="program-empty">No departments listed for this college.</p>
                    @endforelse
                </section>
            </div>

            <div id="college-panel-org" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="college-tab-org"
                hidden>
                <section class="uitc-block" aria-labelledby="college-org-heading">
                    <h2 id="college-org-heading" class="site-section-title">Student organizations</h2>
                    @if ($collegePage->studentOrganizations->count())
                        <div class="college-org-list">
                            @foreach ($collegePage->studentOrganizations as $organization)
                                @php
                                    $words = preg_split('/\s+/', trim($organization->name));
                                    $initials = '';
                                    foreach ($words as $w) {
                                        if ($w !== '') {
                                            $initials .= strtoupper(mb_substr($w, 0, 1));
                                            if (strlen($initials) >= 2) {
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                <article class="college-org-card mission-card">
                                    <div class="college-org-card__media">
                                        @if ($organization->logo)
                                            <img class="college-org-card__logo"
                                                src="{{ asset('storage/' . $organization->logo) }}"
                                                alt="{{ $organization->name }} logo" loading="lazy">
                                        @else
                                            <div class="college-org-card__logo college-org-card__logo--placeholder"
                                                aria-hidden="true">{{ $initials ?: 'ORG' }}</div>
                                        @endif
                                    </div>
                                    <div class="college-org-card__body">
                                        <h3 class="college-org-card__title">{{ $organization->name }}</h3>
                                        @if ($organization->description)
                                            <div class="site-prose college-org-card__desc">{!! clean($organization->description) !!}</div>
                                        @endif
                                        @if ($organization->email || $organization->website)
                                            <div class="college-org-card__links">
                                                @if ($organization->email)
                                                    <a class="college-org-card__link"
                                                        href="mailto:{{ $organization->email }}">{{ $organization->email }}</a>
                                                @endif
                                                @if ($organization->website)
                                                    <a class="college-org-card__link" href="{{ $organization->website }}"
                                                        target="_blank" rel="noopener noreferrer">Visit website</a>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @elseif (filled($collegePage->student_organization))
                        <div class="site-prose site-prose--justify mission-card">
                            {!! clean($collegePage->student_organization) !!}
                        </div>
                    @else
                        <p class="program-empty">Student organization information will be published here soon.</p>
                    @endif
                </section>
            </div>
        </div>
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
