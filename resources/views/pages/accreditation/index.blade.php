@extends('layouts.app')

@section('title', 'Program Accreditation - TUP Visayas')

@section('content')
    <div class="section">
        <h1 class="site-page-title">Program accreditation</h1>
        <p class="grey-text text-darken-1 site-prose">
            Select a program to view its accreditation information. A password will be required for each program.
        </p>

        @php
            $grouped = $courses->groupBy(function ($course) {
                return optional($course->collegePage)->college ?? 'Other Programs';
            });
        @endphp

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
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

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
                <strong>Note:</strong> Accreditation documents include compliance reports, narrative profiles,
                technical reviews, and other relevant accreditation materials.
            </p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Got it</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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
