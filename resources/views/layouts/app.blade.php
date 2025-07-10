<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TUP Visayas') }}</title>
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Cardinal Red Theme -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @yield('head')
</head>

<body>
    <!-- Navbar -->
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
    <nav class="z-depth-1 white">
        <div class="nav-wrapper container">
            <a href="/" class="brand-logo" style="color:#C41E3A; display: flex; align-items: center; height: 56px;">
                <img src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas Logo"
                    style="height:44px; margin-right:12px;">
                <span style="font-size:1.5rem; font-weight:600; line-height:1;">TUP Visayas</span>
            </a>
            <ul class="right">
                @auth
                    @if(auth()->user()->is_admin)
                        <li><a href="{{ route('admin.dashboard') }}" style="color: #C41E3A !important;">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-flat"
                                    style="color: #C41E3A !important; background: none; border: none; padding: 0 15px; height: 56px; line-height: 56px; text-transform: none; font-size: 1rem; cursor: pointer;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('programs') }}">Programs</a></li>
                        <li><a href="{{ route('admissions') }}">Admissions</a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="categories-dropdown">Categories<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-trigger" href="#!" data-target="more-dropdown">More<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                    @endif
                @else
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('programs') }}">Programs</a></li>
                    <li><a href="{{ route('admissions') }}">Admissions</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target="categories-dropdown">Categories<i
                                class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target="more-dropdown">More<i
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
</body>

</html>