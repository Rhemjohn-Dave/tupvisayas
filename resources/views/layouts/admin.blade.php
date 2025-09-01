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
            // Sidebar toggle functionality
            var toggle = document.getElementById('adminMenuToggle');
            var sidebar = document.querySelector('.admin-sidebar');
            var overlay = document.querySelector('.admin-sidebar-overlay');

            if (toggle && sidebar && overlay) {
                // Toggle sidebar on button click
                toggle.addEventListener('click', function (e) {
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
        });
    </script>
    @yield('admin_scripts')
@endsection