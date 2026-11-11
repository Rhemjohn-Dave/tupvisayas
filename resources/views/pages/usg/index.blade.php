@extends('layouts.app')

@section('title', 'University Student Government - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'University Student Government of TUP Visayas — student representation, officers, and official memoranda, resolutions, and advisories.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="University Student Government - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    @php
        $defaultAbout = 'The University Student Government (USG) is the highest student governing body of TUP Visayas. It represents the student body, advances student welfare, and works with campus offices on programs that support learning and campus life.';
    @endphp

    <div class="site-page site-page--usg">
        <section class="acad-hero" aria-labelledby="usg-hero-heading">
            <p class="acad-hero__badge">Students</p>
            <h1 id="usg-hero-heading" class="acad-hero__title">University Student Government</h1>
            <p class="acad-hero__lede">
                Representing TUP Visayas students through leadership, service, and official campus communications.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="{{ route('usg.documents') }}">View documents</a>
                <a class="acad-btn acad-btn--ghost" href="#usg-officers">Meet the officers</a>
                <a class="acad-btn acad-btn--ghost" href="#usg-about">About USG</a>
            </div>
        </section>

        <section class="sit-section" id="usg-about" aria-labelledby="usg-about-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">About</p>
                    <h2 id="usg-about-heading" class="sit-section__title">Student representation on campus</h2>
                </header>
                <p class="sit-prose">{!! nl2br(e($about ?: $defaultAbout)) !!}</p>

                @if (filled($mission) || filled($vision))
                    <ul class="sit-check-list" aria-label="USG mission and vision">
                        @if (filled($mission))
                            <li><strong>Mission.</strong> {{ $mission }}</li>
                        @endif
                        @if (filled($vision))
                            <li><strong>Vision.</strong> {{ $vision }}</li>
                        @endif
                    </ul>
                @endif
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="usg-officers" aria-labelledby="usg-officers-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Leadership</p>
                    <h2 id="usg-officers-heading" class="sit-section__title">Current officers</h2>
                    <p class="sit-section__lede">
                        Elected student leaders serving the TUP Visayas community.
                    </p>
                </header>

                @if ($officers->isEmpty())
                    <p class="sit-prose">Officer profiles will appear here once published.</p>
                @else
                    <div class="usg-officer-grid">
                        @foreach ($officers as $officer)
                            @php
                                $parts = collect(preg_split('/\s+/', trim($officer->name)))->filter();
                                $initials = $parts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                            @endphp
                            <article class="usg-officer-card">
                                <div class="usg-officer-card__photo">
                                    @if ($officer->photoUrl())
                                        <img src="{{ $officer->photoUrl() }}" alt="{{ $officer->name }}" loading="lazy">
                                    @else
                                        <span aria-hidden="true">{{ $initials ?: 'USG' }}</span>
                                    @endif
                                </div>
                                <div class="usg-officer-card__body">
                                    <h3 class="usg-officer-card__name">{{ $officer->name }}</h3>
                                    <p class="usg-officer-card__role">{{ $officer->position }}</p>
                                    @if ($officer->term_label)
                                        <p class="usg-officer-card__term">{{ $officer->term_label }}</p>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="sit-section" id="usg-documents" aria-labelledby="usg-documents-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Releases</p>
                    <h2 id="usg-documents-heading" class="sit-section__title">Recent documents</h2>
                    <p class="sit-section__lede">
                        Memoranda, resolutions, executive orders, and advisories issued by the USG.
                    </p>
                </header>

                @if ($recentDocuments->isEmpty())
                    <p class="sit-prose">No documents published yet. Check back soon.</p>
                @else
                    <div class="ts-doc-grid">
                        @foreach ($recentDocuments as $document)
                            <article class="ts-doc-card">
                                <p class="ts-doc-card__meta">
                                    {{ $document->category_label }}
                                    @if ($document->issued_at)
                                        · <time datetime="{{ $document->issued_at->toDateString() }}">{{ $document->issued_at->format('M j, Y') }}</time>
                                    @endif
                                </p>
                                <h3 class="ts-doc-card__title">{{ $document->title }}</h3>
                                @if ($document->reference_no)
                                    <p class="ts-doc-card__text">{{ $document->reference_no }}</p>
                                @elseif ($document->summary)
                                    <p class="ts-doc-card__text">{{ \Illuminate\Support\Str::limit($document->summary, 120) }}</p>
                                @endif
                                <div class="ts-doc-card__actions">
                                    <a class="acad-btn acad-btn--ghost" href="{{ $document->fileUrl() }}"
                                        target="_blank" rel="noopener noreferrer">Download PDF</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div style="margin-top:1.5rem;">
                        <a class="acad-btn acad-btn--primary" href="{{ route('usg.documents') }}">Browse all documents</a>
                    </div>
                @endif
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="usg-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="usg-cta-heading" class="acad-cta__title">Need an official USG release?</h2>
                <p class="acad-cta__lede">
                    Browse memoranda and other documents, or reach the USG office for student representation concerns.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('usg.documents', ['category' => 'memorandum']) }}">
                        View memoranda
                    </a>
                    @if (filled($contactEmail))
                        <a class="acad-btn acad-btn--outline-light" href="mailto:{{ $contactEmail }}">Email USG</a>
                    @else
                        <a class="acad-btn acad-btn--outline-light" href="{{ route('contact') }}">Contact campus</a>
                    @endif
                </div>
                @if (filled($officeHours))
                    <p class="acad-cta__lede" style="margin-top:1rem;">Office hours: {{ $officeHours }}</p>
                @endif
            </div>
        </section>
    </div>
@endsection
