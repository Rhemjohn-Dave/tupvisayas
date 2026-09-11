@extends('layouts.app')

@section('title', 'The TUP Hymn - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Official hymn of the Technological University of the Philippines — Filipino and English lyrics, credits, and video.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="The TUP Hymn - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--about-hymn">
        <section class="acad-hero" aria-labelledby="hymn-hero-heading">
            <p class="acad-hero__badge">About TUP</p>
            <h1 id="hymn-hero-heading" class="acad-hero__title">The TUP Hymn</h1>
            <p class="acad-hero__lede">
                Official hymn of the Technological University of the Philippines.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#hymn-lyrics">Read lyrics</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.history') }}">History</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.mission') }}">Mission &amp; Vision</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.mandate') }}">Mandate</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('officials') }}">Officials</a>
            </div>
        </section>

        <section class="sit-section" id="hymn-credits" aria-labelledby="hymn-credits-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Attribution</p>
                    <h2 id="hymn-credits-heading" class="sit-section__title">Credits</h2>
                </header>
                <aside class="hymn-credits">
                    <dl class="hymn-credits__list">
                        <div>
                            <dt>Music</dt>
                            <dd>Prof. Romeo P. Verayo, Sr.</dd>
                        </div>
                        <div>
                            <dt>Filipino lyrics</dt>
                            <dd>Prof. Emerita R. Verayo</dd>
                        </div>
                        <div>
                            <dt>English lyrics</dt>
                            <dd>Dr. Milagros F. Lomotan</dd>
                        </div>
                    </dl>
                </aside>
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="hymn-lyrics" aria-labelledby="hymn-lyrics-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Lyrics</p>
                    <h2 id="hymn-lyrics-heading" class="sit-section__title">Filipino and English versions</h2>
                </header>

                <div class="hymn-versions-grid">
                    <article class="hymn-version">
                        <header class="hymn-version__head">
                            <h3 class="hymn-version__title">Filipino version</h3>
                        </header>
                        <div class="hymn-version__lyrics">
                            <p><strong>Kami sa 'yo'y nagpupugay TUP</strong></p>
                            <p>Ang 'yong tanglaw, liwanag sa aming landas</p>
                            <p>Diwa mo'y ginto, pusong wagas</p>
                            <p>Alay naming sa iyo'y lahat ng hirap</p>
                            <p>Buong pag-ibig at paglilingkod na ganap</p>
                            <p>Kay dami ng anak na 'yong pinagyaman</p>
                            <p>Dahil sa 'yo ngayo'y haligi ng bayan</p>
                            <p>Moog ka ng laya at dangal</p>
                            <p><strong>Teknolohikal na Unibersidad ng Pilipinas</strong></p>
                            <p>Bantayog ka ng lahi naming minamahal.</p>
                        </div>
                    </article>

                    <article class="hymn-version">
                        <header class="hymn-version__head">
                            <h3 class="hymn-version__title">English version</h3>
                        </header>
                        <div class="hymn-version__lyrics">
                            <p><strong>Hail to you, Alma Mater, hail TUP</strong></p>
                            <p>Your sons unite, and labor dignity uphold,</p>
                            <p>Strong minds, mighty hearts priceless that gold</p>
                            <p>These we offer you and all mankind</p>
                            <p><strong>Hail oh hail —</strong></p>
                            <p>Across the seas we'll toil for you,</p>
                            <p>Alma Mater dear</p>
                            <p>They're nation builders all, alumni ever true</p>
                            <p>Workers of note, trail blazers, artists</p>
                            <p>Selfless souls, men and women free</p>
                            <p>We honor thee</p>
                            <p><strong>Technological University of the Philippines</strong></p>
                            <p>Beloved school we honor you forever more!</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="sit-section" id="hymn-video" aria-labelledby="hymn-video-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Performance</p>
                    <h2 id="hymn-video-heading" class="sit-section__title">TUP hymn video</h2>
                </header>
                <div class="site-embed">
                    <iframe src="https://www.youtube.com/embed/-4EmUd1Es7U?si=DiIDAZKioh2hHolj"
                        title="TUP Hymn video"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <p class="hymn-video__caption">Listen to the official TUP Hymn performed by the TUP Chorale.</p>
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="hymn-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="hymn-cta-heading" class="acad-cta__title">Learn more about TUP</h2>
                <p class="acad-cta__lede">
                    Explore university history, or reach the campus through the contact page.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('about.history') }}">TUP History</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('contact') }}">Contact us</a>
                </div>
            </div>
        </section>
    </div>
@endsection
