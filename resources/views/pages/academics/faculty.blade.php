@extends('layouts.app')

@section('title', 'Faculty & Departments - ' . $collegePage->college . ' - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Program heads and faculty members of ' . $collegePage->college . ' at TUP Visayas.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Faculty & Departments - {{ $collegePage->college }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($collegePage->cover_photo)
        <meta property="og:image" content="{{ asset('storage/' . $collegePage->cover_photo) }}">
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
    @endif
@endsection

@section('content')
    <div class="site-page site-page--college site-page--college-faculty">
        @include('pages.academics.partials.college-masthead')

        <div class="college-body">
            @forelse ($collegePage->departments as $department)
                @php
                    $head = $department->headFaculty;
                    $roster = $department->faculties
                        ->reject(fn ($f) => $head && (int) $f->id === (int) $head->id)
                        ->values();
                @endphp
                <article class="college-faculty-block">
                    <header class="college-faculty-block__header">
                        <div>
                            <h3 class="college-faculty-block__title">{{ $department->name }}</h3>
                            @if ($department->course)
                                <a class="college-faculty-block__program"
                                    href="{{ route('academics.program', [$collegePage->routeSlug(), $department->course->slug]) }}">
                                    View program
                                </a>
                            @endif
                        </div>
                        <span class="college-faculty-block__count">
                            {{ $department->faculties->count() }}
                            {{ $department->faculties->count() === 1 ? 'faculty member' : 'faculty members' }}
                        </span>
                    </header>

                    @if ($head)
                        @php
                            $hParts = collect(preg_split('/\s+/', trim($head->name)))->filter();
                            $hInitials = $hParts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                        @endphp
                        <div class="college-faculty-head">
                            <div class="college-faculty-head__photo">
                                @if ($head->photo)
                                    <img src="{{ asset('storage/' . $head->photo) }}" alt="{{ $head->name }}"
                                        loading="lazy">
                                @else
                                    <span aria-hidden="true">{{ $hInitials ?: 'PH' }}</span>
                                @endif
                            </div>
                            <div class="college-faculty-head__copy">
                                <p class="college-faculty-head__label">Program head</p>
                                <p class="college-faculty-head__name">{{ $head->name }}</p>
                                @if ($head->rank)
                                    <p class="college-faculty-head__rank">{{ $head->rank }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($roster->count())
                        <div class="college-faculty-grid">
                            @foreach ($roster as $faculty)
                                @php
                                    $parts = collect(preg_split('/\s+/', trim($faculty->name)))->filter();
                                    $initials = $parts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                                @endphp
                                <div class="college-faculty-card">
                                    <div class="college-faculty-card__photo">
                                        @if ($faculty->photo)
                                            <img src="{{ asset('storage/' . $faculty->photo) }}"
                                                alt="{{ $faculty->name }}" loading="lazy">
                                        @else
                                            <span class="college-faculty-card__placeholder"
                                                aria-hidden="true">{{ $initials ?: 'TUP' }}</span>
                                        @endif
                                    </div>
                                    <div class="college-faculty-card__body">
                                        <p class="college-faculty-card__name">{{ $faculty->name }}</p>
                                        @if ($faculty->rank)
                                            <p class="college-faculty-card__rank">{{ $faculty->rank }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif (! $head)
                        <p class="college-dept__empty">No faculty listed for this department yet.</p>
                    @endif
                </article>
            @empty
                <p class="program-empty">No departments listed for this college.</p>
            @endforelse
        </div>

        @include('pages.academics.partials.college-cta')
    </div>
@endsection
