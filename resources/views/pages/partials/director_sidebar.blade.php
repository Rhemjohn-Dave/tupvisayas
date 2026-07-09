<aside class="news-sidebar" aria-label="Director's Corner navigation">
    @if ($director ?? null)
        <section class="news-sidebar__block director-sidebar-profile">
            @if ($director->photo)
                <img class="director-sidebar-profile__photo" src="{{ asset('storage/' . $director->photo) }}"
                    alt="{{ $director->name }}" loading="lazy">
            @endif
            <p class="director-sidebar-profile__name">{{ $director->name }}</p>
            <p class="director-sidebar-profile__role">{{ $director->position }}</p>
        </section>
    @endif

    <section class="news-sidebar__block">
        <h2 class="news-sidebar__title">Browse</h2>
        <ul class="news-sidebar__list">
            <li>
                <a href="{{ route('directors.corner') }}"
                    class="{{ empty(request('type')) ? 'is-active' : '' }}">All posts</a>
            </li>
            <li>
                <a href="{{ route('directors.corner', ['type' => 'news']) }}"
                    class="{{ request('type') === 'news' ? 'is-active' : '' }}">News</a>
            </li>
            <li>
                <a href="{{ route('directors.corner', ['type' => 'blog']) }}"
                    class="{{ request('type') === 'blog' ? 'is-active' : '' }}">Blog</a>
            </li>
        </ul>
    </section>

    <p class="news-sidebar__back">
        <a href="{{ route('directors.corner') }}">&larr; Director's Corner</a>
    </p>
</aside>
