{{-- Previous / next only (simple paginator) --}}
@if ($paginator->hasPages())
    <nav class="admin-pagination-nav" role="navigation" aria-label="Pagination">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span>{!! __('pagination.previous') !!}</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">{!! __('pagination.previous') !!}</a></li>
            @endif
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">{!! __('pagination.next') !!}</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>{!! __('pagination.next') !!}</span></li>
            @endif
        </ul>
    </nav>
@endif
