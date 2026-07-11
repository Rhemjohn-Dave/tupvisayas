@extends('layouts.app')

@section('content')
    <div class="section site-page site-page--news">
        <h1 class="site-page-title site-page-title--center">
            {{ $category ? $category->name : 'News & events' }}
        </h1>
        <p class="site-page-intro">
            @if ($category)
                Updates in the {{ $category->name }} category.
            @else
                Latest news, events, and announcements from TUP Visayas.
            @endif
        </p>

        <div class="news-layout">
            <main class="news-main">
                @forelse ($updates as $item)
                    @php
                        $href =
                            $item->type === 'News'
                                ? route('news.show', $item->slug)
                                : ($item->type === 'Event'
                                    ? route('events.show', $item->slug)
                                    : route('announcements.show', $item->slug));
                    @endphp
                    <a class="news-item{{ $item->picture ? '' : ' news-item--no-media' }}" href="{{ $href }}">
                        @if ($item->picture)
                            <div class="news-item__media">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                            </div>
                        @endif
                        <div class="news-item__body">
                            <div class="news-item__meta">
                                <span class="news-item__badge">{{ $item->type }}</span>
                                <time datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->format('M j, Y') }}</time>
                            </div>
                            <h2 class="news-item__title">{{ $item->title }}</h2>
                            <p class="news-item__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 160) }}</p>
                            <span class="news-item__link">Read more</span>
                        </div>
                    </a>
                @empty
                    <p class="news-empty">No news, events, or announcements found{{ $search ? ' for your search' : '' }}.</p>
                @endforelse

                @if ($updates->hasPages())
                    {{ $updates->links('pagination.public') }}
                @endif
            </main>

            <aside class="news-sidebar" aria-label="Filter news and events">
                <form class="news-search" action="{{ route('news_events') }}" method="GET">
                    @if ($category)
                        <input type="hidden" name="category" value="{{ $category->slug }}">
                    @endif
                    <label class="news-search__label" for="news-search-input">Search</label>
                    <input id="news-search-input" type="search" name="search" placeholder="Search updates…"
                        value="{{ $search }}">
                    <button type="submit" class="news-search__btn">Search</button>
                </form>

                <div class="news-sidebar__block">
                    <h2 class="news-sidebar__title">Categories</h2>
                    <ul class="news-sidebar__list">
                        <li>
                            <a href="{{ route('news_events') }}"
                                class="{{ !$category && !$search ? 'is-active' : '' }}">All updates</a>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('news_events', ['category' => $cat->slug]) }}"
                                    class="{{ $category && $category->id === $cat->id ? 'is-active' : '' }}">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="news-sidebar__note">
                    <a href="{{ route('announcements.index') }}">View announcements only</a>
                </p>
            </aside>
        </div>
    </div>
@endsection
