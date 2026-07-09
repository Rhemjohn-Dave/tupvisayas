<aside class="news-sidebar" aria-label="Filter news and events">
    <form class="news-search" action="{{ route('news_events') }}" method="GET">
        @if (!empty($activeCategory))
            <input type="hidden" name="category" value="{{ $activeCategory->slug }}">
        @endif
        <label class="news-search__label" for="news-search-input">Search</label>
        <input id="news-search-input" type="search" name="search" placeholder="Search updates…"
            value="{{ $search ?? '' }}">
        <button type="submit" class="news-search__btn">Search</button>
    </form>

    <div class="news-sidebar__block">
        <h2 class="news-sidebar__title">Categories</h2>
        <ul class="news-sidebar__list">
            <li>
                <a href="{{ route('news_events') }}"
                    class="{{ empty($activeCategory) && empty($search) ? 'is-active' : '' }}">All updates</a>
            </li>
            @foreach ($categories as $cat)
                <li>
                    <a href="{{ route('news_events', ['category' => $cat->slug]) }}"
                        class="{{ !empty($activeCategory) && $activeCategory->id === $cat->id ? 'is-active' : '' }}">{{ $cat->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <p class="news-sidebar__note">
        <a href="{{ route('announcements.index') }}">View announcements only</a>
    </p>
</aside>
