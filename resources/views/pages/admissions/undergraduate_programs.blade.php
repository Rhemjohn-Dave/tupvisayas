@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Undergraduate Programs - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Degree programs offered by each college at the Technological University of the Philippines Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Undergraduate Programs - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--ug-programs">

        {{-- Hero --}}
        <section class="ug-hero" aria-labelledby="ug-hero-heading">
            <div class="ug-hero__media" aria-hidden="true">
                <div class="ug-hero__fallback"></div>
                <div class="ug-hero__shade"></div>
            </div>
            <div class="ug-hero__content">
                <p class="ug-hero__badge">Excellence in Technology</p>
                <h1 id="ug-hero-heading" class="ug-hero__title">
                    Undergraduate<br>Programs
                </h1>
                <p class="ug-hero__lede">
                    Designed to meet global industrial standards, our degree programs provide a
                    perfect balance between theoretical knowledge and practical engineering
                    expertise.
                </p>
                <div class="ug-hero__actions">
                    <a class="ug-btn ug-btn--gold" href="{{ route('academics') }}">Explore Faculty</a>
                    <a class="ug-btn ug-btn--ghost-light" href="{{ route('admissions.enrollment') }}">Apply Now</a>
                </div>
            </div>
        </section>

        {{-- Programs listing --}}
        <section class="ug-programs-section" aria-labelledby="ug-programs-heading">
            <div class="ug-programs-inner">
                <header class="ug-programs-header">
                    <div>
                        <h2 id="ug-programs-heading" class="ug-programs-title">Undergraduate Programs</h2>
                        <p class="ug-programs-lede">
                            To meet global industrial standards, our degree programs provide a perfect balance between
                            theoretical knowledge and practical engineering expertise.
                        </p>
                    </div>
                    @if ($colleges->count() > 1)
                        <div class="ug-filter" id="ug-filter" aria-label="Filter by college">
                            <button class="ug-filter__btn is-active" data-ug-filter="all">All Programs</button>
                            @foreach ($colleges as $college)
                                <button class="ug-filter__btn"
                                    data-ug-filter="{{ Str::slug($college->college) }}">{{ $college->abbreviation ?? Str::upper(Str::limit($college->college, 20, '')) }}</button>
                            @endforeach
                        </div>
                    @endif
                </header>

                @forelse ($colleges as $college)
                    <div class="ug-college-group" data-ug-group="{{ Str::slug($college->college) }}">
                        @if ($colleges->count() > 1)
                            <h3 class="ug-college-label" id="college-{{ Str::slug($college->college) }}">
                                {{ $college->college }}
                            </h3>
                        @endif

                        @if ($college->courses->count())
                            <div class="ug-grid">
                                @foreach ($college->courses as $course)
                                    @php
                                        $words = preg_split('/\s+/', trim($course->name));
                                        $initials = '';
                                        foreach ($words as $w) {
                                            if ($w !== '') {
                                                $initials .= strtoupper(mb_substr($w, 0, 1));
                                                if (strlen($initials) >= 2) break;
                                            }
                                        }
                                        $excerpt = filled($course->description)
                                            ? Str::limit(trim(strip_tags($course->description)), 120)
                                            : null;
                                    @endphp
                                    <article class="ug-card">
                                        <div class="ug-card__icon">
                                            @if ($course->logo)
                                                <img src="{{ asset('storage/' . $course->logo) }}"
                                                    alt="" loading="lazy">
                                            @else
                                                <span aria-hidden="true">{{ $initials ?: 'TUP' }}</span>
                                            @endif
                                        </div>
                                        <span class="ug-card__years">4 years</span>
                                        <h3 class="ug-card__title">{{ $course->name }}</h3>
                                        @if ($excerpt)
                                            <p class="ug-card__desc">{{ $excerpt }}</p>
                                        @else
                                            <p class="ug-card__desc">
                                                A rigorous program that prepares graduates for professional careers and
                                                licensure examinations in this field.
                                            </p>
                                        @endif
                                        <div class="ug-card__actions">
                                            <a class="ug-card__link"
                                                href="{{ route('academics.program', [$collegeRouteMap[$college->college] ?? $college->routeSlug(), $course->slug]) }}">
                                                Program details
                                                <span aria-hidden="true">↗</span>
                                            </a>
                                            <a class="ug-card__cta"
                                                href="{{ route('admissions.enrollment') }}">Apply Now</a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <p class="ug-empty">No programs listed for this college yet.</p>
                        @endif
                    </div>
                @empty
                    <p class="ug-empty">No undergraduate programs available at this time.</p>
                @endforelse
            </div>
        </section>

        {{-- CTA --}}
        <section class="ug-cta" aria-labelledby="ug-cta-heading">
            <div class="ug-cta__inner">
                <h2 id="ug-cta-heading" class="ug-cta__title">Ready to Engineer Your Future?</h2>
                <p class="ug-cta__lede">
                    Applications for the next academic year are now open. Secure your place in one of the leading
                    technological universities in the Philippines.
                </p>
                <div class="ug-cta__actions">
                    <a class="ug-btn ug-btn--primary" href="{{ route('admissions.enrollment') }}">Start Application</a>
                    <a class="ug-btn ug-btn--ghost-dark" href="{{ route('academics') }}">Download Brochure</a>
                </div>
            </div>
        </section>
    </div>
@endsection
