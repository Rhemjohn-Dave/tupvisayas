@if ($items->count())
    <section class="article-more" aria-labelledby="{{ $headingId }}">
        <h2 id="{{ $headingId }}" class="site-section-title">{{ $heading }}</h2>
        <div class="article-more__list">
            @foreach ($items as $item)
                <a class="article-more__item" href="{{ route($routeName, $item->slug) }}">
                    @if (!empty($item->picture))
                        <div class="article-more__media">
                            <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                        </div>
                    @endif
                    <div class="article-more__body">
                        <time datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->format('M j, Y') }}</time>
                        <span>{{ $item->title }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif
