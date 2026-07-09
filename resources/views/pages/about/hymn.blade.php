@extends('layouts.app')

@section('content')
    <div class="section site-page site-page--hymn">
        <h1 class="site-page-title site-page-title--center">The TUP Hymn</h1>
        <p class="site-page-intro">Official hymn of the Technological University of the Philippines.</p>

        <aside class="hymn-credits">
            <h2 class="hymn-credits__title">Credits</h2>
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

        <div class="hymn-versions-grid">
            <article class="hymn-version">
                <header class="hymn-version__head">
                    <h2 class="hymn-version__title">Filipino version</h2>
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
                    <h2 class="hymn-version__title">English version</h2>
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

        <section class="mission-block hymn-video" aria-labelledby="hymn-video-heading">
            <h2 id="hymn-video-heading" class="site-section-title">TUP hymn video</h2>
            <div class="site-embed">
                <iframe src="https://www.youtube.com/embed/-4EmUd1Es7U?si=DiIDAZKioh2hHolj"
                    title="TUP Hymn video"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <p class="hymn-video__caption">Listen to the official TUP Hymn performed by the TUP Chorale.</p>
        </section>
    </div>
@endsection
