@php
    $collegeSection = $collegeSection ?? 'programs';
    $collegeSlug = $collegePage->routeSlug();
    $exploreLabels = [
        'coac' => 'CACE',
        'coe' => 'COE',
        'coet' => 'COET',
    ];
    $heroLedes = [
        'coac' => 'Industry-aligned automation, mechatronics, and control systems that prepare graduates to lead modern manufacturing and process industries.',
        'coe' => 'Rigorous engineering education across civil, mechanical, electrical, and allied fields—designing solutions for Visayas and the nation.',
        'coet' => 'Hands-on engineering technology pathways in advanced manufacturing and digital systems for industry-ready professionals.',
    ];
    $exploreLabel = $exploreLabels[$collegeSlug] ?? 'College';
    $lede = $heroLedes[$collegeSlug]
        ?? 'Explore degree programs, faculty, and the academic community of this college at TUP Visayas.';
    $coverUrl = $collegePage->cover_photo
        ? asset('storage/' . $collegePage->cover_photo)
        : asset('images/tupvisayas.jpg');
    $coverVer = $collegePage->cover_photo
        ? @filemtime(public_path('storage/' . $collegePage->cover_photo))
        : @filemtime(public_path('images/tupvisayas.jpg'));
@endphp

<section class="college-hero{{ $collegePage->cover_photo ? '' : ' college-hero--fallback' }}"
    aria-labelledby="college-hero-heading">
    <div class="college-hero__media" aria-hidden="true">
        <img src="{{ $coverUrl }}?v={{ $coverVer ?: time() }}" alt="">
        <div class="college-hero__shade"></div>
    </div>

    <div class="college-hero__content">
        <p class="college-hero__badge">Academics &amp; innovation</p>
        <h1 id="college-hero-heading" class="college-hero__title">{{ $collegePage->college }}</h1>
        <p class="college-hero__lede">{{ $lede }}</p>
        <div class="college-hero__actions">
            @if ($collegeSection === 'faculty')
                <a class="college-btn college-btn--gold"
                    href="{{ route('academics.show', $collegeSlug) }}">View Curriculum</a>
                <a class="college-btn college-btn--ghost-light" href="#college-explore">Faculty Directory</a>
            @else
                <a class="college-btn college-btn--gold" href="#college-explore">View Curriculum</a>
                <a class="college-btn college-btn--ghost-light"
                    href="{{ route('academics.faculty', $collegeSlug) }}">Faculty Directory</a>
            @endif
        </div>
    </div>
</section>

@if ($dean)
    @php
        $deanParts = collect(preg_split('/\s+/', trim($dean->name)))->filter();
        $deanInitials = $deanParts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
        $deanSaying = filled($dean->quote)
            ? $dean->quote
            : 'Technology for a better life — shaping skilled, ethical graduates for Visayas and the nation.';
    @endphp
    <section class="college-dean" aria-labelledby="college-dean-heading">
        <div class="college-dean__inner">
            <div class="college-dean__photo-wrap">
                <div class="college-dean__photo">
                    @if ($dean->photo)
                        <img src="{{ asset('storage/' . $dean->photo) }}" alt="{{ $dean->name }}" loading="eager">
                    @else
                        <span class="college-dean__placeholder" aria-hidden="true">{{ $deanInitials ?: 'TUP' }}</span>
                    @endif
                </div>
                <span class="college-dean__badge">
                    <span class="college-dean__badge-label">Designation</span>
                    <span class="college-dean__badge-value">College Dean</span>
                </span>
            </div>
            <div class="college-dean__copy">
                <h2 id="college-dean-heading" class="college-dean__name">{{ $dean->name }}</h2>
                <p class="college-dean__role">{{ $dean->position ?: 'Dean, ' . $collegePage->college }}</p>
                <blockquote class="college-dean__quote">
                    <span class="college-dean__quote-mark" aria-hidden="true">“</span>
                    <p>{{ $deanSaying }}</p>
                </blockquote>
            </div>
        </div>
    </section>
@endif

<section class="college-explore" id="college-explore" aria-labelledby="college-explore-heading">
    <h2 id="college-explore-heading" class="college-explore__title">Explore {{ $exploreLabel }}</h2>
    <nav class="college-switcher" aria-label="{{ $collegePage->college }} sections">
        <a class="college-switcher__link{{ $collegeSection === 'programs' ? ' is-active' : '' }}"
            href="{{ route('academics.show', $collegeSlug) }}"
            @if ($collegeSection === 'programs') aria-current="page" @endif>
            Programs Offered
        </a>
        <a class="college-switcher__link{{ $collegeSection === 'faculty' ? ' is-active' : '' }}"
            href="{{ route('academics.faculty', $collegeSlug) }}"
            @if ($collegeSection === 'faculty') aria-current="page" @endif>
            Faculty &amp; Departments
        </a>
    </nav>
</section>
