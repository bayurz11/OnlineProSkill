@if ($paginator->hasPages())
    <nav class="pagination__wrap mt-30">
        <ul class="list-wrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&laquo;</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li
                                style="display: inline-block; width: 50px; height: 50px; background-color: #007F73; color: white; border-radius: 100px; text-align: center; line-height: 40px; padding: 10px 10px;">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li style="display: inline-block;">
                                <a href="{{ $url }}"
                                    style="display: block; padding: 10px 15px;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span>&raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
