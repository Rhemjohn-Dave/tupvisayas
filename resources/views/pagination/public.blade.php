{{-- Text-only pagination for public pages (styled in public/css/site.css) --}}
@if ($paginator->hasPages())
    <nav class="site-pagination" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span>{{ __('pagination.previous') }}</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ __('pagination.previous') }}</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('pagination.next') }}</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>{{ __('pagination.next') }}</span></li>
            @endif
        </ul>
    </nav>
@endif
