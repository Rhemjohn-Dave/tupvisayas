@extends('layouts.app')

@section('body_class', 'admin')

@section('head')
    <link href="{{ asset('css/admin.css?v=' . time()) }}" rel="stylesheet">
    @yield('admin_head')
@endsection

@section('content')
    <!-- Include sidebar component -->
    @include('admin.sidebar')

    <div class="admin-main">
        <!-- Mobile menu toggle -->
        <button class="admin-toggle-btn hide-on-large-only" id="adminMenuToggle">
            <i class="material-icons">menu</i>
        </button>

        @yield('admin_content')
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile sidebar toggle functionality
            var mobileToggle = document.getElementById('adminMenuToggle');
            var sidebar = document.querySelector('.admin-sidebar');
            var overlay = document.querySelector('.admin-sidebar-overlay');

            if (mobileToggle && sidebar && overlay) {
                // Toggle sidebar on mobile button click
                mobileToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    sidebar.classList.toggle('open');
                    overlay.classList.toggle('active');
                });

                // Close sidebar when clicking overlay
                overlay.addEventListener('click', function () {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                });
            }

            // Desktop sidebar collapse functionality
            var collapseToggle = document.getElementById('sidebarToggle');
            var expandToggle = document.getElementById('expandToggle');

            function toggleSidebar() {
                sidebar.classList.toggle('collapsed');
                document.body.classList.toggle('sidebar-collapsed');

                // Save state to localStorage
                var isNowCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('adminSidebarCollapsed', isNowCollapsed);
            }

            if (collapseToggle && sidebar) {
                // Check for saved state in localStorage
                var isCollapsed = localStorage.getItem('adminSidebarCollapsed') === 'true';
                if (isCollapsed) {
                    sidebar.classList.add('collapsed');
                    document.body.classList.add('sidebar-collapsed');
                }

                // Toggle sidebar collapse on desktop (collapse button)
                collapseToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    toggleSidebar();
                });
            }

            if (expandToggle && sidebar) {
                // Toggle sidebar expand on desktop (expand button)
                expandToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    toggleSidebar();
                });
            }
        });
    </script>
    @yield('admin_scripts')
@endsection