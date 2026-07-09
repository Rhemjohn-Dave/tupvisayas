@extends('layouts.app')

@section('content')
    <div class="section site-page site-page--news">
        <h1 class="site-page-title site-page-title--center">
            {{ $category ? $category->name : 'University announcements' }}
        </h1>
        <p class="site-page-intro">
            @if ($category)
                Announcements in the {{ $category->name }} category.
            @else
                Official announcements from TUP Visayas.
            @endif
        </p>

        <div class="news-layout">
            <main class="news-main">
                @forelse ($announcements as $item)
                    <a class="news-item{{ $item->picture ? '' : ' news-item--no-media' }}"
                        href="{{ route('announcements.show', $item->slug) }}">
                        @if ($item->picture)
                            <div class="news-item__media">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                            </div>
                        @endif
                        <div class="news-item__body">
                            <div class="news-item__meta">
                                <span class="news-item__badge">Announcement</span>
                                <time datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->format('M j, Y') }}</time>
                                @if ($item->category)
                                    <span>{{ $item->category->name }}</span>
                                @endif
                            </div>
                            <h2 class="news-item__title">{{ $item->title }}</h2>
                            <p class="news-item__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 160) }}</p>
                            <span class="news-item__link">Read more</span>
                        </div>
                    </a>
                @empty
                    <p class="news-empty">No announcements found{{ !empty($search) ? ' for your search' : '' }}.</p>
                @endforelse
            </main>

            @include('pages.partials.announcements_sidebar', [
                'categories' => $categories,
                'activeCategory' => $category,
                'search' => $search ?? '',
            ])
        </div>
    </div>
@endsection
