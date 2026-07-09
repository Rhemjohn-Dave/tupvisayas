@extends('layouts.app')

@section('head')
    <meta property="og:title" content="{{ $announcement->title }}" />
    <meta property="og:description" content="{{ strip_tags(Str::limit($announcement->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($announcement->picture)
        <meta property="og:image" content="{{ asset('storage/' . $announcement->picture) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
    <div class="section site-page site-page--article">
        <div class="news-layout">
            <article class="article-detail">
                <header class="article-detail__header">
                    <p class="article-detail__kicker">University announcements</p>
                    @if ($announcement->category)
                        <span class="news-item__badge">{{ $announcement->category->name }}</span>
                    @endif
                    <h1 class="article-detail__title">{{ $announcement->title }}</h1>
                    <div class="article-detail__meta">
                        <span>TUP Visayas</span>
                        <time datetime="{{ $announcement->created_at->toDateString() }}">{{ $announcement->created_at->format('F j, Y') }}</time>
                    </div>
                </header>

                @if ($announcement->picture)
                    <figure class="article-detail__media">
                        <img src="{{ asset('storage/' . $announcement->picture) }}" alt="" loading="lazy">
                    </figure>
                @endif

                <div class="article-detail__body wysiwyg-content">
                    {!! $announcement->content !!}
                </div>

                <footer class="article-detail__footer">
                    <div class="article-share">
                        <p class="article-share__title">Share this announcement</p>
                        <div class="article-share__links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" rel="noopener noreferrer">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($announcement->title) }}"
                                target="_blank" rel="noopener noreferrer">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($announcement->title) }}"
                                target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        </div>
                    </div>
                    <p class="article-back">
                        <a href="{{ route('announcements.index') }}">&larr; Back to announcements</a>
                    </p>
                </footer>
            </article>

            @php
                $related = \App\Models\Announcement::where('id', '!=', $announcement->id)
                    ->where('category_id', $announcement->category_id)
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
            @endphp
            @include('pages.partials.announcements_sidebar', [
                'categories' => $categories,
                'activeCategory' => $announcement->category,
                'search' => $search ?? '',
                'related' => $related,
            ])
        </div>
    </div>
@endsection
