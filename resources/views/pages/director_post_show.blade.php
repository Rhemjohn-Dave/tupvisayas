@extends('layouts.app')

@section('title', $post->title . " - Director's Corner - TUP Visayas")

@section('head')
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ strip_tags(\Illuminate\Support\Str::limit($post->excerpt ?: $post->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($post->featured_image)
        <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
    <div class="section site-page site-page--article">
        <div class="news-layout">
            <article class="article-detail">
                <header class="article-detail__header">
                    <p class="article-detail__kicker">Director's Corner</p>
                    <span class="news-item__badge">{{ $post->type_label }}</span>
                    <h1 class="article-detail__title">{{ $post->title }}</h1>
                    <div class="article-detail__meta">
                        <span>{{ $director->name ?? ($post->author->name ?? 'Director') }}</span>
                        <time datetime="{{ ($post->published_at ?? $post->created_at)->toDateString() }}">
                            {{ ($post->published_at ?? $post->created_at)->format('F j, Y') }}
                        </time>
                    </div>
                    @if ($post->excerpt)
                        <p class="article-detail__excerpt">{{ $post->excerpt }}</p>
                    @endif
                </header>

                @if ($post->featured_image)
                    <figure class="article-detail__media">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                            loading="lazy">
                    </figure>
                @endif

                <div class="article-detail__body site-prose">
                    {!! $post->content !!}
                </div>

                <footer class="article-detail__footer">
                    <div class="article-share">
                        <p class="article-share__title">Share this {{ strtolower($post->type_label) }}</p>
                        <div class="article-share__links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" rel="noopener noreferrer">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                                target="_blank" rel="noopener noreferrer">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}"
                                target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        </div>
                    </div>
                    <p class="article-back">
                        <a href="{{ route('directors.corner') }}">&larr; Back to Director's Corner</a>
                    </p>
                </footer>
            </article>

            @include('pages.partials.director_sidebar', ['director' => $director, 'post' => $post])
        </div>

        @if ($relatedPosts->count())
            <section class="article-more" aria-labelledby="more-director-posts">
                <h2 id="more-director-posts" class="site-section-title">More from the Director</h2>
                <div class="article-more__list">
                    @foreach ($relatedPosts as $related)
                        <a class="article-more__item" href="{{ route('directors.corner.post.show', $related->slug) }}">
                            @if ($related->featured_image)
                                <div class="article-more__media">
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt=""
                                        loading="lazy">
                                </div>
                            @endif
                            <div class="article-more__body">
                                <time datetime="{{ ($related->published_at ?? $related->created_at)->toDateString() }}">
                                    {{ ($related->published_at ?? $related->created_at)->format('M j, Y') }}
                                </time>
                                <span>{{ $related->title }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
