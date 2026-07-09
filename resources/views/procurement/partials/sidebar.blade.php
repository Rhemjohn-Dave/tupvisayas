<aside class="news-sidebar" aria-label="Filter procurement records">
    <form class="news-search" action="{{ route($filterRoute) }}" method="GET">
        @if (request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <label class="news-search__label" for="procurement-search-input">Search</label>
        <input id="procurement-search-input" type="search" name="q" placeholder="Search title or reference no…"
            value="{{ request('q') }}">
        <button type="submit" class="news-search__btn">Search</button>
    </form>

    <div class="news-sidebar__block">
        <h2 class="news-sidebar__title">Categories</h2>
        <ul class="news-sidebar__list">
            <li>
                <a href="{{ route($filterRoute, array_filter(['q' => request('q')])) }}"
                    class="{{ !request('category') ? 'is-active' : '' }}">All categories</a>
            </li>
            @foreach ($categories as $cat)
                <li>
                    <a href="{{ route($filterRoute, array_filter(['q' => request('q'), 'category' => $cat])) }}"
                        class="{{ request('category') === $cat ? 'is-active' : '' }}">{{ $cat }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    @if (!empty($otherLink))
        <p class="news-sidebar__note">
            <a href="{{ route($otherLink['route']) }}">{{ $otherLink['label'] }}</a>
        </p>
    @endif
</aside>
