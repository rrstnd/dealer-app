@if ($paginator->hasPages())
    <nav class="flex items-center justify-between" role="navigation" aria-label="Pagination">

        {{-- INFO --}}
        <div class="text-sm text-slate-500">
            Halaman
            <span class="font-semibold text-slate-700">
                {{ $paginator->currentPage() }}
            </span>
            dari
            <span class="font-semibold text-slate-700">
                {{ $paginator->lastPage() }}
            </span>
        </div>

        {{-- PAGINATION --}}
        <div class="flex items-center gap-1">

            {{-- PREVIOUS --}}
            @if ($paginator->onFirstPage())

                <span
                    class="inline-flex items-center justify-center
                           w-9 h-9 rounded-lg
                           border border-slate-200
                           text-slate-300
                           cursor-not-allowed"
                >
                    ‹
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    class="inline-flex items-center justify-center
                           w-9 h-9 rounded-lg
                           border border-slate-200
                           text-slate-600
                           hover:bg-slate-100
                           hover:text-slate-900
                           transition"
                >
                    ‹
                </a>

            @endif


            {{-- PAGE NUMBERS --}}
            @foreach ($elements as $element)

                {{-- THREE DOTS --}}
                @if (is_string($element))

                    <span
                        class="inline-flex items-center justify-center
                               w-9 h-9 text-sm text-slate-400"
                    >
                        {{ $element }}
                    </span>

                @endif


                {{-- ARRAY OF LINKS --}}
                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span
                                class="inline-flex items-center justify-center
                                       w-9 h-9 rounded-lg
                                       bg-slate-900
                                       text-white
                                       text-sm font-semibold"
                            >
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="inline-flex items-center justify-center
                                       w-9 h-9 rounded-lg
                                       text-sm text-slate-600
                                       hover:bg-slate-100
                                       hover:text-slate-900
                                       transition"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach


            {{-- NEXT --}}
            @if ($paginator->hasMorePages())

                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    class="inline-flex items-center justify-center
                           w-9 h-9 rounded-lg
                           border border-slate-200
                           text-slate-600
                           hover:bg-slate-100
                           hover:text-slate-900
                           transition"
                >
                    ›
                </a>

            @else

                <span
                    class="inline-flex items-center justify-center
                           w-9 h-9 rounded-lg
                           border border-slate-200
                           text-slate-300
                           cursor-not-allowed"
                >
                    ›
                </span>

            @endif

        </div>

    </nav>
@endif



