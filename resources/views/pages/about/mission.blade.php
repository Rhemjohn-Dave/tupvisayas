@extends('layouts.app')

@section('title', 'Mission & Vision - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'TUP official vision, mission, core values, and strategic goals — Technological University of the Philippines Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Mission & Vision - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--about-mission">
        <section class="acad-hero" aria-labelledby="mission-hero-heading">
            <p class="acad-hero__badge">About TUP</p>
            <h1 id="mission-hero-heading" class="acad-hero__title">Mission &amp; Vision</h1>
            <p class="acad-hero__lede">
                The Technological University of the Philippines — official vision, mission, core values, and strategic goals.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#mission-vision">Vision &amp; mission</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.history') }}">History</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.mandate') }}">Mandate</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.hymn') }}">Hymn</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('officials') }}">Officials</a>
            </div>
        </section>

        <section class="sit-section" id="mission-vision" aria-labelledby="mission-vision-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Direction</p>
                    <h2 id="mission-vision-heading" class="sit-section__title">Vision and mission</h2>
                </header>

                <div class="about-highlight-grid">
                    <article class="about-highlight">
                        <h3 class="about-highlight__title">Vision</h3>
                        <p class="about-highlight__text">
                            TUP: A premier state university with recognized excellence in engineering and technology education at par with leading universities in the ASEAN region.
                        </p>
                    </article>
                    <article class="about-highlight">
                        <h3 class="about-highlight__title">Mission</h3>
                        <p class="about-highlight__text">
                            The mission of TUP is stated in Section 2 of P.D. No. 1518 as follows:
                        </p>
                        <p class="about-highlight__text">
                            The University shall provide higher and advanced vocational, technical, industrial, technological and professional education and training in industries and technology, and in practical arts leading to certificates, diplomas and degrees. It shall provide progressive leadership in applied research, developmental studies in technical, industrial, and technological fields and production using indigenous materials; effect technology transfer in the countryside; and assist in the development of small-and-medium scale industries in identified growth centers.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="mission-values" aria-labelledby="core-values-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Culture</p>
                    <h2 id="core-values-heading" class="sit-section__title">Core values</h2>
                </header>
                <ul class="sit-check-list" aria-label="Core values">
                    <li>Transparent and participatory governance.</li>
                    <li>Unity in the pursuit of TUP mission, goals, and objectives.</li>
                    <li>Professionalism in the discharge of quality service.</li>
                    <li>Integrity and commitment to maintain the good name of the University.</li>
                    <li>Accountability for individual and organizational quality performance.</li>
                    <li>Nationalism through tangible contribution to the rapid economic growth of the country.</li>
                    <li>Shared responsibility, hard work, and resourcefulness in compliance to the mandates of the university.</li>
                </ul>
            </div>
        </section>

        <section class="sit-section" id="mission-goals" aria-labelledby="strategic-goals-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Priorities</p>
                    <h2 id="strategic-goals-heading" class="sit-section__title">Strategic goals</h2>
                </header>
                <ul class="sit-check-list" aria-label="Strategic goals">
                    <li>Quality &amp; responsive curricular offerings.</li>
                    <li>Excellence in engineering &amp; technology research.</li>
                    <li>Leadership in community services.</li>
                    <li>Strengthening capability &amp; competence.</li>
                    <li>Modernized university system &amp; efficient management of resources.</li>
                    <li>Increased financial viability.</li>
                    <li>Enhanced network &amp; sustained collaboration initiatives.</li>
                </ul>
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="mission-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="mission-cta-heading" class="acad-cta__title">See the legal mandate</h2>
                <p class="acad-cta__lede">
                    Read Presidential Decree No. 1518, or revisit how TUP grew through the years.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('about.mandate') }}">The TUP Mandate</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('about.history') }}">TUP History</a>
                </div>
            </div>
        </section>
    </div>
@endsection
