@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Undergraduate Programs - TUP Visayas')

@section('head')
    @php
        $metaDescription = 'Degree programs offered by each college at the Technological University of the Philippines Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Undergraduate programs - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="section site-page site-page--programs ug-programs">
        <h1 class="site-page-title site-page-title--center">Undergraduate programs</h1>
        <p class="site-page-intro">Degree programs offered by each college at TUP Visayas.</p>

        @forelse ($colleges as $college)
            <section class="ug-college" aria-labelledby="college-{{ Str::slug($college->college) }}">
                <h2 id="college-{{ Str::slug($college->college) }}" class="site-section-title">{{ $college->college }}</h2>

                @if ($college->courses->count() > 0)
                    <div class="programs-grid">
                        @foreach ($college->courses as $course)
                            <article class="program-card">
                                <div class="program-card__head">
                                    @if ($course->logo)
                                        <img class="program-card__logo" src="{{ asset('storage/' . $course->logo) }}"
                                            alt="{{ $course->name }} logo" loading="lazy">
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
                                        <div class="program-card__logo program-card__logo--placeholder" aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                                    @endif
                                    <h3 class="program-card__name">{{ $course->name }}</h3>
                                </div>

                                @if ($course->description)
                                    <p class="program-card__description">{{ Str::limit(strip_tags($course->description), 160) }}</p>
                                @endif

                                <div class="program-card__actions">
                                    <a class="program-card__link"
                                        href="{{ route('academics.program', [$collegeRouteMap[$college->college] ?? $college->routeSlug(), $course->slug]) }}">Program details</a>
                                    <a class="program-card__cta"
                                        href="{{ route('admissions.enrollment') }}">Apply Now</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="program-empty">No undergraduate programs listed for this college at the moment.</p>
                @endif
            </section>
        @empty
            <p class="program-empty">No undergraduate programs available at this time.</p>
        @endforelse
    </div>
@endsection
