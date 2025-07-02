@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación" class="flex items-center gap-1">
        {{-- link previo --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-full cursor-not-allowed select-none">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="px-4 py-2 text-gray-500 bg-white hover:bg-primary-50 rounded-full transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary-200">&laquo;</a>
        @endif

        {{-- elementos de la paginacion --}}
        @foreach ($elements as $element)
            {{-- separador --}}
            @if (is_string($element))
                <span class="px-3 py-2 text-gray-400 select-none">{{ $element }}</span>
            @endif

            {{-- link de arrays --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="px-4 py-2 bg-primary-600 text-white rounded-full font-semibold shadow select-none">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-4 py-2 text-gray-700 bg-white hover:bg-primary-50 rounded-full transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary-200">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- next link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="px-4 py-2 text-gray-500 bg-white hover:bg-primary-50 rounded-full transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-primary-200">&raquo;</a>
        @else
            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-full cursor-not-allowed select-none">&raquo;</span>
        @endif
    </nav>
@endif
