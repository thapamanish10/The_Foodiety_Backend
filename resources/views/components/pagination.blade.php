@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-container {{ $style }}">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-item disabled" aria-disabled="true">
                &laquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-item" aria-label="Previous">
                &laquo;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - $onEachSide), min($paginator->lastPage(), $paginator->currentPage() + $onEachSide)) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="pagination-item active" aria-current="page">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pagination-item" aria-label="Go to page {{ $page }}">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-item" aria-label="Next">
                &raquo;
            </a>
        @else
            <span class="pagination-item disabled" aria-disabled="true">
                &raquo;
            </span>
        @endif
    </nav>
@endif
<style>
    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 4rem 0;
        gap: 0.5rem;
    }

    .pagination-item {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 1.75rem;
        height: 1.75rem;
        padding: 0 0.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        color: #5f5f5f;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination-item:hover:not(.disabled) {
        background-color: #f7fafc;
        border-color: #cbd5e0;
    }

    .pagination-item.active {
        background-color: #ffde59;
        border-color: #ffde59;
        color: #5f5f5f;
    }

    .pagination-item.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Style Variations */
    .pagination-container.minimal .pagination-item {
        border: none;
        background: transparent;
    }

    .pagination-container.rounded .pagination-item {
        border-radius: 9999px;
    }

    .pagination-container.large .pagination-item {
        min-width: 3rem;
        height: 3rem;
        font-size: 1.125rem;
    }
</style>
