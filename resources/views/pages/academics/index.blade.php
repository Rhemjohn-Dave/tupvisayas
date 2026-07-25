@extends('layouts.app')

@section('title', 'Academics - TUP Visayas')

@section('head')
    @php
        $metaDescription = 'Explore undergraduate programs and college pages at the Technological University of the Philippines Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Academics - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="section site-page site-page--academics-hub">
        <h1 class="site-page-title site-page-title--center">Academics</h1>
        <p class="site-page-intro">Explore undergraduate programs and college pages at TUP Visayas.</p>

        <div class="program-hero__actions program-hero__actions--center" role="group" aria-label="Program discovery">
            <a class="program-hero__cta" href="{{ route('academics.undergraduate') }}">Undergraduate programs</a>
            <a class="program-hero__link" href="{{ route('admissions.enrollment') }}">Apply as a freshman</a>
        </div>

        <section class="program-section" aria-labelledby="academics-colleges-heading">
            <h2 id="academics-colleges-heading" class="site-section-title">Colleges</h2>

            @forelse ($colleges as $college)
                <article class="academics-hub-college">
                    <h3 class="academics-hub-college__title">
                        <a href="{{ route('academics.show', $college->routeSlug()) }}">{{ $college->college }}</a>
                    </h3>
                    <p class="academics-hub-college__meta">
                        {{ $college->courses_count }}
                        {{ $college->courses_count === 1 ? 'program' : 'programs' }}
                    </p>
                    <p class="academics-hub-college__text">
                        Browse degree programs or meet the departments and faculty who teach them.
                    </p>
                    <div class="academics-hub-college__links">
                        <a class="program-hero__link" href="{{ route('academics.show', $college->routeSlug()) }}">Programs</a>
                        <a class="program-hero__link"
                            href="{{ route('academics.faculty', $college->routeSlug()) }}">Faculty &amp; Departments</a>
                    </div>
                </article>
            @empty
                <p class="program-empty">College pages will appear here once published.</p>
            @endforelse
        </section>
    </div>
@endsection
