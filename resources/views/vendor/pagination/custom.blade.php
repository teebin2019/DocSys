@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center mt-4" aria-label="หน้าที่">
        <ul class="pagination pagination-sm custom-pagination">

            {{-- ก่อนหน้า --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo; ก่อนหน้า</span></li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; ก่อนหน้า</a>
                </li>
            @endif

            {{-- หน้าต่าง ๆ --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span
                                    class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- ถัดไป --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">ถัดไป &raquo;</a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">ถัดไป &raquo;</span></li>
            @endif

        </ul>
    </nav>
@endif
