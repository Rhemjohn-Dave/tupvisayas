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

    <button type="button" class="site-scroll-top" id="scrollTopBtn" aria-label="Back to top">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z" />
        </svg>
    </button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="{{ asset('js/navbar.init.js?v=' . time()) }}"></script>
    <script src="{{ asset('js/site-nav.js?v=' . time()) }}" defer></script>

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
    <script src="https://cdn.tiny.cloud/1/hs2vg824j6roaf09c4zbod91ua2vy8gy4slpjztc5rjuosx6/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.wysiwyg',
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
                    menubar: false,
                    height: 350,
                    init_instance_callback: function(editor) {
                        var textarea = editor.getElement();
                        if (!textarea) return;

                        if (textarea.hasAttribute('required')) {
                            textarea.removeAttribute('required');
                            textarea.setAttribute('data-wysiwyg-required', 'true');
                        }
                    }
                });
            }

            document.addEventListener('submit', function(event) {
                var form = event.target;
                if (!(form instanceof HTMLFormElement)) return;
                if (!form.querySelector('textarea.wysiwyg')) return;

                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }

                var requiredFields = form.querySelectorAll('textarea.wysiwyg[data-wysiwyg-required]');
                for (var i = 0; i < requiredFields.length; i++) {
                    var field = requiredFields[i];
                    var plainText = field.value
                        .replace(/<[^>]+>/g, '')
                        .replace(/&nbsp;/gi, ' ')
                        .trim();

                    if (!plainText) {
                        event.preventDefault();
                        var editor = typeof tinymce !== 'undefined' ? tinymce.get(field.id) : null;
                        if (editor) {
                            editor.focus();
                        } else {
                            field.focus();
                        }
                        return;
                    }
                }
            }, true);
        });
    </script>
</body>

</html>
