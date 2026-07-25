@php
    $collegeSection = $collegeSection ?? 'programs';
    $collegeSlug = $collegePage->routeSlug();
    $lede = $collegeSection === 'faculty'
        ? 'Meet the program heads and faculty members who lead teaching and mentoring in this college.'
        : 'Explore degree programs, board exam performance, and the story of this college.';
@endphp

<header class="college-masthead{{ $dean ? ' college-masthead--with-dean' : '' }}">
    <div class="college-masthead__media{{ $collegePage->cover_photo ? '' : ' college-masthead__media--fallback' }}">
        @if ($collegePage->cover_photo)
            <img src="{{ asset('storage/' . $collegePage->cover_photo) }}"
                alt="{{ $collegePage->college }} cover photo" loading="eager">
        @endif
        <div class="college-masthead__media-shade" aria-hidden="true"></div>
    </div>

    <div class="college-masthead__panel">
        <div class="college-masthead__identity">
            <p class="college-masthead__eyebrow">TUP Visayas · Academics</p>
            <h1 class="college-masthead__title">{{ $collegePage->college }}</h1>
            <p class="college-masthead__lede">{{ $lede }}</p>
        </div>

        @if ($dean)
            @php
                $deanParts = collect(preg_split('/\s+/', trim($dean->name)))->filter();
                $deanInitials = $deanParts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                $deanSaying = filled($dean->quote)
                    ? $dean->quote
                    : 'Technology for a better life — shaping skilled, ethical graduates for Visayas and the nation.';
            @endphp
            <aside class="college-masthead__dean" aria-labelledby="college-dean-heading">
                <div class="college-masthead__dean-photo">
                    @if ($dean->photo)
                        <img src="{{ asset('storage/' . $dean->photo) }}" alt="{{ $dean->name }}" loading="eager">
                    @else
                        <span class="college-masthead__dean-placeholder" aria-hidden="true">{{ $deanInitials ?: 'TUP' }}</span>
                    @endif
                </div>
                <div class="college-masthead__dean-copy">
                    <p class="college-masthead__dean-label" id="college-dean-heading">College dean</p>
                    <h2 class="college-masthead__dean-name">{{ $dean->name }}</h2>
                    <p class="college-masthead__dean-role">{{ $dean->position }}</p>
                    <blockquote class="college-masthead__dean-quote">
                        <p>{{ $deanSaying }}</p>
                    </blockquote>
                </div>
            </aside>
        @endif
    </div>
</header>

<nav class="college-switcher" aria-label="{{ $collegePage->college }} sections">
    <a class="college-switcher__link{{ $collegeSection === 'programs' ? ' is-active' : '' }}"
        href="{{ route('academics.show', $collegeSlug) }}"
        @if ($collegeSection === 'programs') aria-current="page" @endif>
        Programs
    </a>
    <a class="college-switcher__link{{ $collegeSection === 'faculty' ? ' is-active' : '' }}"
        href="{{ route('academics.faculty', $collegeSlug) }}"
        @if ($collegeSection === 'faculty') aria-current="page" @endif>
        Faculty &amp; Departments
    </a>
</nav>
