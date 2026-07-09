@extends('layouts.app')

@section('content')
    <div class="section site-page site-page--mission">
        <h1 class="site-page-title site-page-title--center">Mission &amp; Vision</h1>
        <p class="site-page-intro">The Technological University of the Philippines — official vision, mission, core values, and strategic goals.</p>

        <div class="mission-vision-grid">
            <article class="mission-card">
                <h2 class="mission-card__title">Vision</h2>
                <p class="mission-card__text">TUP: A premier state university with recognized excellence in engineering and technology education at par with leading universities in the ASEAN region.</p>
            </article>
            <article class="mission-card">
                <h2 class="mission-card__title">Mission</h2>
                <p class="mission-card__text">The mission of TUP is stated in Section 2 of P.D. No. 1518 as follows:</p>
                <p class="mission-card__text">The University shall provide higher and advanced vocational, technical, industrial, technological and professional education and training in industries and technology, and in practical arts leading to certificates, diplomas and degrees. It shall provide progressive leadership in applied research, developmental studies in technical, industrial, and technological fields and production using indigenous materials; effect technology transfer in the countryside; and assist in the development of small-and-medium scale industries in identified growth centers.</p>
            </article>
        </div>

        <section class="mission-block" aria-labelledby="core-values-heading">
            <h2 id="core-values-heading" class="site-section-title">Core values</h2>
            <ul class="mission-list">
                <li>Transparent and participatory governance.</li>
                <li>Unity in the pursuit of TUP mission, goals, and objectives.</li>
                <li>Professionalism in the discharge of quality service.</li>
                <li>Integrity and commitment to maintain the good name of the University.</li>
                <li>Accountability for individual and organizational quality performance.</li>
                <li>Nationalism through tangible contribution to the rapid economic growth of the country.</li>
                <li>Shared responsibility, hard work, and resourcefulness in compliance to the mandates of the university.</li>
            </ul>
        </section>

        <section class="mission-block" aria-labelledby="strategic-goals-heading">
            <h2 id="strategic-goals-heading" class="site-section-title">Strategic goals</h2>
            <ul class="mission-list">
                <li>Quality &amp; responsive curricular offerings.</li>
                <li>Excellence in engineering &amp; technology research.</li>
                <li>Leadership in community services.</li>
                <li>Strengthening capability &amp; competence.</li>
                <li>Modernized university system &amp; efficient management of resources.</li>
                <li>Increased financial viability.</li>
                <li>Enhanced network &amp; sustained collaboration initiatives.</li>
            </ul>
        </section>
    </div>
@endsection
