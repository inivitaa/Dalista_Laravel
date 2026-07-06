@if ($paginator->hasPages())
<nav class="flex items-center gap-2">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="px-4 py-2 rounded-xl border border-gray-200 text-gray-400 bg-gray-50">
            Previous
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="px-4 py-2 rounded-xl border border-gray-200 hover:bg-gray-50">
            Previous
        </a>
    @endif

    {{-- Nomor Halaman --}}
    @foreach ($elements as $element)

        @if(is_array($element))

            @foreach($element as $page => $url)

                @if($page == $paginator->currentPage())

                    <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-500 text-white font-semibold">
                        {{ $page }}
                    </span>

                @else

                    <a href="{{ $url }}"
                       class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-200 hover:bg-gray-50">
                        {{ $page }}
                    </a>

                @endif

            @endforeach

        @endif

    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="px-4 py-2 rounded-xl border border-gray-200 hover:bg-gray-50">
            Next
        </a>
    @else
        <span class="px-4 py-2 rounded-xl border border-gray-200 text-gray-400 bg-gray-50">
            Next
        </span>
    @endif

</nav>
@endif