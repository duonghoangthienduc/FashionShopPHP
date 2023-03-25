@if ($paginator->hasPages())
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div aria-live="polite" style="padding-top: 0.85em">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    {{ $paginator->firstItem() }}
                    {!! __('to') !!}
                    {{ $paginator->lastItem() }}
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                {{ $paginator->total() }}
                {!! __('results') !!}

            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div style="text-align: right;">
                <ul class="pagination"
                    style=" margin: 2px 0;
                            white-space: nowrap;
                            justify-content: flex-end">
                    @if ($paginator->onFirstPage())
                        {{-- <li class="paginate_button page-item next" id="example2_next"><a
                        href="{{ $paginator->nextPageUrl() }}" aria-controls="example2" data-dt-idx="7"
                        tabindex="0" class="page-link">Next</a></li> --}}
                        <li class="paginate_button page-item previous disabled" id="example2_previous"><a
                                href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="0"
                                tabindex="0" class="page-link">Previous</a>
                        </li>
                    @else
                        <li class="paginate_button page-item previous" id="example2_previous"><a
                                href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="0"
                                tabindex="0" class="page-link">Previous</a>
                        </li>
                    @endif
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="paginate_button page-item active"><a href="#"
                                            aria-controls="example2" data-dt-idx="{{ $page }}" tabindex="0"
                                            class="page-link">{{ $page }}</a></li>
                                @else
                                    <li class="paginate_button page-item "><a href="{{ $url }}"
                                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                            aria-controls="example2" data-dt-idx="{{ $page }}" tabindex="0"
                                            class="page-link">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="paginate_button page-item next" id="example2_next"><a
                                href="{{ $paginator->nextPageUrl() }}" aria-controls="example2" data-dt-idx="7"
                                tabindex="0" class="page-link">Next</a></li>
                    @else
                        <li class="paginate_button page-item next disabled" id="example2_next"><a
                                href="{{ $paginator->nextPageUrl() }}" aria-controls="example2" data-dt-idx="7"
                                tabindex="0" class="page-link">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif
