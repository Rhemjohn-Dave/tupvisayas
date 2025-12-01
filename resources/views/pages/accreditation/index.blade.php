@extends('layouts.app')

@section('title', 'Program Accreditation - TUP Visayas')

@section('content')
    <div class="section">
        <h3 style="color:#C41E3A;font-weight:700;">Program Accreditation</h3>
        <p class="grey-text text-darken-1">
            Select a program to view its accreditation information. A password will be required for each program.
        </p>

        @php
            $grouped = $courses->groupBy(function ($course) {
                return optional($course->collegePage)->college ?? 'Other Programs';
            });
        @endphp

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
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection