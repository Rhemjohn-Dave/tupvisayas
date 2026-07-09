@extends('layouts.app')

@section('title', 'Program Accreditation - TUP Visayas')

@section('content')
    <div class="section">
<<<<<<< HEAD
        <h1 class="site-page-title">Program accreditation</h1>
        <p class="grey-text text-darken-1 site-prose">
=======
        <h3 style="color:#C41E3A;font-weight:700;">Program Accreditation</h3>
        <p class="grey-text text-darken-1">
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
            Select a program to view its accreditation information. A password will be required for each program.
        </p>

        @php
            $grouped = $courses->groupBy(function ($course) {
                return optional($course->collegePage)->college ?? 'Other Programs';
            });
        @endphp

<<<<<<< HEAD
        @foreach ($grouped as $collegeName => $collegeCourses)
            <div class="card site-stack-top">
                <div class="card-content">
                    <span class="card-title">{{ ucwords(str_replace('_', ' ', $collegeName)) }}</span>
                    <ul class="collection">
                        @foreach ($collegeCourses as $course)
                            <li class="collection-item site-list-row">
                                <span class="site-list-row__title">{{ $course->name }}</span>
                                <a href="{{ route('accreditation.course.show', $course) }}"
                                    class="btn waves-effect waves-light red darken-2">
                                    View accreditation
=======
        @foreach($grouped as $collegeName => $collegeCourses)
            <div class="card" style="margin-top: 1.5rem;">
                <div class="card-content">
                    <span class="card-title" style="color:#C41E3A;">
                        {{ ucwords(str_replace('_', ' ', $collegeName)) }}
                    </span>
                    <ul class="collection">
                        @foreach($collegeCourses as $course)
                            <li class="collection-item" style="display:flex;justify-content:space-between;align-items:center;">
                                <div>
                                    <span style="font-weight:600;">{{ $course->name }}</span>
                                </div>
                                <a href="{{ route('accreditation.course.show', $course) }}"
                                    class="btn waves-effect waves-light red darken-2">
                                    View Accreditation
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

<<<<<<< HEAD
    <div id="welcome-modal" class="modal">
        <div class="modal-content">
            <h2 class="site-section-title">Welcome to program accreditation</h2>
            <p class="grey-text text-darken-1 site-prose">
                This page provides access to accreditation information for all programs offered at TUP Visayas.
            </p>
            <p class="grey-text text-darken-1 site-prose">
                To view accreditation details for a specific program, please select it from the list below.
                A password will be required to access each program's accreditation documents.
            </p>
            <p class="grey-text text-darken-1 site-prose site-stack-top">
=======
    <!-- Welcome Modal -->
    <div id="welcome-modal" class="modal">
        <div class="modal-content">
            <h4 style="color:#C41E3A;font-weight:700;">Welcome to Program Accreditation</h4>
            <p class="grey-text text-darken-1">
                This page provides access to accreditation information for all programs offered at TUP Visayas.
            </p>
            <p class="grey-text text-darken-1">
                To view accreditation details for a specific program, please select it from the list below.
                A password will be required to access each program's accreditation documents.
            </p>
            <p class="grey-text text-darken-1" style="margin-top:1rem;">
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                <strong>Note:</strong> Accreditation documents include compliance reports, narrative profiles,
                technical reviews, and other relevant accreditation materials.
            </p>
        </div>
        <div class="modal-footer">
<<<<<<< HEAD
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Got it</a>
=======
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red-text">Got it</a>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        </div>
    </div>
@endsection

@section('scripts')
    <script>
<<<<<<< HEAD
        document.addEventListener('DOMContentLoaded', function() {
            var modalElem = document.getElementById('welcome-modal');
            if (!modalElem || typeof M === 'undefined') return;
            var modalInstance = M.Modal.init(modalElem, {
                dismissible: true,
            });
            modalInstance.open();
        });
    </script>
@endsection
=======
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize and open the welcome modal
            var modalElem = document.getElementById('welcome-modal');
            var modalInstance = M.Modal.init(modalElem, {
                dismissible: true,
                onCloseEnd: function () {
                    // Optional: Set a flag in localStorage to not show again
                    // localStorage.setItem('accreditation_welcome_seen', 'true');
                }
            });

            // Check if user has seen the modal before (optional)
            // Uncomment the lines below if you want to show it only once per browser
            // var hasSeenWelcome = localStorage.getItem('accreditation_welcome_seen');
            // if (!hasSeenWelcome) {
            //     modalInstance.open();
            // }

            // For now, always show the modal
            modalInstance.open();
        });
    </script>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
