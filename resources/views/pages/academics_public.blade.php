@extends('layouts.app')

<<<<<<< HEAD
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
                            {!! $collegePage->history !!}
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
                                <article class="college-course-card mission-card">
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
                                            <div class="site-prose college-course-card__desc">{!! $course->description !!}</div>
                                        @endif
                                        <a class="college-course-card__link"
                                            href="{{ route('accreditation.course.show', $course) }}">View accreditation</a>
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
=======
@section('head')
    <style>
        .tabs .tab a {
            color: #C41E3A;
            font-weight: 600;
        }

        .tabs .tab a:hover {
            color: #fff !important;
            background: #C41E3A !important;
            border-radius: 6px 6px 0 0;
        }

        .tabs .tab a.active {
            color: #fff !important;
            background: #C41E3A !important;
            border-radius: 6px 6px 0 0;
        }

        .tabs .indicator {
            background-color: #C41E3A;
        }

        /* Courses Offered rows: logo left, info right */
        .course-list .course-row {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }

        .course-list .course-row:last-child {
            border-bottom: 0;
        }

        .course-logo {
            width: 420px;
            height: 420px;
            border-radius: 10px;
            object-fit: contain;
            background: #fafafa;
            border: 1px solid #eee;
            flex: 0 0 120px;
        }

        .course-logo.placeholder {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #C41E3A;
            background: #fff6f7;
        }

        .course-info {
            flex: 1 1 auto;
        }

        .course-title {
            font-weight: 1000;
            font-size: 1.5rem;
            color: #333;
            line-height: 1.2;
            margin: 2px 0 6px 0;
        }

        .course-desc {
            color: #555;
            margin: 30px 20px 20px 10px;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5;
            text-align: justify;
            text-justify: inter-word;

            text-justify-last: inter-word;


        }

        .course-info hr {
            border: none;
            border-top: 1px solid #222;
            /* Light gray line */
            margin: 10px 0;
            /* Vertical spacing */
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .course-logo {
                width: 96px;
                height: 96px;
                flex: 0 0 96px;
            }

            .course-title {
                font-size: 1.25rem;
            }

            .course-desc {
                margin: 16px 0 0 0;
            }
        }

        @media (max-width: 600px) {
            .course-list .course-row {
                flex-direction: column;
                align-items: center;
                gap: 12px;
                text-align: center;
            }

            .course-logo {
                width: 160px;
                height: 160px;
                flex: 0 0 auto;
                max-width: 100%;
            }

            .course-info {
                width: 100%;
            }

            .course-info hr {
                margin: 8px 0;
            }

            .course-title {
                font-size: 1.2rem;
                margin: 4px 0 6px 0;
            }

            .course-desc {
                margin: 8px 0 0 0;
                text-align: left;
            }
        }

        .academics-banner-image {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
            margin-bottom: 2rem;
            display: block;
        }

        @media (max-width: 768px) {
            .academics-banner-image {
                max-height: 400px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Banner Image Section -->
    @if($collegePage->cover_photo)
        <div class="section" style="padding-top: 2rem; padding-bottom: 0;">
            <img src="{{ asset('storage/' . $collegePage->cover_photo) }}" alt="Cover Photo" class="academics-banner-image"
                onerror="this.onerror=null; this.src='https://via.placeholder.com/1200x600/C41E3A/FFFFFF?text=Academics';">
        </div>
    @endif

    <div class="section">
        <h3 style="color:#C41E3A;font-weight:700;">{{ ucwords(str_replace('_', ' ', $collegePage->college)) }}</h3>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#history">History</a></li>
                    <li class="tab col s3"><a href="#courses">Courses Offered</a></li>
                    <li class="tab col s3"><a href="#dept">Department & Faculty</a></li>
                    <li class="tab col s3"><a href="#org">Student Organization</a></li>
                </ul>
            </div>
            <div id="history" class="col s12" style="padding-top:2rem;">
                {!! $collegePage->history !!}
            </div>
            <div id="courses" class="col s12" style="padding-top:2rem;">
                <div class="course-list">
                    @foreach($collegePage->courses as $course)
                        <div class="course-row">
                            @if($course->logo)
                                <img class="course-logo" src="{{ asset('storage/' . $course->logo) }}"
                                    alt="{{ $course->name }} Logo">
                            @else
                                @php
                                    $words = preg_split('/\s+/', trim($course->name));
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                                    $initials = '';
                                    foreach ($words as $w) {
                                        if ($w !== '') {
                                            $initials .= strtoupper(mb_substr($w, 0, 1));
<<<<<<< HEAD
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
                                            <div class="site-prose college-org-card__desc">{!! $organization->description !!}</div>
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
                            {!! $collegePage->student_organization !!}
                        </div>
                    @else
                        <p class="program-empty">Student organization information will be published here soon.</p>
                    @endif
                </section>
=======
                                            if (strlen($initials) >= 2)
                                                break;
                                        }
                                    }
                                @endphp
                                <div class="course-logo placeholder">{{ $initials }}</div>
                            @endif
                            <div class="course-info">
                                <div class="course-title">{{ $course->name }}</div>
                                <hr>
                                @if($course->description)
                                    <p class="course-desc">{{ $course->description }}</p>
                                @endif
                                <div style="margin-top:1rem;">
                                    <a href="{{ route('accreditation.course.show', $course) }}"
                                        class="btn-small waves-effect waves-light red darken-2">
                                        View Accreditation
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="dept" class="col s12" style="padding-top:2rem;">
                <ul class="collapsible popout">
                    @foreach(\App\Models\Department::where('college_page_id', $collegePage->id)->get() as $department)
                        <li>
                            <div class="collapsible-header" style="font-weight:600;font-size:1.1rem;">
                                {{ $department->name }}
                            </div>
                            <div class="collapsible-body">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Faculty Rank</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($department->faculties as $faculty)
                                            <tr>
                                                <td>
                                                    @if($faculty->photo)
                                                        <img src="{{ asset('storage/' . $faculty->photo) }}" alt="Faculty Photo"
                                                            style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $faculty->name }}</td>
                                                <td>{{ $faculty->rank }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="org" class="col s12" style="padding-top:2rem;">
                {!! $collegePage->student_organization !!}
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<<<<<<< HEAD
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
=======
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.querySelectorAll('.tabs');
            M.Tabs.init(el);
            var elems = document.querySelectorAll('.collapsible');
            M.Collapsible.init(elems);
        });
    </script>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
