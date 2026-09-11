@php
    $isAdmin = auth()->check() && auth()->user()->canAccessAdmin();
    $showProcurement = !auth()->check();
@endphp

<div class="site-nav-shell">
    <a href="{{ route('home') }}" class="site-brand">
        <img src="{{ asset('images/tup-logo.png') }}" width="44" height="44" alt="">
        <span class="site-brand__text">TUP Visayas</span>
        <span class="site-brand__text--short" aria-hidden="true">TUPV</span>
    </a>

    <div class="site-nav-actions">
        @unless ($isAdmin)
            <nav class="site-nav" aria-label="Primary">
                <ul class="site-nav__list">
                    <li class="site-nav__item">
                        <button type="button" class="site-nav__trigger" data-site-submenu aria-expanded="false"
                            aria-controls="desk-about">
                            About TUP
                            <svg class="site-nav__chevron" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul id="desk-about" class="site-nav__panel" hidden>
                            <li><a href="{{ route('about.history') }}">TUP History</a></li>
                            <li><a href="{{ route('about.mission') }}">Mission &amp; Vision</a></li>
                            <li><a href="{{ route('about.mandate') }}">The TUP Mandate</a></li>
                            <li><a href="{{ route('about.hymn') }}">The TUP Hymn</a></li>
                            <li><a href="{{ route('officials') }}">Officials</a></li>
                            <li><a href="{{ route('transparency_seal') }}">Transparency Seal</a></li>
                        </ul>
                    </li>
                    <li class="site-nav__item">
                        <button type="button" class="site-nav__trigger" data-site-submenu aria-expanded="false"
                            aria-controls="desk-admission">
                            Admission
                            <svg class="site-nav__chevron" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul id="desk-admission" class="site-nav__panel" hidden>
                            <li><a href="{{ route('admissions.enrollment') }}">Freshmen Admission (TUPSTAT)</a></li>
                            <li><a href="https://ers.tup.edu.ph/aims/applicants/" target="_blank"
                                    rel="noopener noreferrer">Apply on ERS</a></li>
                            <li><a href="{{ route('contact') }}">Contact Information</a></li>
                        </ul>
                    </li>
                    <li class="site-nav__item">
                        <button type="button" class="site-nav__trigger" data-site-submenu aria-expanded="false"
                            aria-controls="desk-students">
                            Students
                            <svg class="site-nav__chevron" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul id="desk-students" class="site-nav__panel" hidden>
                            <li><a href="{{ route('student_services') }}">Student Services</a></li>
                            <li><a href="{{ route('student_services') }}#osa">Office of Student Affairs</a></li>
                            <li><a href="{{ route('admissions.enrollment') }}">Enrollment Procedure</a></li>
                            <li><a href="{{ route('sit') }}">Supervised Industrial Training (SIT)</a></li>
                        </ul>
                    </li>
                    <li class="site-nav__item">
                        <button type="button" class="site-nav__trigger" data-site-submenu aria-expanded="false"
                            aria-controls="desk-academics">
                            Academics
                            <svg class="site-nav__chevron" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul id="desk-academics" class="site-nav__panel" hidden>
                            <li><a href="{{ route('academics') }}">Academics overview</a></li>
                            <li>
                                <a href="{{ route('academics.undergraduate') }}">Undergraduate Programs</a>
                            </li>
                            @if (isset($navbarCollegePages) && $navbarCollegePages->count())
                                @foreach ($navbarCollegePages as $college)
                                    <li class="site-nav__nested">
                                        <a href="{{ route('academics.show', $college->routeSlug()) }}">{{ $college->college }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="site-nav__item">
                        <button type="button" class="site-nav__trigger" data-site-submenu aria-expanded="false"
                            aria-controls="desk-updates">
                            Updates
                            <svg class="site-nav__chevron" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <ul id="desk-updates" class="site-nav__panel" hidden>
                            <li><a href="{{ route('news_events') }}">News &amp; Events</a></li>
                            <li><a href="{{ route('announcements.index') }}">Announcements</a></li>
                            <li><a href="{{ route('directors.corner') }}">Director's Corner</a></li>
                        </ul>
                    </li>
                    @if ($showProcurement)
                        <li class="site-nav__item">
                            <button type="button" class="site-nav__trigger" data-site-submenu aria-expanded="false"
                                aria-controls="desk-procurement">
                                Procurement
                                <svg class="site-nav__chevron" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M7 10l5 5 5-5H7z" />
                                </svg>
                            </button>
                            <ul id="desk-procurement" class="site-nav__panel" hidden>
                                <li><a href="https://www.philgeps.gov.ph/" target="_blank" rel="noopener noreferrer">PhilGEPS
                                        Posting</a></li>
                                <li><a href="{{ route('procurement.bid') }}">Bid Opportunities</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="site-nav__item">
                        <button type="button" class="site-nav__trigger" data-site-submenu aria-expanded="false"
                            aria-controls="desk-resources">
                            Resources &amp; Offices
                            <svg class="site-nav__chevron" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 10l5 5 5-5H7z" />
                            </svg>
                        </button>
                        <div id="desk-resources" class="site-nav__mega" hidden>
                            <div class="site-nav__mega-grid">
                                <div>
                                    <h3>Administration</h3>
                                    <ul>
                                        <li><a href="{{ route('officials') }}">Board of Regents</a></li>
                                        <li><a href="{{ route('directors.corner') }}">Office of the Director</a></li>
                                        <li><a href="{{ route('adre') }}">Assistant Director for Research &amp; Extension</a></li>
                                        <li><a href="{{ route('human-resources') }}">Human Resources</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3>Support Services</h3>
                                    <ul>
                                        <li><a href="{{ route('technology') }}">University IT Center</a></li>
                                        <li><a href="{{ route('student_services') }}">Student Services</a></li>
                                        <li><a href="{{ route('library') }}">Library</a></li>
                                        <li><a href="{{ route('sit') }}">Supervised Industrial Training (SIT)</a></li>
                                        <li><a href="{{ route('campus.tour') }}">Campus Tour</a></li>
                                        <li><a href="{{ route('facilities') }}">Facilities</a></li>
                                        <li><a href="{{ route('contact') }}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        @else
            <nav class="site-nav" aria-label="Account">
                <ul class="site-nav__list">
                    <li class="site-nav__item">
                        <form method="POST" action="{{ route('logout') }}" class="site-nav__logout-form">
                            @csrf
                            <button type="submit" class="site-nav__logout">Log out</button>
                        </form>
                    </li>
                </ul>
            </nav>
        @endunless

        @unless ($isAdmin)
            <button type="button" class="site-nav-toggle" id="site-nav-open" aria-expanded="false"
                aria-controls="site-drawer" aria-label="Open menu">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z" />
                </svg>
            </button>
        @endunless
    </div>

    @unless ($isAdmin)
        <a href="{{ route('login') }}" class="site-cta">Portal Login</a>
    @endunless
</div>

@unless ($isAdmin)
    <div class="site-drawer-overlay" id="site-drawer-overlay" aria-hidden="true"></div>
    <aside class="site-drawer" id="site-drawer" aria-label="Mobile navigation">
        <div class="site-drawer__head">
            <span class="site-drawer__title">Menu</span>
            <button type="button" class="site-drawer__close" id="site-nav-close" aria-label="Close menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </div>
        <div class="site-drawer__body">
            <a class="site-drawer__home" href="{{ route('home') }}">Home</a>

            <details>
                <summary>About TUP</summary>
                <ul class="site-drawer__sub">
                    <li><a href="{{ route('about.history') }}">TUP History</a></li>
                    <li><a href="{{ route('about.mission') }}">Mission &amp; Vision</a></li>
                    <li><a href="{{ route('about.mandate') }}">The TUP Mandate</a></li>
                    <li><a href="{{ route('about.hymn') }}">The TUP Hymn</a></li>
                    <li><a href="{{ route('officials') }}">Officials</a></li>
                    <li><a href="{{ route('transparency_seal') }}">Transparency Seal</a></li>
                </ul>
            </details>
            <details>
                <summary>Admission</summary>
                <ul class="site-drawer__sub">
                    <li><a href="{{ route('admissions.enrollment') }}">Freshmen Admission (TUPSTAT)</a></li>
                    <li><a href="https://ers.tup.edu.ph/aims/applicants/" target="_blank"
                            rel="noopener noreferrer">Apply on ERS</a></li>
                    <li><a href="{{ route('contact') }}">Contact Information</a></li>
                </ul>
            </details>
            <details>
                <summary>Students</summary>
                <ul class="site-drawer__sub">
                    <li><a href="{{ route('student_services') }}">Student Services</a></li>
                    <li><a href="{{ route('student_services') }}#osa">Office of Student Affairs</a></li>
                    <li><a href="{{ route('admissions.enrollment') }}">Enrollment Procedure</a></li>
                    <li><a href="{{ route('sit') }}">Supervised Industrial Training (SIT)</a></li>
                </ul>
            </details>
            <details>
                <summary>Academics</summary>
                <ul class="site-drawer__sub">
                    <li><a href="{{ route('academics') }}">Academics overview</a></li>
                    <li><a href="{{ route('academics.undergraduate') }}">Undergraduate Programs</a></li>
                    @if (isset($navbarCollegePages) && $navbarCollegePages->count())
                        @foreach ($navbarCollegePages as $college)
                            <li class="site-drawer__nested-link">
                                <a href="{{ route('academics.show', $college->routeSlug()) }}">{{ $college->college }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </details>
            <details>
                <summary>Updates</summary>
                <ul class="site-drawer__sub">
                    <li><a href="{{ route('news_events') }}">News &amp; Events</a></li>
                    <li><a href="{{ route('announcements.index') }}">Announcements</a></li>
                    <li><a href="{{ route('directors.corner') }}">Director's Corner</a></li>
                </ul>
            </details>
            @if ($showProcurement)
                <details>
                    <summary>Procurement</summary>
                    <ul class="site-drawer__sub">
                        <li><a href="https://www.philgeps.gov.ph/" target="_blank" rel="noopener noreferrer">PhilGEPS
                                Posting</a></li>
                        <li><a href="{{ route('procurement.bid') }}">Bid Opportunities</a></li>
                    </ul>
                </details>
            @endif
            <details>
                <summary>Resources &amp; Offices</summary>
                <ul class="site-drawer__sub">
                    <li><a href="{{ route('directors.corner') }}">Office of the Director</a></li>
                    <li><a href="{{ route('adre') }}">Assistant Director for Research &amp; Extension</a></li>
                    <li><a href="{{ route('human-resources') }}">Human Resources</a></li>
                    <li><a href="{{ route('technology') }}">University IT Center</a></li>
                    <li><a href="{{ route('student_services') }}">Student Services</a></li>
                    <li><a href="{{ route('library') }}">Library</a></li>
                    <li><a href="{{ route('sit') }}">Supervised Industrial Training (SIT)</a></li>
                    <li><a href="{{ route('campus.tour') }}">Campus Tour</a></li>
                    <li><a href="{{ route('facilities') }}">Facilities</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </details>
        </div>
    </aside>
@endunless
