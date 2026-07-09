@extends('layouts.app')

@section('head')
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:description" content="{{ strip_tags(Str::limit($news->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($news->picture)
        <meta property="og:image" content="{{ asset('storage/' . $news->picture) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
    <div class="section site-page site-page--article">
        <div class="news-layout">
            <article class="article-detail">
                <header class="article-detail__header">
                    <p class="article-detail__kicker">University news</p>
                    @if ($news->category)
                        <span class="news-item__badge">{{ $news->category->name }}</span>
                    @endif
                    <h1 class="article-detail__title">{{ $news->title }}</h1>
                    <div class="article-detail__meta">
                        <span>TUP Visayas</span>
                        <time datetime="{{ $news->created_at->toDateString() }}">{{ $news->created_at->format('F j, Y') }}</time>
                    </div>
                </header>

                @if ($news->picture)
                    <figure class="article-detail__media">
                        <img src="{{ asset('storage/' . $news->picture) }}" alt="" loading="lazy">
                    </figure>
                @endif

                <div class="article-detail__body wysiwyg-content">
                    {!! $news->content !!}
                </div>

                <footer class="article-detail__footer">
                    <div class="article-share">
                        <p class="article-share__title">Share this article</p>
                        <div class="article-share__links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" rel="noopener noreferrer">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->title) }}"
                                target="_blank" rel="noopener noreferrer">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($news->title) }}"
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
                'activeCategory' => $news->category,
                'search' => $search ?? '',
            ])
        </div>

        @php
            $moreNews = \App\Models\News::where('id', '!=', $news->id)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        @endphp
        @include('pages.partials.article_related', [
            'headingId' => 'more-news',
            'heading' => 'More news',
            'routeName' => 'news.show',
            'items' => $moreNews,
        ])
    </div>
@endsection
