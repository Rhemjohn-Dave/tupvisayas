@extends('layouts.app')

@section('title', $job->title . ' - TUP Visayas')

@section('head')
    <meta property="og:title" content="{{ $job->title }}" />
    <meta property="og:description" content="{{ strip_tags(Str::limit($job->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($job->picture)
        <meta property="og:image" content="{{ asset('storage/' . $job->picture) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
    @php
        $isSit = $job->isCampusRecruitment();
        $indexUrl = \App\Models\Job::indexUrl($job->listing_type);
        $indexLabel = $isSit ? 'SIT campus recruitment' : 'Human Resources';
        $kicker = $isSit ? 'Campus recruitment' : 'Job opening';
    @endphp

    <div class="section site-page site-page--article">
        <p class="article-mobile-back">
            <a href="{{ $indexUrl }}">&larr; Back to {{ $indexLabel }}</a>
        </p>
        <div class="news-layout news-layout--article">
            <article class="article-detail">
                <header class="article-detail__header">
                    <p class="article-detail__kicker">{{ $kicker }}</p>
                    <span class="news-item__badge">{{ $job->officeLabel() }}</span>
                    @if ($job->category)
                        <span class="news-item__badge">{{ $job->category->name }}</span>
                    @endif
                    <h1 class="article-detail__title">{{ $job->title }}</h1>
                    <div class="article-detail__meta">
                        <span>{{ $isSit ? 'SIT Office' : 'Human Resources' }}</span>
                        <time datetime="{{ $job->created_at->toDateString() }}">{{ $job->created_at->format('F j, Y') }}</time>
                    </div>
                    <p class="article-detail__excerpt">{{ $job->audienceLabel() }}</p>
                </header>

                @if ($job->picture)
                    <figure class="article-detail__media">
                        <img src="{{ asset('storage/' . $job->picture) }}" alt="" loading="lazy">
                    </figure>
                @endif

                <div class="article-detail__body site-prose wysiwyg-content">
                    {!! clean($job->content) !!}
                </div>

                <footer class="article-detail__footer">
                    <div class="article-share">
                        <p class="article-share__title">Share this posting</p>
                        <div class="article-share__links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" rel="noopener noreferrer">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($job->title) }}"
                                target="_blank" rel="noopener noreferrer">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($job->title) }}"
                                target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        </div>
                    </div>
                    <p class="article-back">
                        <a href="{{ $indexUrl }}">&larr; Back to {{ $indexLabel }}</a>
                    </p>
                </footer>
            </article>

            @include('pages.partials.job_sidebar', [
                'isSit' => $isSit,
                'related' => $related,
            ])
        </div>

        @include('pages.partials.article_related', [
            'headingId' => 'more-jobs',
            'heading' => $isSit ? 'More campus recruitment' : 'More job openings',
            'routeName' => 'jobs.show',
            'items' => $related,
        ])
    </div>
@endsection
