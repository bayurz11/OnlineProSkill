@if ($paginator->hasPages())
    <nav class="pagination__wrap mt-30">
        <ul class="list-wrap"
            style="display: flex; justify-content: center; align-items: center; list-style: none; padding: 0;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" style="margin: 0 5px;">
                    <span
                        style="display: block; width: 50px; height: 50px; background-color: #f5f5f5; color: #aaa; border-radius: 50%; text-align: center; line-height: 50px;">&laquo;</span>
                </li>
            @else
                <li style="margin: 0 5px;">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        style="display: block; width: 50px; height: 50px; background-color: #f5f5f5; color: #007F73; border-radius: 50%; text-align: center; line-height: 50px;">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" style="margin: 0 5px;">
                        <span
                            style="display: block; width: 50px; height: 50px; background-color: #f5f5f5; color: #aaa; border-radius: 50%; text-align: center; line-height: 50px;">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="margin: 0 5px;">
                                <span
                                    style="display: block; width: 50px; height: 50px; background-color: #007F73; color: white; border-radius: 50%; text-align: center; line-height: 50px;">{{ $page }}</span>
                            </li>
                        @else
                            <li style="margin: 0 5px;">
                                <a href="{{ $url }}"
                                    style="display: block; width: 50px; height: 50px; background-color: #f5f5f5; color: #007F73; border-radius: 50%; text-align: center; line-height: 50px;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="margin: 0 5px;">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        style="display: block; width: 50px; height: 50px; background-color: #f5f5f5; color: #007F73; border-radius: 50%; text-align: center; line-height: 50px;">&raquo;</a>
                </li>
            @else
                <li class="disabled" style="margin: 0 5px;">
                    <span
                        style="display: block; width: 50px; height: 50px; background-color: #f5f5f5; color: #aaa; border-radius: 50%; text-align: center; line-height: 50px;">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
