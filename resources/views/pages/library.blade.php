@extends('layouts.app')

@section('title', 'Library - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'TUP Visayas Library — learning resources, services, and the 2026 library organizational chart.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Library - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    @php
        $leadership = [
            [
                'name' => 'Eric A. Malo-oy, Ph.D.',
                'title' => 'Campus Director',
                'photo' => 'images/library/malo-oy.jpg',
                'level' => 'top',
            ],
            [
                'name' => 'Patrick John G. Delumpa, Ph.D.',
                'title' => 'Assistant Director for Academic Affairs',
                'photo' => 'images/library/delumpa.jpg',
                'level' => 'top',
            ],
        ];

        $libraryTeam = [
            [
                'name' => 'Janette P. Dichosa, MSLS, RL',
                'title' => 'College Librarian III',
                'photo' => 'images/library/dichosa.jpg',
            ],
            [
                'name' => 'Aisa Marie J. Ortega, PhD-TM, RL',
                'title' => 'College Librarian II',
                'photo' => 'images/library/ortega.jpg',
            ],
            [
                'name' => 'Evelyn A. Flores, RL',
                'title' => 'College Librarian I',
                'photo' => 'images/library/flores.jpg',
            ],
            [
                'name' => 'Juvielyn L. Estardo',
                'title' => 'Library Staff (J.O.)',
                'photo' => 'images/library/estardo.png',
            ],
        ];
    @endphp

    <div class="site-page site-page--library">
        <section class="acad-hero" aria-labelledby="library-hero-heading">
            <p class="acad-hero__badge">Resources &amp; Offices</p>
            <h1 id="library-hero-heading" class="acad-hero__title">Library</h1>
            <p class="acad-hero__lede">
                Supporting teaching, research, and lifelong learning at the Technological University of the Philippines
                Visayas, City of Talisay, Negros Occidental.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#library-org">Organizational chart</a>
                <a class="acad-btn acad-btn--ghost" href="#library-services">Services</a>
                <a class="acad-btn acad-btn--ghost" href="#library-hours">Hours &amp; contact</a>
            </div>
        </section>

        <section class="lib-section" aria-labelledby="library-about-heading">
            <div class="lib-section__inner lib-section__inner--narrow">
                <header class="lib-section__head">
                    <p class="lib-eyebrow">About</p>
                    <h2 id="library-about-heading" class="lib-section__title">Campus Library</h2>
                </header>
                <p class="lib-prose">
                    The TUP Visayas Library provides access to print and online learning resources, quiet study spaces,
                    and research assistance for students, faculty, and staff. Services are coordinated under Academic
                    Affairs and led by registered librarians.
                </p>
            </div>
        </section>

        <section class="lib-section lib-section--muted" id="library-services" aria-labelledby="library-services-heading">
            <div class="lib-section__inner">
                <header class="lib-section__head">
                    <p class="lib-eyebrow">For students &amp; faculty</p>
                    <h2 id="library-services-heading" class="lib-section__title">Services</h2>
                    <p class="lib-section__lede">
                        Core library services. Confirm current policies and schedules with the College Librarian.
                    </p>
                </header>

                <ul class="lib-service-grid">
                    <li>
                        <strong>Circulation &amp; borrowing</strong>
                        <span>Loan and return of library materials for enrolled students and campus personnel.</span>
                    </li>
                    <li>
                        <strong>Reference &amp; research help</strong>
                        <span>Assistance with locating books, journals, standards, and online databases.</span>
                    </li>
                    <li>
                        <strong>Reading &amp; study areas</strong>
                        <span>Quiet spaces for individual review and academic preparation.</span>
                    </li>
                    <li>
                        <strong>Information literacy support</strong>
                        <span>Orientation and guidance on citing sources and responsible research use.</span>
                    </li>
                </ul>
            </div>
        </section>

        <section class="lib-section" id="library-org" aria-labelledby="library-org-heading">
            <div class="lib-section__inner">
                <header class="lib-section__head lib-section__head--center">
                    <p class="lib-eyebrow">2026</p>
                    <h2 id="library-org-heading" class="lib-section__title">Library organizational chart</h2>
                    <p class="lib-section__lede">
                        Technological University of the Philippines Visayas · City of Talisay, Negros Occidental
                    </p>
                </header>

                <div class="lib-org" role="list">
                    <div class="lib-org__tier" role="listitem">
                        @foreach ($leadership as $person)
                            <article class="lib-person lib-person--lead">
                                <figure class="lib-person__photo">
                                    <img src="{{ asset($person['photo']) }}" alt="{{ $person['name'] }}" loading="lazy">
                                </figure>
                                <h3 class="lib-person__name">{{ $person['name'] }}</h3>
                                <p class="lib-person__title">{{ $person['title'] }}</p>
                            </article>
                            @if (! $loop->last)
                                <div class="lib-org__connector" aria-hidden="true"></div>
                            @endif
                        @endforeach
                    </div>

                    <div class="lib-org__spine" aria-hidden="true"></div>

                    <div class="lib-org__tier lib-org__tier--team" role="list">
                        @foreach ($libraryTeam as $person)
                            <article class="lib-person" role="listitem">
                                <figure class="lib-person__photo">
                                    <img src="{{ asset($person['photo']) }}" alt="{{ $person['name'] }}" loading="lazy">
                                </figure>
                                <h3 class="lib-person__name">{{ $person['name'] }}</h3>
                                <p class="lib-person__title">{{ $person['title'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="lib-section lib-section--muted" id="library-hours" aria-labelledby="library-hours-heading">
            <div class="lib-section__inner">
                <div class="lib-split">
                    <div>
                        <header class="lib-section__head">
                            <p class="lib-eyebrow">Visit</p>
                            <h2 id="library-hours-heading" class="lib-section__title">Hours &amp; access</h2>
                        </header>
                        <dl class="lib-hours">
                            <div>
                                <dt>Monday – Friday</dt>
                                <dd>To be confirmed with Library Office</dd>
                            </div>
                            <div>
                                <dt>Weekends / holidays</dt>
                                <dd>Closed unless announced</dd>
                            </div>
                            <div>
                                <dt>Who may use the library</dt>
                                <dd>TUP Visayas students, faculty, and authorized researchers</dd>
                            </div>
                        </dl>
                        <p class="lib-note">
                            Service hours may change during enrollment, exams, or campus events. Check announcements
                            for temporary schedules.
                        </p>
                    </div>

                    <aside class="lib-contact-card" aria-labelledby="library-contact-heading">
                        <p class="lib-eyebrow">Contact</p>
                        <h3 id="library-contact-heading" class="lib-contact-card__title">Library Office</h3>
                        <p class="lib-contact-card__text">
                            For borrowing concerns, library orientation, and research assistance, coordinate with the
                            College Librarian.
                        </p>
                        <dl class="lib-contact-card__meta">
                            <div>
                                <dt>Head librarian</dt>
                                <dd>Janette P. Dichosa, MSLS, RL</dd>
                            </div>
                            <div>
                                <dt>Campus</dt>
                                <dd>TUP Visayas, City of Talisay, Negros Occidental</dd>
                            </div>
                        </dl>
                        <a class="acad-btn acad-btn--primary" href="{{ route('contact') }}">Campus contact page</a>
                    </aside>
                </div>
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="library-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="library-cta-heading" class="acad-cta__title">Need academic resources?</h2>
                <p class="acad-cta__lede">
                    Visit the Library for research support, or explore undergraduate programs and campus services.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('academics') }}">Browse Academics</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('student_services') }}">Student services</a>
                </div>
            </div>
        </section>
    </div>
@endsection
