@extends('layouts.app')

@section('title', 'Student Services - TUP Visayas')

@section('content')
    <div class="section site-page site-page--student-services">
        <h1 class="site-page-title site-page-title--center">Student services</h1>
        <p class="site-page-intro">Support offices and services available to TUP Visayas students throughout their stay on campus.</p>

        <section class="program-section" aria-labelledby="osa-heading" id="osa">
            <h2 id="osa-heading" class="site-section-title">Office of Student Affairs</h2>
            <div class="mission-card site-prose">
                <p>The Office of Student Affairs (OSA) coordinates student development programs, organization activities, and student welfare concerns. For student organization matters, student discipline guidance, and campus student activities, start with OSA.</p>
            </div>
        </section>

        <section class="program-section" aria-labelledby="services-heading">
            <h2 id="services-heading" class="site-section-title">Core services</h2>
            <ul class="mission-list">
                <li><strong>Medical / clinic services</strong> — On-campus health support for basic student medical needs.</li>
                <li><strong>Guidance and counseling</strong> — Academic and personal development support for students.</li>
                <li><strong>Registrar</strong> — Enrollment records, academic documents, and related student records services.</li>
                <li><strong>Student organizations</strong> — Recognition and support for college and campus organizations (see each college page for listed orgs).</li>
            </ul>
        </section>

        <section class="program-section" aria-labelledby="enrollment-heading">
            <h2 id="enrollment-heading" class="site-section-title">Incoming freshmen</h2>
            <div class="mission-card site-prose">
                <p>Applicants and incoming first-year students should follow the freshmen enrollment procedure and admission test schedule.</p>
                <div class="program-requirements__actions">
                    <a class="program-hero__cta" href="{{ route('admissions.enrollment') }}">Enrollment procedure</a>
                    <a class="program-hero__link" href="{{ route('admissions.enrollment') }}#admission-test-schedule">Admission test schedule</a>
                </div>
            </div>
        </section>

        <aside class="program-apply" aria-labelledby="ss-contact-heading">
            <h2 id="ss-contact-heading" class="program-apply__title">Need help finding an office?</h2>
            <p class="program-apply__text">Reach the campus through the contact page for telephone and location details.</p>
            <div class="program-hero__actions">
                <a class="program-hero__cta" href="{{ route('contact') }}">Contact us</a>
                <a class="program-hero__link" href="{{ route('academics.undergraduate') }}">Undergraduate programs</a>
            </div>
        </aside>
    </div>
@endsection
