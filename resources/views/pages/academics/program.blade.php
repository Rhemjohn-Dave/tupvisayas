@extends('layouts.app')

@section('title', $course->name . ' - ' . $collegePage->college . ' - TUP Visayas')

@section('head')
    @php
        $metaDescription = $course->hasSection('description')
            ? \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($course->description))), 155)
            : $course->name . ' undergraduate program at ' . $collegePage->college . ', TUP Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="{{ $course->name }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($course->logo)
        <meta property="og:image" content="{{ asset('storage/' . $course->logo) }}">
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
    @endif
@endsection

@section('content')
    <div class="section site-page site-page--program">
        <nav class="program-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('academics.undergraduate') }}">Undergraduate programs</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('academics.show', $collegeSlug) }}">{{ $collegePage->college }}</a>
            <span aria-hidden="true">/</span>
            <span aria-current="page">{{ $course->name }}</span>
        </nav>

        <header class="program-hero">
            <div class="program-hero__media">
                @if ($course->logo)
                    <img class="program-hero__logo" src="{{ asset('storage/' . $course->logo) }}"
                        alt="{{ $course->name }} logo" loading="eager">
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
                    <div class="program-hero__logo program-hero__logo--placeholder" aria-hidden="true">
                        {{ $initials ?: 'TUP' }}</div>
                @endif
            </div>
            <div class="program-hero__body">
                <p class="program-hero__college">{{ $collegePage->college }}</p>
                <h1 class="program-hero__title">{{ $course->name }}</h1>
                <div class="program-hero__actions" role="group" aria-label="Program actions">
                    <a class="program-hero__cta" href="{{ route('admissions.enrollment') }}">Apply Now</a>
                    <a class="program-hero__link" href="https://ers.tup.edu.ph/aims/applicants/" target="_blank"
                        rel="noopener noreferrer">Apply on ERS</a>
                </div>
            </div>
        </header>

        <section class="program-section" aria-labelledby="program-overview-heading">
            <h2 id="program-overview-heading" class="site-section-title">Overview</h2>
            @if (filled($course->description))
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->description) !!}
                </div>
            @else
                <p class="program-empty">Program overview will be published here soon.</p>
            @endif
        </section>

        @if ($course->hasSection('career_opportunities'))
            <section class="program-section" aria-labelledby="program-careers-heading">
                <h2 id="program-careers-heading" class="site-section-title">Career opportunities</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->career_opportunities) !!}
                </div>
            </section>
        @endif

        @if ($course->hasSection('program_objectives'))
            <section class="program-section" aria-labelledby="program-peo-heading">
                <h2 id="program-peo-heading" class="site-section-title">Program educational objectives</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->program_objectives) !!}
                </div>
            </section>
        @endif

        @if ($course->hasSection('program_outcomes'))
            <section class="program-section" aria-labelledby="program-outcomes-heading">
                <h2 id="program-outcomes-heading" class="site-section-title">Program outcomes</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->program_outcomes) !!}
                </div>
            </section>
        @endif

        <section class="program-section" aria-labelledby="program-requirements-heading">
            <h2 id="program-requirements-heading" class="site-section-title">Admission requirements</h2>
            <div class="mission-card program-requirements">
                <p>Incoming freshmen who wish to enroll in this program should:</p>
                <ul class="mission-list">
                    <li>Be a senior high school graduate (or ALS / equivalent completer) eligible for college admission</li>
                    <li>Submit an online application through the TUP Electronic Registration System (ERS)</li>
                    <li>Take the TUP Visayas Admission Test (TUPSTAT) on a scheduled date</li>
                    <li>Comply with documentary requirements announced by the Admissions Office after the exam</li>
                </ul>
                <p class="program-requirements__note">Full steps, reminders, and the current admission test schedule are on
                    the Freshmen Admission (TUPSTAT) guide.</p>
                <div class="program-requirements__actions">
                    <a class="program-hero__cta" href="{{ route('admissions.enrollment') }}">View TUPSTAT guide</a>
                    <a class="program-hero__link" href="{{ route('admissions.enrollment') }}#admission-test-schedule">Admission
                        test schedule</a>
                </div>
            </div>
        </section>

        @if ($course->hasSection('curriculum'))
            <section class="program-section" aria-labelledby="program-curriculum-heading">
                <h2 id="program-curriculum-heading" class="site-section-title">Curriculum</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->curriculum) !!}
                </div>
            </section>
        @endif

        @if ($course->hasSection('facilities_labs'))
            <section class="program-section" aria-labelledby="program-labs-heading">
                <h2 id="program-labs-heading" class="site-section-title">Labs &amp; facilities</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->facilities_labs) !!}
                </div>
            </section>
        @endif

        @if ($faculties->isNotEmpty())
            <section class="program-section" aria-labelledby="program-faculty-heading">
                <h2 id="program-faculty-heading" class="site-section-title">Faculty</h2>
                <div class="college-faculty-grid">
                    @foreach ($faculties as $faculty)
                        @php
                            $parts = collect(preg_split('/\s+/', trim($faculty->name)))->filter();
                            $initials = $parts->take(2)->map(fn($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                        @endphp
                        <div class="college-faculty-card">
                            <div class="college-faculty-card__photo">
                                @if ($faculty->photo)
                                    <img src="{{ asset('storage/' . $faculty->photo) }}" alt="{{ $faculty->name }}"
                                        loading="lazy">
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
            </section>
        @endif

        @if ($course->hasSection('accreditation_info'))
            <section class="program-section" aria-labelledby="program-accreditation-heading">
                <h2 id="program-accreditation-heading" class="site-section-title">Accreditation</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->accreditation_info) !!}
                </div>
            </section>
        @endif

        @if ($course->hasSection('board_performance'))
            <section class="program-section" aria-labelledby="program-board-heading">
                <h2 id="program-board-heading" class="site-section-title">Board performance</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->board_performance) !!}
                </div>
            </section>
        @endif

        @if ($course->hasSection('scholarships'))
            <section class="program-section" aria-labelledby="program-scholarships-heading">
                <h2 id="program-scholarships-heading" class="site-section-title">Scholarships</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->scholarships) !!}
                </div>
            </section>
        @endif

        @if ($course->hasSection('faq'))
            <section class="program-section" aria-labelledby="program-faq-heading">
                <h2 id="program-faq-heading" class="site-section-title">Frequently asked questions</h2>
                <div class="site-prose site-prose--justify mission-card">
                    {!! clean($course->faq) !!}
                </div>
            </section>
        @endif

        <aside class="program-apply" aria-labelledby="program-apply-heading">
            <h2 id="program-apply-heading" class="program-apply__title">Ready to apply?</h2>
            <p class="program-apply__text">Follow the Freshmen Admission (TUPSTAT) guide, then submit your application on ERS.</p>
            <div class="program-hero__actions">
                <a class="program-hero__cta" href="{{ route('admissions.enrollment') }}">Apply Now</a>
                <a class="program-hero__link" href="https://ers.tup.edu.ph/aims/applicants/" target="_blank"
                    rel="noopener noreferrer">Apply on ERS</a>
            </div>
        </aside>
    </div>
@endsection
