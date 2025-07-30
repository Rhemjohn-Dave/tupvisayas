<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TUP Visayas - Technological University of the Philippines Visayas')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/tup-logo.png') }}">
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Cardinal Red Theme -->
    <link href="{{ asset('css/custom.css?v=' . time()) }}" rel="stylesheet">

    <!-- Inline CSS to fix navbar sizing -->
    <style>
        /* Force navbar sizing with maximum specificity */
        body nav.z-depth-1.white .brand-logo {
            display: flex !important;
            align-items: center !important;
            height: 56px !important;
            padding: 0 !important;
            font-size: 1rem !important;
        }

        body nav.z-depth-1.white .brand-logo img {
            height: 44px !important;
            max-height: 44px !important;
            margin-right: 12px !important;
            vertical-align: middle !important;
            width: auto !important;
        }

        body nav.z-depth-1.white .brand-logo span {
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            line-height: 1 !important;
            color: #c41e3a !important;
        }

        body nav.z-depth-1.white .brand-logo span.hide-on-med-and-up {
            font-size: 1.1rem !important;
        }

        body nav.z-depth-1.white .nav-wrapper .right>li>a {
            line-height: 56px !important;
            height: 56px !important;
            display: flex !important;
            align-items: center !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            text-transform: none !important;
        }

        /* Override Materialize default styles */
        .brand-logo {
            font-size: 1.5rem !important;
        }

        .brand-logo span {
            font-size: 1.5rem !important;
        }

        /* Force smaller sizes */
        nav .brand-logo {
            font-size: 1.5rem !important;
        }

        nav .brand-logo span {
            font-size: 1.5rem !important;
        }

        /* Target specific elements with maximum specificity */
        html body nav.z-depth-1.white .brand-logo span.hide-on-small-only {
            font-size: 1.5rem !important;
        }

        html body nav.z-depth-1.white .brand-logo span.hide-on-med-and-up {
            font-size: 1.1rem !important;
        }

        /* Override any Materialize CSS */
        .brand-logo span.hide-on-small-only {
            font-size: 1.5rem !important;
        }

        .brand-logo span.hide-on-med-and-up {
            font-size: 1.1rem !important;
        }

        /* Responsive adjustments */
        @media (max-width: 800px) {
            body nav.z-depth-1.white .brand-logo span {
                font-size: 1.1rem !important;
            }

            .brand-logo span {
                font-size: 1.1rem !important;
            }

            html body nav.z-depth-1.white .brand-logo span.hide-on-med-and-up {
                font-size: 1.1rem !important;
            }
        }

        @media (max-width: 600px) {
            body nav.z-depth-1.white .brand-logo span {
                font-size: 1rem !important;
            }

            .brand-logo span {
                font-size: 1rem !important;
            }

            html body nav.z-depth-1.white .brand-logo span.hide-on-med-and-up {
                font-size: 1rem !important;
            }
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @yield('head')
</head>

<body>
    <!-- Sidenav for mobile -->
    <ul class="sidenav" id="mobile-nav">
        <li><a href="{{ route('home') }}">Home</a></li>
        <!-- Only About TUP dropdown, remove any single About TUP link -->
        <li>
            <a class="dropdown-trigger" href="#" data-target="about-mobile-dropdown">About TUP<i
                    class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="about-mobile-dropdown" class="dropdown-content">
            <li><a href="{{ route('about.history') }}">TUP History</a></li>
            <li><a href="{{ route('about.mission') }}">TUP Mission Vision</a></li>
            <li><a href="{{ route('about.mandate') }}">The TUP Mandate</a></li>
            <li><a href="{{ route('about.hymn') }}">The TUP Hymn</a></li>
        </ul>
        <li>
            <a class="dropdown-trigger" href="#" data-target="academics-mobile-dropdown">Academics<i
                    class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="academics-mobile-dropdown" class="dropdown-content">
            @php
                $collegePages = \App\Models\CollegePage::all();
            @endphp
            @foreach($collegePages as $college)
                <li><a
                        href="{{ url('/academics/' . $college->college) }}">{{ ucwords(str_replace('_', ' ', $college->college)) }}</a>
                </li>
            @endforeach
        </ul>
        <li><a href="{{ route('admissions') }}">Admissions</a></li>
        <li><a href="{{ route('facilities') }}">Facilities</a></li>
        <li><a href="{{ route('student_services') }}">Student Services</a></li>
        <li><a href="{{ route('officials') }}">Officials</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
        <li><a href="{{ route('announcements') }}">Announcements</a></li>
        <li><a href="{{ route('news_events') }}">News & Events</a></li>
        <li><a href="{{ route('jobs') }}">Job Listings</a></li>
        @auth
            @if(auth()->user()->is_admin)
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-flat"
                            style="color: #C41E3A !important; background: none; border: none; padding: 0 15px; height: 56px; line-height: 56px; text-transform: none; font-size: 1rem; cursor: pointer;">Logout</button>
                    </form>
                </li>
            @endif
        @endauth
    </ul>
    <!-- Dropdown Structures (only once, outside nav) -->
    <ul id="categories-dropdown" class="dropdown-content">
        <li><a href="{{ route('facilities') }}">Facilities</a></li>
        <li><a href="{{ route('student_services') }}">Student Services</a></li>
        <li><a href="{{ route('officials') }}">Officials</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
    <ul id="more-dropdown" class="dropdown-content">
        <li><a href="{{ route('announcements') }}">Announcements</a></li>
        <li><a href="{{ route('news_events') }}">News & Events</a></li>
        <li><a href="{{ route('jobs') }}">Job Listings</a></li>
    </ul>
    <!-- Academics Dropdown Structure -->
    <ul id="academics-dropdown" class="dropdown-content">
        @php
            $collegePages = \App\Models\CollegePage::all();
        @endphp
        @foreach($collegePages as $college)
            <li><a
                    href="{{ url('/academics/' . $college->college) }}">{{ ucwords(str_replace('_', ' ', $college->college)) }}</a>
            </li>
        @endforeach
    </ul>
    <ul id="about-dropdown" class="dropdown-content">
        <li><a href="{{ route('about.history') }}">TUP History</a></li>
        <li><a href="{{ route('about.mission') }}">TUP Mission Vision</a></li>
        <li><a href="{{ route('about.mandate') }}">The TUP Mandate</a></li>
        <li><a href="{{ route('about.hymn') }}">The TUP Hymn</a></li>
    </ul>
    <nav class="z-depth-1 white">
        <div class="nav-wrapper container">
            <!-- Hamburger icon for mobile -->
            <a href="#" data-target="mobile-nav" class="sidenav-trigger left" style="margin-right:10px;">
                <i class="material-icons" style="color:#C41E3A;">menu</i>
            </a>
            <a href="/" class="brand-logo" style="color:#C41E3A; display: flex; align-items: center; height: 56px;">
                <img src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas Logo" class="responsive-img"
                    style="height:44px; max-height:44px; margin-right:8px; max-width:40vw; width:auto;">
                <span class="hide-on-small-only"
                    style="font-size:1.5rem !important; font-weight:600; line-height:1;">TUP
                    Visayas</span>
                <span class="hide-on-med-and-up"
                    style="font-size:1.1rem !important; font-weight:600; line-height:1;">TUP
                    Visayas</span>
            </a>
            <ul class="right hide-on-med-and-down">

                @auth
                    @if(auth()->user()->is_admin)
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-flat"
                                    style="color: #C41E3A !important; background: none; border: none; padding: 0 15px; height: 56px; line-height: 56px; text-transform: none; font-size: 1rem; cursor: pointer;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <!-- Only About TUP dropdown, remove any single About TUP link -->
                        <li>
                            <a class="dropdown-trigger" href="#" data-target="about-dropdown">About TUP<i
                                    class="material-icons right">arrow_drop_down</i></a>
                        </li>
                        <li><a class="dropdown-trigger" href="#" data-target="academics-dropdown">Academics<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a href="{{ route('admissions') }}">Admissions</a></li>
                        <li><a class="dropdown-trigger" href="#" data-target="categories-dropdown">Categories<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-trigger" href="#" data-target="more-dropdown">More<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                    @endif
                @else
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <!-- Only About TUP dropdown, remove any single About TUP link -->
                    <li>
                        <a class="dropdown-trigger" href="#" data-target="about-dropdown">About TUP<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>
                    <li><a class="dropdown-trigger" href="#" data-target="academics-dropdown">Academics<i
                                class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a href="{{ route('admissions') }}">Admissions</a></li>
                    <li><a class="dropdown-trigger" href="#" data-target="categories-dropdown">Categories<i
                                class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a class="dropdown-trigger" href="#" data-target="more-dropdown">More<i
                                class="material-icons right">arrow_drop_down</i></a></li>
                @endauth
            </ul>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="container" style="min-height:70vh;">
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="page-footer white" style="padding-top:0;">
        <div class="container center-align">
            <img src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas Logo"
                style="height:40px;vertical-align:middle;">
            <p style="color:#C41E3A;">&copy; {{ date('Y') }} TUP Visayas. All rights reserved.</p>
            <p style="color:#888; font-size:0.95rem; margin-top:0.5rem;">Developed by UITC TUPV</p>
        </div>
    </footer>
    <!-- Scroll-to-top FAB -->
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large" id="scrollTopBtn"><i class="material-icons">arrow_upward</i></a>
    </div>
    <!-- Materialize JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elems);
            var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elemsDropdown, { coverTrigger: false, constrainWidth: false });
            // Scroll to top
            document.getElementById('scrollTopBtn').onclick = function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };
        });
    </script>
    @yield('scripts')
    <script src="https://cdn.tiny.cloud/1/hs2vg824j6roaf09c4zbod91ua2vy8gy4slpjztc5rjuosx6/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.wysiwyg',
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
                    menubar: false,
                    height: 350
                });
            }
        });
    </script>
</body>

</html>