@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-sm text-gray-600 border border-gray-800 rounded-md cursor-default">Précédent</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-300 border border-gray-700 rounded-md hover:bg-gray-800">Précédent</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-300 border border-gray-700 rounded-md hover:bg-gray-800">Suivant</a>
            @else
                <span class="px-3 py-1.5 text-sm text-gray-600 border border-gray-800 rounded-md cursor-default">Suivant</span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <p class="text-sm text-gray-500">
                {{ __('Affichage de') }}
                <span class="font-medium text-gray-300">{{ $paginator->firstItem() ?? 0 }}</span>
                {{ __('à') }}
                <span class="font-medium text-gray-300">{{ $paginator->lastItem() ?? 0 }}</span>
                {{ __('sur') }}
                <span class="font-medium text-gray-300">{{ $paginator->total() }}</span>
                {{ __('résultats') }}
            </p>

            <div class="flex items-center gap-1">
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-1.5 text-sm text-gray-600 border border-gray-800 rounded-md cursor-default">&laquo;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-300 border border-gray-700 rounded-md hover:bg-gray-800">&laquo;</a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 py-1.5 text-sm text-gray-600">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded-md">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1.5 text-sm text-gray-300 border border-gray-700 rounded-md hover:bg-gray-800">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm text-gray-300 border border-gray-700 rounded-md hover:bg-gray-800">&raquo;</a>
                @else
                    <span class="px-3 py-1.5 text-sm text-gray-600 border border-gray-800 rounded-md cursor-default">&raquo;</span>
                @endif
            </div>
        </div>
    </nav>
@endif
