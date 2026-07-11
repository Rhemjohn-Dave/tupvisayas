@extends('layouts.app')

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
    <div class="section site-article-narrow">
        <h1 class="site-page-title site-page-title--center">Job openings</h1>
        @if ($job->category)
            <div class="site-article-badge-wrap">
                <span class="site-article-badge">{{ $job->category->name }}</span>
            </div>
        @endif
        <div class="card site-article-card">
            <div class="card-content">
                <span class="card-title">{{ $job->title }}</span>
                <hr class="site-article-rule" aria-hidden="true">
                <div class="site-article-meta">
                    <span><i class="material-icons tiny">person</i> TUP Visayas</span>
                    <span><i class="material-icons tiny">event</i> {{ $job->created_at->format('F d, Y') }}</span>
                </div>
                @if ($job->picture)
                    <div class="site-inline-figure">
                        <img src="{{ asset('storage/' . $job->picture) }}" alt="" loading="lazy">
                    </div>
                @endif
                <div class="job-content wysiwyg-content site-article-body">
                    {!! clean($job->content) !!}
                </div>
                <div class="site-share">
                    <p class="site-share__title">Share this job</p>
                    <div class="site-share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="btn-small white-text site-btn-share site-btn-share--fb">Facebook</a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($job->title) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="btn-small white-text site-btn-share site-btn-share--tw">Twitter</a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($job->title) }}"
                            target="_blank" rel="noopener noreferrer"
                            class="btn-small white-text site-btn-share site-btn-share--in">LinkedIn</a>
                    </div>
                </div>
                <div class="site-copy-row">
                    <input type="text" id="job-link" value="{{ request()->url() }}" readonly aria-label="Job posting URL">
                    <button type="button" class="site-icon-btn" onclick="copyJobLink()" title="Copy link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path
                                d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="site-back-actions">
            <a href="{{ route('jobs') }}" class="btn grey lighten-1 black-text">Back to job openings</a>
        </div>
    </div>

    <section class="section site-popular-block" aria-labelledby="popular-jobs">
        <h2 id="popular-jobs" class="site-popular-block__title">More openings</h2>
        <div class="row">
            @php
                $popular = \App\Models\Job::orderBy('created_at', 'desc')->limit(3)->get();
            @endphp
            @foreach ($popular as $item)
                <div class="col s12 m4">
                    <div class="card hoverable">
                        @if ($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title">{{ $item->title }}</span>
                            <div class="site-meta">{{ $item->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('jobs.show', $item->slug) }}" class="btn-flat">Read more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function copyJobLink() {
            var linkInput = document.getElementById('job-link');
            if (!linkInput) return;
            linkInput.select();
            linkInput.setSelectionRange(0, 99999);
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(linkInput.value).then(function() {
                    if (typeof M !== 'undefined') M.toast({
                        html: 'Link copied to clipboard!',
                        classes: 'green'
                    });
                });
            } else {
                try {
                    document.execCommand('copy');
                    if (typeof M !== 'undefined') M.toast({
                        html: 'Link copied to clipboard!',
                        classes: 'green'
                    });
                } catch (e) {}
            }
        }
    </script>
@endsection
