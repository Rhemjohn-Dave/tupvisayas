@extends('layouts.app')

@section('main_class', 'admin-main-root')
@section('body_class', 'admin')

@section('head')
    {{-- Inter: readable UI font; Material Icons kept for sidebar/actions --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- Outlined icons in sidebar only (consistent weight with SaaS patterns) --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="{{ asset('css/admin.css?v=' . time()) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/3.2.2/toastui-editor.min.css">
    @yield('admin_head')
@endsection

@section('content')
    {{-- Admin app: sidebar | topbar + scrollable content --}}
    <div class="admin-app" id="adminApp">
        @include('admin.sidebar')

        <div class="admin-sidebar-overlay" id="adminSidebarOverlay" aria-hidden="true"></div>

        <div class="admin-shell">
            @include('admin.partials.topbar')

            <div class="admin-main">
                <div class="admin-content site-content">
                    {{-- Flash → toast (also visible as banner for no-JS) --}}
                    @if(session('success'))
                        <div class="admin-flash admin-flash--success" role="status" data-admin-flash>{{ session('success') }}</div>
                    @endif
                    @if(session('status'))
                        <div class="admin-flash admin-flash--success" role="status" data-admin-flash>{{ session('status') }}</div>
                    @endif

                    @yield('admin_content')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin-ui.js?v=' . time()) }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var menuToggle = document.getElementById('adminMenuToggle');
            var sidebar = document.getElementById('adminSidebar');
            var overlay = document.getElementById('adminSidebarOverlay');

            function isMobileSidebar() {
                return window.matchMedia('(max-width: 992px)').matches;
            }

            var railToggle = document.getElementById('sidebarRailToggle');

            function updateMenuToggleAria() {
                if (!menuToggle || !sidebar) return;
                if (isMobileSidebar()) {
                    var open = sidebar.classList.contains('open');
                    menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    menuToggle.setAttribute('aria-label', open ? 'Close navigation menu' : 'Open navigation menu');
                } else {
                    var collapsed = sidebar.classList.contains('collapsed');
                    menuToggle.setAttribute('aria-expanded', collapsed ? 'false' : 'true');
                    menuToggle.setAttribute('aria-label', collapsed ? 'Expand sidebar' : 'Collapse sidebar');
                }
            }

            function updateRailToggleAria() {
                if (!railToggle || !sidebar || isMobileSidebar()) return;
                var collapsed = sidebar.classList.contains('collapsed');
                railToggle.setAttribute('aria-label', collapsed ? 'Expand sidebar' : 'Collapse sidebar');
                railToggle.setAttribute('title', collapsed ? 'Widen sidebar' : 'Narrow sidebar');
            }

            function toggleDesktopCollapse() {
                if (!sidebar) return;
                var collapsed = sidebar.classList.toggle('collapsed');
                document.body.classList.toggle('sidebar-collapsed', collapsed);
                localStorage.setItem('adminSidebarCollapsed', collapsed ? 'true' : 'false');
                updateRailToggleAria();
            }

            function toggleMobileDrawer() {
                if (!sidebar || !overlay) return;
                var open = sidebar.classList.toggle('open');
                overlay.classList.toggle('active', open);
                overlay.setAttribute('aria-hidden', open ? 'false' : 'true');
            }

            if (menuToggle && sidebar && overlay) {
                menuToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (isMobileSidebar()) {
                        toggleMobileDrawer();
                    } else {
                        toggleDesktopCollapse();
                    }
                    updateMenuToggleAria();
                });

                overlay.addEventListener('click', function () {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                    overlay.setAttribute('aria-hidden', 'true');
                    updateMenuToggleAria();
                });

                if (localStorage.getItem('adminSidebarCollapsed') === 'true' && !isMobileSidebar()) {
                    sidebar.classList.add('collapsed');
                    document.body.classList.add('sidebar-collapsed');
                }
                updateMenuToggleAria();
                updateRailToggleAria();

                if (railToggle) {
                    railToggle.addEventListener('click', function (e) {
                        e.preventDefault();
                        if (isMobileSidebar()) return;
                        toggleDesktopCollapse();
                        updateMenuToggleAria();
                    });
                }

                window.addEventListener('resize', function () {
                    if (!isMobileSidebar()) {
                        sidebar.classList.remove('open');
                        overlay.classList.remove('active');
                        overlay.setAttribute('aria-hidden', 'true');
                    }
                    updateMenuToggleAria();
                    updateRailToggleAria();
                });
            }
        });
    </script>
    @yield('admin_scripts')
@endsection
