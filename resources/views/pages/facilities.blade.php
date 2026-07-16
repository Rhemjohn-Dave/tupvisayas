@extends('layouts.app')

@section('title', 'Campus Facilities - TUP Visayas')

@section('content')
    <div class="section site-page site-page--facilities">
        <h1 class="site-page-title site-page-title--center">Campus facilities</h1>
        <p class="site-page-intro">Learning, research, and support spaces that serve students and faculty at TUP Visayas.</p>

        <ul class="mission-list">
            <li><strong>Library</strong> — Print and digital resources that support instruction, research, and independent study.</li>
            <li><strong>Engineering and technology laboratories</strong> — Hands-on laboratory spaces aligned with college programs in engineering, automation, and engineering technology.</li>
            <li><strong>Classrooms and lecture halls</strong> — Instructional rooms for theory classes, examinations, and academic activities.</li>
            <li><strong>Computer and IT facilities</strong> — Computing resources administered with support from the University IT Center.</li>
            <li><strong>Student activity and multipurpose spaces</strong> — Areas used for organization activities, assemblies, and campus events.</li>
            <li><strong>Administrative offices</strong> — Campus offices that support enrollment, records, and student services.</li>
        </ul>

        <p class="program-requirements__note facilities-note">Facility details and photos will be expanded as college units publish updates. For campus visits or specific laboratory inquiries, contact the relevant college or the campus through the contact page.</p>

        <div class="program-hero__actions program-hero__actions--center" role="group" aria-label="Related links">
            <a class="program-hero__cta" href="{{ route('academics') }}">Browse academics</a>
            <a class="program-hero__link" href="{{ route('contact') }}">Contact the campus</a>
        </div>
    </div>
@endsection
