@extends('layouts.app')

@section('title', "Director's Corner - TUP Visayas")

@section('content')
    <div class="section site-page site-page--director-corner">
        <h1 class="site-page-title site-page-title--center">Director's Corner</h1>
        <p class="site-page-intro">Messages, insights, and updates from the Director of TUP Visayas.</p>

        @if ($director)
            <section class="director-hero" aria-labelledby="director-profile-heading">
                <h2 id="director-profile-heading" class="visually-hidden">Director profile</h2>
                <div class="director-hero__card">
                    <div class="director-hero__image">
                        @if ($director->photo)
                            <img src="{{ asset('storage/' . $director->photo) }}" alt="{{ $director->name }}"
                                loading="lazy">
                        @else
                            @php
                                $parts = collect(preg_split('/\s+/', trim($director->name)))->filter();
                                $initials = $parts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                            @endphp
                            <div class="director-hero__placeholder" aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                        @endif
                    </div>
                    <div class="director-hero__body">
                        <p class="director-hero__kicker">Office of the Director</p>
                        <h3 class="director-hero__name">{{ $director->name }}</h3>
                        <p class="director-hero__role">{{ $director->position }}</p>
                        <p class="director-hero__text">Welcome to the Director's Corner — a space for official news, reflections, and blog posts from the university director.</p>
                    </div>
                </div>
            </section>
        @endif

        <section class="director-posts" aria-labelledby="director-posts-heading">
            <div class="director-posts__header">
                <h2 id="director-posts-heading" class="site-section-title">Latest from the Director</h2>
                <nav class="director-filters" aria-label="Filter posts by type">
                    <a href="{{ route('directors.corner') }}"
                        class="director-filters__link{{ !$type ? ' is-active' : '' }}">All</a>
                    <a href="{{ route('directors.corner', ['type' => 'news']) }}"
                        class="director-filters__link{{ $type === 'news' ? ' is-active' : '' }}">News</a>
                    <a href="{{ route('directors.corner', ['type' => 'blog']) }}"
                        class="director-filters__link{{ $type === 'blog' ? ' is-active' : '' }}">Blog</a>
                </nav>
            </div>

            @auth
                @if (auth()->user()->is_admin)
                    <p class="director-admin-link">
                        <a href="{{ route('admin.director_posts.create') }}" class="site-cta">Create new post</a>
                    </p>
                @endif
            @endauth

            @if ($posts->count())
                <div class="adre-posts">
                    @foreach ($posts as $post)
                        <a class="news-item{{ $post->featured_image ? '' : ' news-item--no-media' }}"
                            href="{{ route('directors.corner.post.show', $post->slug) }}">
                            @if ($post->featured_image)
                                <div class="news-item__media">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        loading="lazy">
                                </div>
                            @endif
                            <div class="news-item__body">
                                <div class="news-item__meta">
                                    <span class="news-item__badge">{{ $post->type_label }}</span>
                                    <time datetime="{{ ($post->published_at ?? $post->created_at)->toDateString() }}">
                                        {{ ($post->published_at ?? $post->created_at)->format('M j, Y') }}
                                    </time>
                                </div>
                                <h3 class="news-item__title">{{ $post->title }}</h3>
                                <p class="news-item__excerpt">
                                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}
                                </p>
                                <span class="news-item__link">Read more</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    {{ $posts->links('pagination.public') }}
                @endif
            @else
                <p class="adre-empty">No {{ $type ? $type . ' ' : '' }}posts are available at this time. Please check back later.</p>
            @endif
        </section>
    </div>
@endsection
