@extends('layouts.app')

@section('head')
    <meta property="og:title" content="{{ $event->title }}" />
    <meta property="og:description" content="{{ strip_tags(Str::limit($event->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($event->picture)
        <meta property="og:image" content="{{ asset('storage/' . $event->picture) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
    <div class="section site-page site-page--article">
        <div class="news-layout">
            <article class="article-detail">
                <header class="article-detail__header">
                    <p class="article-detail__kicker">University events</p>
                    @if ($event->category)
                        <span class="news-item__badge">{{ $event->category->name }}</span>
                    @endif
                    <h1 class="article-detail__title">{{ $event->title }}</h1>
                    <div class="article-detail__meta">
                        <span>TUP Visayas</span>
                        <time datetime="{{ $event->created_at->toDateString() }}">{{ $event->created_at->format('F j, Y') }}</time>
                    </div>
                </header>

                @if ($event->picture)
                    <figure class="article-detail__media">
                        <img src="{{ asset('storage/' . $event->picture) }}" alt="" loading="lazy">
                    </figure>
                @endif

                <div class="article-detail__body wysiwyg-content">
                    {!! $event->content !!}
                </div>

                <footer class="article-detail__footer">
                    <div class="article-share">
                        <p class="article-share__title">Share this event</p>
                        <div class="article-share__links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" rel="noopener noreferrer">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($event->title) }}"
                                target="_blank" rel="noopener noreferrer">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($event->title) }}"
                                target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        </div>
                    </div>
                    <p class="article-back">
                        <a href="{{ route('news_events') }}">&larr; Back to news &amp; events</a>
                    </p>
                </footer>
            </article>

            @include('pages.partials.news_sidebar', [
                'categories' => $categories,
                'activeCategory' => $event->category,
                'search' => $search ?? '',
            ])
        </div>

        @php
            $moreEvents = \App\Models\Event::where('id', '!=', $event->id)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        @endphp
        @include('pages.partials.article_related', [
            'headingId' => 'more-events',
            'heading' => 'More events',
            'routeName' => 'events.show',
            'items' => $moreEvents,
        ])
    </div>
@endsection
