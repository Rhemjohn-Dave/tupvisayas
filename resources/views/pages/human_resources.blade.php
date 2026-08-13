@extends('layouts.app')

@section('title', 'Human Resources - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Human Resources at TUP Visayas — faculty and staff job openings, employment information, and campus HR services.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Human Resources - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--hr">
        <section class="acad-hero" aria-labelledby="hr-hero-heading">
            <p class="acad-hero__badge">Administration</p>
            <h1 id="hr-hero-heading" class="acad-hero__title">Human Resources</h1>
            <p class="acad-hero__lede">
                Faculty and staff employment at TUP Visayas — published job openings, application guidance, and
                campus HR services.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#hr-openings">Job openings</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('contact') }}">Contact campus</a>
            </div>
        </section>

        <section class="sit-section" aria-labelledby="hr-about-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Office</p>
                    <h2 id="hr-about-heading" class="sit-section__title">Campus Human Resources</h2>
                </header>
                <p class="sit-prose">
                    Human Resources coordinates faculty and staff hiring, appointments, and related personnel
                    transactions for TUP Visayas. Official vacancies for teaching and non-teaching positions are
                    posted on this page.
                </p>
                <ul class="sit-check-list" aria-label="HR services">
                    <li>Publish faculty and staff job openings</li>
                    <li>Receive application documents for campus vacancies</li>
                    <li>Support appointment and personnel transactions</li>
                </ul>
                <p class="sit-prose sit-prose--tight">
                    Student internships, OJT, and industry placements are handled separately by the
                    <a href="{{ route('sit') }}#sit-recruitment">SIT Office</a>.
                </p>
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="hr-openings" aria-labelledby="hr-openings-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Vacancies</p>
                    <h2 id="hr-openings-heading" class="sit-section__title">Job openings</h2>
                    <p class="sit-section__lede">
                        Current faculty and staff vacancies. Read the full posting for qualifications and how to apply.
                    </p>
                </header>

                @include('pages.partials.job_cards', [
                    'jobs' => $jobs,
                    'empty' => 'No HR job openings posted yet. Check back soon or contact the campus through the contact page.',
                ])
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="hr-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="hr-cta-heading" class="acad-cta__title">Apply to join TUP Visayas</h2>
                <p class="acad-cta__lede">
                    Submit requirements indicated in the posting, or reach the campus for Human Resources inquiries.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('contact') }}">Contact us</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('sit') }}">SIT / student placements</a>
                </div>
            </div>
        </section>
    </div>
@endsection
