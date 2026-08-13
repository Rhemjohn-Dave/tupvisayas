<aside class="news-sidebar" aria-label="Hiring navigation">
    <div class="news-sidebar__block">
        <h2 class="news-sidebar__title">Office</h2>
        <ul class="news-sidebar__list">
            <li>
                <a href="{{ route('human-resources') }}"
                    class="{{ empty($isSit) ? 'is-active' : '' }}">Human Resources</a>
            </li>
            <li>
                <a href="{{ route('sit') }}#sit-recruitment"
                    class="{{ !empty($isSit) ? 'is-active' : '' }}">SIT campus recruitment</a>
            </li>
        </ul>
    </div>

    @if (!empty($related) && $related->count())
        <div class="news-sidebar__block">
            <h2 class="news-sidebar__title">Related</h2>
            <ul class="news-sidebar__list">
                @foreach ($related as $item)
                    <li>
                        <a href="{{ route('jobs.show', $item->slug) }}">{{ $item->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <p class="news-sidebar__note">
        @if (!empty($isSit))
            <a href="{{ route('sit') }}">Back to SIT page</a>
        @else
            <a href="{{ route('human-resources') }}">Back to Human Resources</a>
        @endif
    </p>
</aside>
