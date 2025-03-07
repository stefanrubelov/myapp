<div class="flex flex-col">
    <div class="flex items-center relative">
        @if($hasParent)
            <div class="absolute h-0.5 bg-gray-400 w-5 -left-6"></div>
        @endif

        @if($currentCategory['slug'] == $category['slug'])
            <div class="bg-teal-600 text-white px-3 py-1.5 rounded-full text-sm font-medium whitespace-nowrap">
                <a href="{{ route('category.view', ['category' => $category['slug']]) }}"
                   class="hover:underline">
                    {{ $category['name'] }}
                </a>
            </div>
        @else
            <a href="{{ route('category.view', ['category' => $category['slug']]) }}"
               class="hover:underline">
                {{ $category['name'] }}
            </a>
        @endif
    </div>

    @if(!empty($category['children']))
        <div class="ml-8 pl-4 border-l-2 border-gray-400">
            {!! $renderTreeItem($category['children'], true) !!}
        </div>
    @endif
</div>

@if(!$isLast)
    <div class="h-1"></div>
@endif
