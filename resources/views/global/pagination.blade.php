@if ($paginator->hasPages())
    <nav>
        <ul class="pagination pagination-rounded mb-0 mt-2 justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif

            {{--            <li class="page-item">--}}
            {{--                <a class="page-link" href="javascript: void(0);" aria-label="Previous">--}}
            {{--                    <span aria-hidden="true">&laquo;</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>--}}
            {{--            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>--}}
            {{--            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>--}}
            {{--            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>--}}
            {{--            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>--}}
            {{--            <li class="page-item">--}}
            {{--                <a class="page-link" href="javascript: void(0);" aria-label="Next">--}}
            {{--                    <span aria-hidden="true">&raquo;</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
        </ul>
    </nav>
@endif
