<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TUP Visayas - Technological University of the Philippines Visayas')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/tup-logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="{{ asset('css/custom.css?v=' . time()) }}" rel="stylesheet">
    <link href="{{ asset('css/site.css?v=' . time()) }}" rel="stylesheet">

    @yield('head')
</head>

<body class="@yield('body_class')">
    <a class="site-skip" href="#site-main">Skip to main content</a>

    <header class="site-header">
        @include('layouts.partials.site-utility')
        @include('layouts.partials.site-navigation')
    </header>

    <main id="site-main" class="site-main site-content @yield('main_class', 'container')">
        @yield('content')
    </main>

    @include('layouts.partials.site-footer')

    @unless(request()->routeIs('admin.*'))
        @include('layouts.partials.privacy-consent')
    @endunless

    <button type="button" class="site-scroll-top" id="scrollTopBtn" aria-label="Back to top">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z" />
        </svg>
    </button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{ asset('js/navbar.init.js?v=' . time()) }}"></script>
    <script src="{{ asset('js/site-nav.js?v=' . time()) }}" defer></script>
    <script src="{{ asset('js/privacy-consent.js?v=' . time()) }}" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var scrollTopBtn = document.getElementById('scrollTopBtn');
            if (scrollTopBtn) {
                scrollTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>

    @yield('scripts')
    @if (request()->routeIs('admin.*'))
        <script>
            window.TUPV_ADMIN_EDITOR = {
                uploadUrl: @json(route('admin.editor.images')),
                csrfToken: @json(csrf_token())
            };
        </script>
        <script src="https://uicdn.toast.com/editor/3.2.2/toastui-editor-all.min.js"></script>
        <script src="{{ asset('js/admin-editor.js?v=' . time()) }}"></script>
    @endif
</body>

</html>
