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

    <!-- Clean navbar CSS fix -->
    <style>
        /* Utility Bar Styles */
        .utility-bar {
            background-color: #424242;
            color: white;
            padding: 8px 0;
            font-size: 0.85rem;
        }

        .utility-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .utility-bar .left-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .utility-bar .right-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .utility-bar .gov-logos {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .utility-bar .gov-logos img {
            height: 24px;
            width: auto;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .utility-bar .gov-logos img:hover {
            opacity: 1;
        }

        .utility-bar .nav-links {
            display: flex !important;
            gap: 20px !important;
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
            justify-content: flex-end !important;
        }

        .utility-bar .nav-links a {
            color: white !important;
            text-decoration: none !important;
            transition: color 0.3s ease !important;
            font-weight: 400 !important;
        }

        .utility-bar .nav-links a:hover {
            color: #ffffff !important;
        }

        /* Responsive adjustments for utility bar */
        @media (max-width: 768px) {
            .utility-bar .container {
                flex-direction: column !important;
                gap: 10px !important;
            }

            .utility-bar .nav-links {
                flex-wrap: wrap !important;
                justify-content: flex-start !important;
                gap: 15px !important;
                text-align: left !important;
            }

            .utility-bar .gov-logos {
                gap: 8px;
            }

            .utility-bar .gov-logos img {
                height: 20px;
            }
        }

        @media (max-width: 480px) {
            .utility-bar {
                font-size: 0.8rem;
            }

            .utility-bar .nav-links {
                gap: 10px;
            }
        }

        /* Navbar logo and text sizing */
        nav.z-depth-1.white .brand-logo {
            display: flex !important;
            align-items: center !important;
            height: 56px !important;
            padding: 0 !important;
        }

        nav.z-depth-1.white .brand-logo img {
            height: 44px !important;
            max-height: 44px !important;
            margin-right: 8px !important;
            width: auto !important;
        }

        /* Desktop text size */
        nav.z-depth-1.white .brand-logo span.hide-on-small-only {
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            line-height: 1 !important;
        }

        /* Mobile text size */
        nav.z-depth-1.white .brand-logo span.hide-on-med-and-up {
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            line-height: 1 !important;
        }

        /* Navigation links */
        nav.z-depth-1.white .nav-wrapper .right>li>a {
            line-height: 56px !important;
            height: 56px !important;
            display: flex !important;
            align-items: center !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            text-transform: none !important;
            padding: 0 12px !important;
            margin: 0 !important;
            transition: all 0.3s ease !important;
            white-space: nowrap !important;
        }

        /* Hover effect for navigation links */
        nav.z-depth-1.white .nav-wrapper .right>li>a:hover {
            background-color: rgba(196, 30, 58, 0.1) !important;
            color: #C41E3A !important;
        }

        /* Fix navbar alignment and spacing */
        nav.z-depth-1.white .nav-wrapper {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        /* Ensure logo stays on the very left edge */
        nav.z-depth-1.white .brand-logo {
            flex-shrink: 0 !important;
            margin-right: auto !important;
            margin-left: 0 !important;
            padding-left: 15px !important;
            order: 1 !important;
        }

        nav.z-depth-1.white .nav-wrapper .right {
            display: flex !important;
            align-items: center !important;
            gap: 0 !important;
            margin: 0 !important;
            margin-left: auto !important;
            padding-right: 20px !important;
            flex-wrap: nowrap !important;
            order: 2 !important;
            justify-content: flex-end !important;
        }

        nav.z-depth-1.white .nav-wrapper .right li {
            margin: 0 !important;
            list-style: none !important;
            flex-shrink: 0 !important;
        }

        /* Improve spacing between nav items */
        nav.z-depth-1.white .nav-wrapper .right li {
            margin: 0 4px !important;
        }

        nav.z-depth-1.white .nav-wrapper .right li:first-child {
            margin-left: 0 !important;
        }

        nav.z-depth-1.white .nav-wrapper .right li:last-child {
            margin-right: 0 !important;
        }

        /* Fix hamburger menu positioning */
        nav.z-depth-1.white .sidenav-trigger {
            margin-right: 15px !important;
            margin-left: 0 !important;
            order: 0 !important;
        }

        /* Ensure proper mobile layout */
        @media (max-width: 992px) {
            nav.z-depth-1.white .nav-wrapper {
                justify-content: flex-start !important;
            }

            nav.z-depth-1.white .brand-logo {
                margin-right: 0 !important;
                margin-left: auto !important;
            }

            nav.z-depth-1.white .nav-wrapper .right {
                margin-left: 0 !important;
                padding-right: 0 !important;
            }
        }

        /* Ensure proper spacing for mobile */
        @media (max-width: 992px) {
            nav.z-depth-1.white .brand-logo {
                margin-left: auto !important;
                padding-left: 0 !important;
            }

            nav.z-depth-1.white .nav-wrapper .right {
                padding-right: 10px !important;
            }

            nav.z-depth-1.white .nav-wrapper .right li {
                margin: 0 2px !important;
            }

            nav.z-depth-1.white .nav-wrapper .right>li>a {
                padding: 0 8px !important;
                font-size: 0.9rem !important;
            }
        }

        /* Extra small screens */
        @media (max-width: 600px) {
            nav.z-depth-1.white .nav-wrapper .right li {
                margin: 0 1px !important;
            }

            nav.z-depth-1.white .nav-wrapper .right>li>a {
                padding: 0 6px !important;
                font-size: 0.85rem !important;
            }
        }

        /* Resources and Offices Multi-column Dropdown */
        .resources-dropdown {
            width: 600px !important;
            max-width: 90vw !important;
            display: flex !important;
            flex-direction: row !important;
            padding: 20px !important;
        }

        .dropdown-column {
            flex: 1;
            margin: 0 10px;
        }

        .dropdown-header {
            font-weight: 600;
            font-size: 1rem;
            color: #333;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e0e0e0;
        }

        .dropdown-sublist {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .dropdown-sublist li {
            margin-bottom: 5px;
        }

        .dropdown-sublist a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 5px 0;
            display: block;
            transition: color 0.3s ease;
        }

        .dropdown-sublist a:hover {
            color: #C41E3A;
        }

        /* Ensure dropdowns are properly positioned */
        .dropdown-content {
            z-index: 1000 !important;
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            display: none !important;
            background: white !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2) !important;
            border-radius: 4px !important;
            min-width: 200px !important;
        }

        /* Show dropdown when active */
        .dropdown-content.active {
            display: block !important;
        }

        /* Fix dropdown trigger positioning */
        .dropdown-trigger {
            position: relative !important;
            cursor: pointer !important;
        }

        /* Ensure dropdown content is properly styled */
        .dropdown-content li {
            clear: both;
            color: rgba(0, 0, 0, 0.87);
            cursor: pointer;
            min-height: 50px;
            line-height: 1.5rem;
            width: 100%;
            text-align: left;
            text-transform: none;
        }

        .dropdown-content li>a,
        .dropdown-content li>span {
            font-size: 16px;
            color: #26a69a;
            display: block;
            line-height: 22px;
            padding: 14px 16px;
        }

        .dropdown-content li>a:hover,
        .dropdown-content li>span:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Hide desktop navbar on mobile */
        @media (max-width: 992px) {

            /* Hide all desktop menu items */
            .hide-on-med-and-down {
                display: none !important;
            }

            /* Specifically hide the right menu - override existing CSS */
            nav.z-depth-1.white .nav-wrapper .right {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
                height: 0 !important;
                overflow: hidden !important;
            }

            /* Override existing navbar wrapper CSS for mobile */
            nav.z-depth-1.white .nav-wrapper {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            /* Make sure hamburger is visible */
            nav.z-depth-1.white .sidenav-trigger {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
            }

            /* Override existing brand logo CSS for mobile */
            nav.z-depth-1.white .brand-logo {
                flex: 1 !important;
                text-align: center !important;
                margin: 0 !important;
                margin-right: auto !important;
                margin-left: 0 !important;
                padding-left: 15px !important;
                order: 1 !important;
            }
        }

        /* Mobile dropdown styling */
        .sidenav .dropdown-content {
            position: static !important;
            display: none !important;
            box-shadow: none !important;
            background: rgba(0, 0, 0, 0.05) !important;
            margin-left: 20px !important;
            border-radius: 0 !important;
            min-width: auto !important;
        }

        .sidenav .dropdown-content.active {
            display: block !important;
        }

        .sidenav .dropdown-content li {
            margin: 0 !important;
        }

        .sidenav .dropdown-content a {
            padding: 10px 15px !important;
            color: #666 !important;
            font-size: 0.9rem !important;
        }

        .sidenav .dropdown-content a:hover {
            background-color: rgba(196, 30, 58, 0.1) !important;
            color: #C41E3A !important;
        }

        /* Nested Dropdown Styling */
        .dropdown-content .dropdown-content {
            position: absolute;
            left: 100%;
            top: 0;
            min-width: 200px;
            z-index: 1001;
        }

        .dropdown-content li:hover .dropdown-content {
            display: block;
        }

        /* Fix dropdown trigger positioning */
        .dropdown-trigger {
            cursor: pointer;
        }

        /* Mobile responsive for resources dropdown */
        @media (max-width: 768px) {
            .resources-dropdown {
                width: 100% !important;
                flex-direction: column !important;
                padding: 15px !important;
            }

            .dropdown-column {
                margin: 0 0 20px 0;
            }
        }

        /* Accessibility improvements */
        .dropdown-trigger:focus {
            outline: none;
        }

        .dropdown-content a:focus {
            background-color: #f5f5f5;
            outline: none;
        }

        /* Remove focus outline from all navigation elements */
        nav a:focus,
        nav button:focus,
        .brand-logo:focus {
            outline: none !important;
        }

        /* Responsive adjustments */
        @media (max-width: 800px) {
            nav.z-depth-1.white .brand-logo span.hide-on-med-and-up {
                font-size: 1.1rem !important;
            }
        }

        @media (max-width: 600px) {
            nav.z-depth-1.white .brand-logo span.hide-on-med-and-up {
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
    <!-- Top Utility Bar -->
    <div class="utility-bar">
        <div class="container">
            <div class="left-section">
                <div class="gov-logos">
                    <a href="https://www.gov.ph" target="_blank"
                        title="Official Gazette of the Republic of the Philippines">
                        <img src="{{ asset('images/gov-ph-logo.svg') }}" alt="gov.ph">
                    </a>
                    <a href="https://ched.gov.ph" target="_blank" title="Commission on Higher Education">
                        <img src="{{ asset('images/ched-logo.png') }}" alt="CHED">
                    </a>
                </div>
            </div>
            <div class="right-section">
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('transparency_seal') }}">Transparency Seal</a></li>
                    <li><a href="https://www.foi.gov.ph/agencies/tup/" target="_blank">Freedom of Information</a>
                    </li>
                    <li><a href="https://drive.google.com/file/d/1u_I6kqTajs8CYbA7dKqp3LqL4NgPxL6w/view?usp=drive_link"
                            target="_blank">Citizen's Charter</a></li>
                    <li><a href="{{ route('jobs') }}">Careers</a></li>
                    <li><a href="https://www.gov.ph/feedback" target="_blank">Feedback</a></li>
                    <li><a href="https://www.gov.ph/contact" target="_blank">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sidenav for mobile -->
    <ul class="sidenav" id="mobile-nav">
        <li><a href="{{ route('home') }}">Home</a></li>

        <!-- About TUP -->
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

        <!-- Admission -->
        <li>
            <a class="dropdown-trigger" href="#" data-target="admission-mobile-dropdown">Admission<i
                    class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="admission-mobile-dropdown" class="dropdown-content">
            <li><a href="#">Graduate Programs</a></li>
            <li><a href="#">Undergraduate Programs</a></li>
            <li><a href="#">Enrollment Procedure for Freshmen Students</a></li>
            <li><a href="#">Contact Information</a></li>
        </ul>

        <!-- Students -->
        <li>
            <a class="dropdown-trigger" href="#" data-target="students-mobile-dropdown">Students<i
                    class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="students-mobile-dropdown" class="dropdown-content">
            <li><a href="#">The Office of Student Affairs</a></li>
            <li><a href="#">Student Organizations</a></li>
            <li><a href="#">Enrollment Procedure</a></li>
            <li><a href="#">TUP Student Handbook</a></li>
        </ul>

        <!-- Academics -->
        <li>
            <a class="dropdown-trigger" href="#" data-target="academics-mobile-dropdown">Academics<i
                    class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="academics-mobile-dropdown" class="dropdown-content">
            <li><a href="{{ route('academics.coe') }}">College of Engineering</a></li>
            <li><a href="{{ route('academics.coac') }}">College of Automation and Control</a></li>
            <li><a href="{{ route('academics.coet') }}">College of Engineering Technology</a></li>
        </ul>

        <!-- Updates -->
        <li>
            <a class="dropdown-trigger" href="#" data-target="updates-mobile-dropdown">Updates<i
                    class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="updates-mobile-dropdown" class="dropdown-content">
            <li><a href="{{ route('news_events') }}">News and Events</a></li>
            <li><a href="{{ route('announcements.index') }}">Announcements</a></li>
            <li><a href="#">Director's Corner</a></li>
        </ul>

        <!-- Resources and Offices -->
        <li>
            <a class="dropdown-trigger" href="#" data-target="resources-mobile-dropdown">Resources and Offices<i
                    class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="resources-mobile-dropdown" class="dropdown-content">
            <li>
                <a class="dropdown-trigger" href="#" data-target="administration-mobile-dropdown">Administration<i
                        class="material-icons right">arrow_drop_down</i></a>
            </li>
            <li>
                <a class="dropdown-trigger" href="#" data-target="support-services-mobile-dropdown">Support Services<i
                        class="material-icons right">arrow_drop_down</i></a>
            </li>
        </ul>

        <!-- Administration Mobile Sub-dropdown -->
        <ul id="administration-mobile-dropdown" class="dropdown-content">
            <li><a href="#">Board of Regents</a></li>
            <li><a href="#">Office of the Director</a></li>
            <li><a href="#">Assistant Director for Administration and Finance</a></li>
            <li><a href="#">Assistant Director for Academic Affairs</a></li>
            <li><a href="#">Assistant Director for Research and Finance</a></li>
        </ul>


        <!-- Support Services Mobile Sub-dropdown -->
        <ul id="support-services-mobile-dropdown" class="dropdown-content">
            <li><a href="#">University Registrar</a></li>
            <li><a href="#">University Medical and Dental Clinic</a></li>
            <li><a href="#">Supervised Industrial Training</a></li>
            <li><a href="#">University Information Technology Center</a></li>
            <li><a href="#">University Library</a></li>
        </ul>

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

    <!-- About TUP Dropdown -->
    <ul id="about-dropdown" class="dropdown-content">
        <li><a href="{{ route('about.history') }}">TUP History</a></li>
        <li><a href="{{ route('about.mission') }}">TUP Mission Vision</a></li>
        <li><a href="{{ route('about.mandate') }}">The TUP Mandate</a></li>
        <li><a href="{{ route('about.hymn') }}">The TUP Hymn</a></li>
    </ul>

    <!-- Admission Dropdown -->
    <ul id="admission-dropdown" class="dropdown-content">
        <li><a href="#">Graduate Programs</a></li>
        <li><a href="#">Undergraduate Programs</a></li>
        <li><a href="#">Enrollment Procedure for Freshmen Students</a></li>
        <li><a href="#">Contact Information</a></li>
    </ul>

    <!-- Students Dropdown -->
    <ul id="students-dropdown" class="dropdown-content">
        <li><a href="#">The Office of Student Affairs</a></li>
        <li><a href="#">Student Organizations</a></li>
        <li><a href="#">Enrollment Procedure</a></li>
        <li><a href="#">TUP Student Handbook</a></li>
    </ul>

    <!-- Academics Dropdown -->
    <ul id="academics-dropdown" class="dropdown-content">
        <li><a href="{{ route('academics.coe') }}">College of Engineering</a></li>
        <li><a href="{{ route('academics.coac') }}">College of Automation and Control</a></li>
        <li><a href="{{ route('academics.coet') }}">College of Engineering Technology</a></li>
    </ul>

    <!-- Updates Dropdown -->
    <ul id="updates-dropdown" class="dropdown-content">
        <li><a href="{{ route('news_events') }}">News and Events</a></li>
        <li><a href="{{ route('announcements.index') }}">Announcements</a></li>
        <li><a href="#">Director's Corner</a></li>
    </ul>

    <!-- Resources and Offices Dropdown -->
    <ul id="resources-dropdown" class="dropdown-content resources-dropdown">
        <li class="dropdown-column">
            <h6 class="dropdown-header">Administration</h6>
            <ul class="dropdown-sublist">
                <li><a href="#">Board of Regents</a></li>
                <li><a href="#">Office of the Director</a></li>
                <li><a href="#">Assistant Director for Administration and Finance</a></li>
                <li><a href="#">Assistant Director for Academic Affairs</a></li>
                <li><a href="#">Assistant Director for Research and Finance</a></li>
            </ul>
        </li>
        <li class="dropdown-column">
            <h6 class="dropdown-header">Support Services</h6>
            <ul class="dropdown-sublist">
                <li><a href="#">University Registrar</a></li>
                <li><a href="#">University Medical and Dental Clinic</a></li>
                <li><a href="#">Supervised Industrial Training</a></li>
                <li><a href="#">University Information Technology Center</a></li>
                <li><a href="#">University Library</a></li>
            </ul>
        </li>
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
                        <!-- About TUP -->
                        <li>
                            <a class="dropdown-trigger" href="#" data-target="about-dropdown">About TUP<i
                                    class="material-icons right">arrow_drop_down</i></a>
                        </li>

                        <!-- Admission -->
                        <li>
                            <a class="dropdown-trigger" href="#" data-target="admission-dropdown">Admission<i
                                    class="material-icons right">arrow_drop_down</i></a>
                        </li>

                        <!-- Students -->
                        <li>
                            <a class="dropdown-trigger" href="#" data-target="students-dropdown">Students<i
                                    class="material-icons right">arrow_drop_down</i></a>
                        </li>

                        <!-- Academics -->
                        <li>
                            <a class="dropdown-trigger" href="#" data-target="academics-dropdown">Academics<i
                                    class="material-icons right">arrow_drop_down</i></a>
                        </li>

                        <!-- Updates -->
                        <li>
                            <a class="dropdown-trigger" href="#" data-target="updates-dropdown">Updates<i
                                    class="material-icons right">arrow_drop_down</i></a>
                        </li>

                        <!-- Resources and Offices -->
                        <li>
                            <a class="dropdown-trigger" href="#" data-target="resources-dropdown">Resources and Offices<i
                                    class="material-icons right">arrow_drop_down</i></a>
                        </li>
                    @endif
                @else
                    <!-- About TUP -->
                    <li>
                        <a class="dropdown-trigger" href="#" data-target="about-dropdown">About TUP<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>

                    <!-- Admission -->
                    <li>
                        <a class="dropdown-trigger" href="#" data-target="admission-dropdown">Admission<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>

                    <!-- Students -->
                    <li>
                        <a class="dropdown-trigger" href="#" data-target="students-dropdown">Students<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>

                    <!-- Academics -->
                    <li>
                        <a class="dropdown-trigger" href="#" data-target="academics-dropdown">Academics<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>

                    <!-- Updates -->
                    <li>
                        <a class="dropdown-trigger" href="#" data-target="updates-dropdown">Updates<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>

                    <!-- Resources and Offices -->
                    <li>
                        <a class="dropdown-trigger" href="#" data-target="resources-dropdown">Resources and Offices<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>
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
            // Initialize sidenav
            var elems = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elems);

            // Initialize ALL dropdowns with Materialize (simple approach)
            var allDropdowns = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(allDropdowns, {
                coverTrigger: false,
                constrainWidth: false,
                hover: false,
                alignment: 'left',
                autoFocus: false,
                closeOnClick: true
            });

            // Scroll to top
            document.getElementById('scrollTopBtn').onclick = function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };
        });

        // Additional initialization if needed
        $(document).ready(function () {
            setTimeout(function () {
                var allDropdowns = document.querySelectorAll('.dropdown-trigger');
                M.Dropdown.init(allDropdowns, {
                    coverTrigger: false,
                    constrainWidth: false,
                    hover: false,
                    alignment: 'left',
                    autoFocus: false,
                    closeOnClick: true
                });
            }, 100);
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