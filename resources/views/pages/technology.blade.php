@extends('layouts.app')

@section('title', 'University Information Technology Center - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'University Information Technology Center (UITC) at TUP Visayas — campus IT services, support, security, and digital resources for students and faculty.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="University Information Technology Center - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    @php
        $coreServices = [
            ['title' => 'Accounts & access', 'text' => 'Student and staff accounts, password management, and access control.'],
            ['title' => 'Network & Wi‑Fi', 'text' => 'Campus network connectivity, Wi‑Fi access, and related infrastructure.'],
            ['title' => 'Learning management system', 'text' => 'Online course delivery, materials, and student engagement tools.'],
            ['title' => 'Software & tools', 'text' => 'Licensed software and productivity applications for campus users.'],
            ['title' => 'Hardware & devices', 'text' => 'Computer laboratories, device support, and printing services.'],
            ['title' => 'Communication tools', 'text' => 'Email, conferencing, and collaboration platforms for the university community.'],
        ];

        $securityItems = [
            ['title' => 'Cybersecurity awareness', 'text' => 'Guidance on protecting accounts, devices, and university data.'],
            ['title' => 'IT policies', 'text' => 'Acceptable use and technology policies for the TUP community.'],
            ['title' => 'Account security', 'text' => 'Strong passwords and multi-factor authentication where applicable.'],
        ];

        $studentResources = [
            [
                'title' => 'Enrollment & records (ERS)',
                'text' => 'Online enrollment, grades, and student records through the TUP ERS portal.',
                'link' => 'https://ers.tup.edu.ph/aims/students/',
                'link_label' => 'Open student ERS',
            ],
            [
                'title' => 'Student email',
                'text' => 'Official university email for students. Contact UITC for account assistance.',
            ],
            [
                'title' => 'E-library & research',
                'text' => 'Digital library and research resources available through campus services.',
                'link' => route('library'),
                'link_label' => 'Visit Library page',
            ],
            [
                'title' => 'Learning management system',
                'text' => 'Course materials and online activities provided by faculty through the LMS.',
            ],
        ];

        $facultyResources = [
            [
                'title' => 'Faculty ERS',
                'text' => 'Faculty access to enrollment, grading, and related academic systems.',
                'link' => 'https://ers.tup.edu.ph/aims/faculty/',
                'link_label' => 'Open faculty ERS',
            ],
            [
                'title' => 'LMS management',
                'text' => 'Course setup, content delivery, and student engagement through the LMS.',
            ],
            [
                'title' => 'Collaboration tools',
                'text' => 'Email, conferencing, and shared workspaces for teaching and administration.',
            ],
            [
                'title' => 'Research & file storage',
                'text' => 'Secure storage and backup options for academic and research materials.',
            ],
        ];

        $leadership = [
            [
                'name' => 'Dr. Eric A. Malo-oy',
                'title' => 'Campus Director',
                'photo' => 'images/Malo-oy, Eric A-2154.jpg',
            ],
            [
                'name' => 'Jofred S. Tupan',
                'title' => 'UITC Administrator',
                'photo' => 'images/tupan,jofred.jpg',
            ],
        ];

        $staff = [
            [
                'name' => 'Engr. Christopher Faciolan, PECE',
                'title' => 'Network Administrator',
                'photo' => 'images/faciolan-chris.jpg',
            ],
            [
                'name' => 'Ricardo Suela',
                'title' => 'UITC Staff',
                'photo' => 'images/Suela, Ricardo F Jr-2211.jpg',
            ],
            [
                'name' => 'Engr. Rhemjohn Dave N. Pitong',
                'title' => 'Web Administrator',
                'photo' => 'images/Pitong, Rhemjohn Dave N-2902-copy.jpg',
            ],
        ];
    @endphp

    <div class="site-page site-page--technology">
        <section class="acad-hero" aria-labelledby="uitc-hero-heading">
            <p class="acad-hero__badge">Resources &amp; Offices</p>
            <h1 id="uitc-hero-heading" class="acad-hero__title">University Information Technology Center</h1>
            <p class="acad-hero__lede">
                Empowering students, faculty, and staff with secure connectivity, campus systems, and digital tools that
                support teaching, learning, and university operations.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#uitc-services">Core services</a>
                <a class="acad-btn acad-btn--ghost" href="#uitc-support">Support</a>
                <a class="acad-btn acad-btn--ghost" href="#uitc-team">UITC team</a>
            </div>
        </section>

        <section class="tech-section" id="uitc-services" aria-labelledby="uitc-services-heading">
            <div class="tech-section__inner">
                <header class="tech-section__head">
                    <p class="tech-eyebrow">Technology services</p>
                    <h2 id="uitc-services-heading" class="tech-section__title">Core services</h2>
                    <p class="tech-section__lede">
                        Technology services that support academic and administrative operations on campus.
                    </p>
                </header>
                <ul class="tech-card-grid">
                    @foreach ($coreServices as $service)
                        <li class="tech-card">
                            <h3 class="tech-card__title">{{ $service['title'] }}</h3>
                            <p class="tech-card__text">{{ $service['text'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="tech-section tech-section--muted" id="uitc-support" aria-labelledby="uitc-support-heading">
            <div class="tech-section__inner">
                <header class="tech-section__head">
                    <p class="tech-eyebrow">Helpdesk</p>
                    <h2 id="uitc-support-heading" class="tech-section__title">Support &amp; contact</h2>
                </header>

                <div class="tech-split">
                    <article class="tech-panel">
                        <h3 class="tech-panel__title">Contact</h3>
                        <dl class="tech-meta">
                            <div>
                                <dt>Email</dt>
                                <dd><a href="mailto:visayas.uitc@tup.edu.ph">visayas.uitc@tup.edu.ph</a></dd>
                            </div>
                            <div>
                                <dt>Telephone</dt>
                                <dd><a href="tel:+63344953480">(034) 495-3480</a></dd>
                            </div>
                            <div>
                                <dt>Office</dt>
                                <dd>University Information Technology Center, TUP Visayas</dd>
                            </div>
                        </dl>
                    </article>

                    <article class="tech-panel">
                        <h3 class="tech-panel__title">Service hours</h3>
                        <ul class="tech-list">
                            <li>Monday to Friday — 8:00 AM to 5:00 PM</li>
                            <li>Saturday — closed</li>
                            <li>Sunday — closed</li>
                        </ul>
                    </article>

                    <article class="tech-panel">
                        <h3 class="tech-panel__title">Common requests</h3>
                        <ul class="tech-list">
                            <li>Password reset procedures</li>
                            <li>Campus Wi‑Fi connection</li>
                            <li>LMS access from off campus</li>
                            <li>Email and account issues</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section class="tech-section" id="uitc-security" aria-labelledby="uitc-security-heading">
            <div class="tech-section__inner">
                <header class="tech-section__head">
                    <p class="tech-eyebrow">Protection</p>
                    <h2 id="uitc-security-heading" class="tech-section__title">Security &amp; policies</h2>
                    <p class="tech-section__lede">
                        Protecting campus systems and digital identities through awareness, policy, and secure access.
                    </p>
                </header>
                <ul class="tech-card-grid tech-card-grid--three">
                    @foreach ($securityItems as $item)
                        <li class="tech-card">
                            <h3 class="tech-card__title">{{ $item['title'] }}</h3>
                            <p class="tech-card__text">{{ $item['text'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="tech-section tech-section--muted" id="uitc-students" aria-labelledby="uitc-students-heading">
            <div class="tech-section__inner">
                <header class="tech-section__head">
                    <p class="tech-eyebrow">For students</p>
                    <h2 id="uitc-students-heading" class="tech-section__title">Student digital resources</h2>
                </header>
                <ul class="tech-card-grid tech-card-grid--two">
                    @foreach ($studentResources as $item)
                        <li class="tech-card">
                            <h3 class="tech-card__title">{{ $item['title'] }}</h3>
                            <p class="tech-card__text">{{ $item['text'] }}</p>
                            @if (!empty($item['link']))
                                <a class="tech-card__link"
                                    href="{{ $item['link'] }}"
                                    @if (str_starts_with($item['link'], 'http')) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $item['link_label'] }}
                                    <span aria-hidden="true">↗</span>
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="tech-section" id="uitc-faculty" aria-labelledby="uitc-faculty-heading">
            <div class="tech-section__inner">
                <header class="tech-section__head">
                    <p class="tech-eyebrow">For faculty</p>
                    <h2 id="uitc-faculty-heading" class="tech-section__title">Faculty technology resources</h2>
                </header>
                <ul class="tech-card-grid tech-card-grid--two">
                    @foreach ($facultyResources as $item)
                        <li class="tech-card">
                            <h3 class="tech-card__title">{{ $item['title'] }}</h3>
                            <p class="tech-card__text">{{ $item['text'] }}</p>
                            @if (!empty($item['link']))
                                <a class="tech-card__link"
                                    href="{{ $item['link'] }}"
                                    @if (str_starts_with($item['link'], 'http')) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $item['link_label'] }}
                                    <span aria-hidden="true">↗</span>
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="tech-section tech-section--muted" id="uitc-team" aria-labelledby="uitc-team-heading">
            <div class="tech-section__inner">
                <header class="tech-section__head tech-section__head--center">
                    <p class="tech-eyebrow">Organization</p>
                    <h2 id="uitc-team-heading" class="tech-section__title">UITC team</h2>
                    <p class="tech-section__lede">
                        Organizational structure of the University Information Technology Center at TUP Visayas.
                    </p>
                </header>

                <div class="tech-org">
                    <div class="tech-org__tier">
                        @foreach ($leadership as $person)
                            <article class="tech-person {{ $loop->first ? 'tech-person--lead' : '' }}">
                                <figure class="tech-person__photo">
                                    <img src="{{ asset($person['photo']) }}" alt="{{ $person['name'] }}" loading="lazy">
                                </figure>
                                <h3 class="tech-person__name">{{ $person['name'] }}</h3>
                                <p class="tech-person__title">{{ $person['title'] }}</p>
                            </article>
                            @if (! $loop->last)
                                <div class="tech-org__connector" aria-hidden="true"></div>
                            @endif
                        @endforeach
                    </div>

                    <div class="tech-org__spine" aria-hidden="true"></div>

                    <div class="tech-org__tier tech-org__tier--team">
                        @foreach ($staff as $person)
                            <article class="tech-person">
                                <figure class="tech-person__photo">
                                    <img src="{{ asset($person['photo']) }}" alt="{{ $person['name'] }}" loading="lazy">
                                </figure>
                                <h3 class="tech-person__name">{{ $person['name'] }}</h3>
                                <p class="tech-person__title">{{ $person['title'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="uitc-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="uitc-cta-heading" class="acad-cta__title">Need IT assistance?</h2>
                <p class="acad-cta__lede">
                    Email the UITC helpdesk or open the campus systems you use most often.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="mailto:visayas.uitc@tup.edu.ph">Email UITC</a>
                    <a class="acad-btn acad-btn--outline-light" href="https://ers.tup.edu.ph/aims/students/"
                        target="_blank" rel="noopener noreferrer">Student ERS</a>
                    <a class="acad-btn acad-btn--outline-light" href="https://ers.tup.edu.ph/aims/faculty/"
                        target="_blank" rel="noopener noreferrer">Faculty ERS</a>
                </div>
            </div>
        </section>
    </div>
@endsection
