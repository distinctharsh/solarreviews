@if ($paginator->hasPages())
    <div class="admin-pagination">
        <div class="admin-pagination__info">
            @if ($paginator->firstItem())
                Showing <strong>{{ number_format($paginator->firstItem()) }}</strong>
                to <strong>{{ number_format($paginator->lastItem()) }}</strong>
                of <strong>{{ number_format($paginator->total()) }}</strong> results
            @else
                Showing <strong>{{ number_format($paginator->count()) }}</strong> results
            @endif
        </div>

        <nav class="admin-pagination__nav" role="navigation" aria-label="Pagination Navigation">
            <ul class="admin-pagination__list">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="admin-pagination__button is-disabled" aria-disabled="true">
                            <i class="fas fa-chevron-left"></i>
                            Previous
                        </span>
                    </li>
                @else
                    <li>
                        <a class="admin-pagination__button" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="fas fa-chevron-left"></i>
                            Previous
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <span class="admin-pagination__button is-dots" aria-disabled="true">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li>
                                @if ($page == $paginator->currentPage())
                                    <span class="admin-pagination__button is-active" aria-current="page">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a class="admin-pagination__button" href="{{ $url }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a class="admin-pagination__button" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            Next
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li>
                        <span class="admin-pagination__button is-disabled" aria-disabled="true">
                            Next
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif




@push('styles')
<style>
/* Admin Pagination Container */
.admin-pagination {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
    padding: 16px;
}

.admin-pagination__info {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 12px;
}

.admin-pagination__nav {
    width: 100%;
    display: flex;
    justify-content: center;
}

.admin-pagination__list {
    list-style: none;
    display: flex;
    gap: 6px;
    padding: 0;
    margin: 0;
}

.admin-pagination__button {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #fff;
    color: #334155;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.admin-pagination__button:hover {
    background: #f1f5f9;
    border-color: #cbd5f5;
}

.admin-pagination__button.is-active {
    background: #0f172a;
    color: #fff;
    border-color: #0f172a;
}

.admin-pagination__button.is-disabled {
    color: #94a3b8;
    background: #f8fafc;
    cursor: not-allowed;
}

.admin-pagination__button.is-dots {
    border: none;
    background: transparent;
    cursor: default;
}
</style>
@endpush

