<aside class="news-sidebar" aria-label="Filter announcements">
    <form class="news-search" action="{{ route('announcements.index') }}" method="GET">
        @if (!empty($activeCategory))
            <input type="hidden" name="category" value="{{ $activeCategory->slug }}">
        @endif
        <label class="news-search__label" for="announcements-search-input">Search</label>
        <input id="announcements-search-input" type="search" name="search" placeholder="Search announcements…"
            value="{{ $search ?? '' }}">
        <button type="submit" class="news-search__btn">Search</button>
    </form>

    <div class="news-sidebar__block">
        <h2 class="news-sidebar__title">Categories</h2>
        <ul class="news-sidebar__list">
            <li>
                <a href="{{ route('announcements.index') }}"
                    class="{{ empty($activeCategory) && empty($search) ? 'is-active' : '' }}">All announcements</a>
            </li>
            @foreach ($categories as $cat)
                <li>
                    <a href="{{ route('announcements.index', ['category' => $cat->slug]) }}"
                        class="{{ !empty($activeCategory) && $activeCategory->id === $cat->id ? 'is-active' : '' }}">{{ $cat->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    @if (!empty($related) && $related->count())
        <div class="news-sidebar__block">
            <h2 class="news-sidebar__title">Related</h2>
            <ul class="news-sidebar__list">
                @foreach ($related as $item)
                    <li>
                        <a href="{{ route('announcements.show', $item->slug) }}">{{ $item->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <p class="news-sidebar__note">
        <a href="{{ route('news_events') }}">View all news &amp; events</a>
    </p>
</aside>
