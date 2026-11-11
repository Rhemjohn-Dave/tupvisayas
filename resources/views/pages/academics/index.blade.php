@extends('layouts.app')

@section('title', 'Academics - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Discover undergraduate programs and specialized colleges at the Technological University of the Philippines Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Academics - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    @php
        $collegeBlurbs = [
            'coac' => 'Industrial automation, instrumentation, and control systems that power modern manufacturing and process industries.',
            'coe' => 'Civil, mechanical, electrical, and allied engineering fields grounded in design, analysis, and professional practice.',
            'coet' => 'Advanced manufacturing, digital technology, and applied engineering pathways built for industry-ready graduates.',
            'basd' => 'General education and foundational sciences faculty supporting every program across TUP Visayas.',
        ];
        $collegeMetaWords = [
            'coac' => 'specialized',
            'coe' => 'accredited',
            'coet' => 'technical',
        ];
    @endphp

    <div class="site-page site-page--academics-hub">
        {{-- Hero --}}
        <section class="acad-hero" aria-labelledby="acad-hero-heading">
            <p class="acad-hero__badge">Academic excellence</p>
            <h1 id="acad-hero-heading" class="acad-hero__title">Academics</h1>
            <p class="acad-hero__lede">
                Discover our undergraduate programs and specialized colleges dedicated to shaping the next generation of
                engineers and technologists.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="{{ route('academics.undergraduate') }}">Undergraduate Programs</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('admissions.enrollment') }}">Apply as a freshman</a>
            </div>
        </section>

        {{-- Colleges --}}
        <section class="acad-colleges" aria-labelledby="academics-colleges-heading">
            <div class="acad-colleges__inner">
                <header class="acad-colleges__head">
                    <h2 id="academics-colleges-heading" class="acad-colleges__title">Our Colleges</h2>
                </header>

                <div class="acad-college-list">
                    @forelse ($colleges as $college)
                        @php
                            $slug = $college->routeSlug();
                            $facultyOnly = $college->isFacultyOnly();
                            $count = (int) $college->courses_count;
                            $metaWord = $collegeMetaWords[$slug] ?? 'offered';
                            $blurb = $collegeBlurbs[$slug] ?? 'Browse degree programs or meet the departments and faculty who teach them.';
                            $primaryUrl = $facultyOnly
                                ? route('academics.faculty', $slug)
                                : route('academics.show', $slug);
                            $cover = $college->cover_photo
                                ? asset('storage/' . $college->cover_photo)
                                : asset('images/tupvisayas.jpg');
                            $coverVer = $college->cover_photo
                                ? @filemtime(public_path('storage/' . $college->cover_photo))
                                : @filemtime(public_path('images/tupvisayas.jpg'));
                        @endphp
                        <article class="acad-college-card">
                            <figure class="acad-college-card__media">
                                <img src="{{ $cover }}?v={{ $coverVer ?: time() }}"
                                    alt="{{ $college->college }}" loading="lazy">
                            </figure>
                            <div class="acad-college-card__body">
                                <p class="acad-college-card__meta">
                                    @if ($facultyOnly)
                                        Faculty directory
                                    @else
                                        {{ $count }} {{ $metaWord }}
                                        {{ $count === 1 ? 'program' : 'programs' }}
                                    @endif
                                </p>
                                <h3 class="acad-college-card__title">
                                    <a href="{{ $primaryUrl }}">{{ $college->college }}</a>
                                </h3>
                                <p class="acad-college-card__text">{{ $blurb }}</p>
                                <div class="acad-college-card__links">
                                    @unless ($facultyOnly)
                                        <a href="{{ route('academics.show', $slug) }}">
                                            Browse Programs
                                            <span aria-hidden="true">↗</span>
                                        </a>
                                    @endunless
                                    <a href="{{ route('academics.faculty', $slug) }}">
                                        Faculty &amp; Departments
                                        <span aria-hidden="true">↗</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="acad-empty">College pages will appear here once published.</p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="acad-cta" aria-labelledby="acad-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="acad-cta-heading" class="acad-cta__title">Ready to Join TUP Visayas?</h2>
                <p class="acad-cta__lede">
                    Take the first step toward a rewarding career in engineering and technology. Freshmen admissions
                    through TUPSTAT are open for the coming academic year.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('admissions.enrollment') }}">View Admission
                        Requirements</a>
                    <a class="acad-btn acad-btn--outline-light"
                        href="{{ route('academics.undergraduate') }}">Browse Programs</a>
                </div>
            </div>
        </section>
    </div>
@endsection
