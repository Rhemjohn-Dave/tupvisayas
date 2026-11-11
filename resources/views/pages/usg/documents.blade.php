@extends('layouts.app')

@section('title', 'USG Documents - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Official University Student Government documents of TUP Visayas — memoranda, resolutions, executive orders, and advisories.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="USG Documents - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--usg-documents">
        <section class="acad-hero" aria-labelledby="usg-docs-hero-heading">
            <p class="acad-hero__badge">University Student Government</p>
            <h1 id="usg-docs-hero-heading" class="acad-hero__title">USG Documents</h1>
            <p class="acad-hero__lede">
                Download official memoranda, resolutions, executive orders, and advisories from the University Student Government.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="{{ route('usg.index') }}">Back to USG</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('usg.documents', ['category' => 'memorandum']) }}">
                    Memoranda
                </a>
            </div>
        </section>

        <section class="sit-section" aria-labelledby="usg-docs-list-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Archive</p>
                    <h2 id="usg-docs-list-heading" class="sit-section__title">Official releases</h2>
                    <p class="sit-section__lede">Filter by document type or search by title and reference number.</p>
                </header>

                <form class="usg-doc-filters" method="GET" action="{{ route('usg.documents') }}" role="search">
                    <div class="usg-doc-filters__cats" aria-label="Filter by category">
                        <a class="usg-doc-filters__chip{{ $activeCategory ? '' : ' is-active' }}"
                            href="{{ route('usg.documents', array_filter(['q' => $search])) }}">All</a>
                        @foreach ($categories as $value => $label)
                            <a class="usg-doc-filters__chip{{ $activeCategory === $value ? ' is-active' : '' }}"
                                href="{{ route('usg.documents', array_filter(['category' => $value, 'q' => $search])) }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                    <div class="usg-doc-filters__search">
                        <label class="visually-hidden" for="usg-doc-q">Search documents</label>
                        <input type="search" name="q" id="usg-doc-q" value="{{ $search }}"
                            placeholder="Search title or reference">
                        @if ($activeCategory)
                            <input type="hidden" name="category" value="{{ $activeCategory }}">
                        @endif
                        <button type="submit" class="acad-btn acad-btn--primary">Search</button>
                    </div>
                </form>

                @if ($documents->isEmpty())
                    <p class="sit-prose">No published documents match your filters.</p>
                @else
                    <div class="ts-doc-grid">
                        @foreach ($documents as $document)
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
                                @endif
                                @if ($document->summary)
                                    <p class="ts-doc-card__text">{{ \Illuminate\Support\Str::limit($document->summary, 160) }}</p>
                                @endif
                                <div class="ts-doc-card__actions">
                                    <a class="acad-btn acad-btn--ghost" href="{{ $document->fileUrl() }}"
                                        target="_blank" rel="noopener noreferrer">Download PDF</a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="usg-doc-pagination">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
