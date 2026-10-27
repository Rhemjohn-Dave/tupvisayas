@extends('layouts.app')

@section('title', $hrPost->title . ' - Human Resources - TUP Visayas')

@section('head')
    <meta property="og:title" content="{{ $hrPost->title }}" />
    <meta property="og:description"
        content="{{ strip_tags(\Illuminate\Support\Str::limit($hrPost->excerpt ?: $hrPost->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($hrPost->featured_image)
        <meta property="og:image" content="{{ asset('storage/' . $hrPost->featured_image) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
    <div class="section site-page site-page--article site-page--hr-article">
        <p class="article-mobile-back">
            <a href="{{ route('human-resources') }}{{ $hrPost->isProgram() ? '#hr-programs' : '#hr-announcements' }}">&larr;
                Back to Human Resources</a>
        </p>
        <div class="news-layout news-layout--article">
            <article class="article-detail">
                <header class="article-detail__header">
                    <p class="article-detail__kicker">Human Resources</p>
                    <span class="news-item__badge">{{ $hrPost->type_label }}</span>
                    <h1 class="article-detail__title">{{ $hrPost->title }}</h1>
                    <div class="article-detail__meta">
                        @if ($hrPost->isProgram() && $hrPost->department)
                            <span>{{ $hrPost->department->name }}</span>
                        @else
                            <span>{{ $hrPost->author->name ?? 'Human Resources' }}</span>
                        @endif
                        @if ($hrPost->isProgram() && $hrPost->event_date)
                            <time datetime="{{ $hrPost->event_date->toDateString() }}">
                                {{ $hrPost->event_date->format('F j, Y') }}
                            </time>
                        @else
                            <time datetime="{{ ($hrPost->published_at ?? $hrPost->created_at)->toDateString() }}">
                                {{ ($hrPost->published_at ?? $hrPost->created_at)->format('F j, Y') }}
                            </time>
                        @endif
                    </div>
                    @if ($hrPost->excerpt)
                        <p class="article-detail__excerpt">{{ $hrPost->excerpt }}</p>
                    @endif
                    @if ($hrPost->report_file)
                        <p class="hr-post-report-cta">
                            <a class="acad-btn acad-btn--primary"
                                href="{{ asset('storage/' . $hrPost->report_file) }}" target="_blank"
                                rel="noopener noreferrer">Download report (PDF)</a>
                        </p>
                    @endif
                </header>

                @if ($hrPost->featured_image)
                    <figure class="article-detail__media">
                        <img src="{{ asset('storage/' . $hrPost->featured_image) }}" alt="{{ $hrPost->title }}"
                            loading="lazy">
                    </figure>
                @endif

                <div class="article-detail__body site-prose">
                    {!! clean($hrPost->content) !!}
                </div>

                <footer class="article-detail__footer">
                    @if ($hrPost->report_file)
                        <p class="hr-post-report-cta">
                            <a class="acad-btn acad-btn--primary"
                                href="{{ asset('storage/' . $hrPost->report_file) }}" target="_blank"
                                rel="noopener noreferrer">Download report (PDF)</a>
                        </p>
                    @endif
                    <div class="article-share">
                        <p class="article-share__title">Share this {{ strtolower($hrPost->type_label) }}</p>
                        <div class="article-share__links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" rel="noopener noreferrer">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($hrPost->title) }}"
                                target="_blank" rel="noopener noreferrer">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($hrPost->title) }}"
                                target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        </div>
                    </div>
                    <p class="article-back">
                        <a href="{{ route('human-resources') }}">&larr; Back to Human Resources</a>
                    </p>
                </footer>
            </article>
        </div>

        @if ($relatedPosts->count())
            <section class="article-more" aria-labelledby="more-hr-posts">
                <h2 id="more-hr-posts" class="site-section-title">
                    More {{ $hrPost->isProgram() ? 'programs' : 'announcements' }}
                </h2>
                <div class="article-more__list">
                    @foreach ($relatedPosts as $related)
                        <a class="article-more__item" href="{{ route('human-resources.post.show', $related->slug) }}">
                            @if ($related->featured_image)
                                <div class="article-more__media">
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt=""
                                        loading="lazy">
                                </div>
                            @endif
                            <div class="article-more__body">
                                <time
                                    datetime="{{ ($related->isProgram() && $related->event_date ? $related->event_date : ($related->published_at ?? $related->created_at))->toDateString() }}">
                                    {{ ($related->isProgram() && $related->event_date ? $related->event_date : ($related->published_at ?? $related->created_at))->format('M j, Y') }}
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
