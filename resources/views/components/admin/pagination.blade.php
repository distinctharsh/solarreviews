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
