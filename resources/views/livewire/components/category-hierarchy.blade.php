<div>
    <nav aria-label="">
        <ol class="flex flex-row items-center gap-1 text-md text-gray-400 ">
            @foreach ($categories as $categoryItem)
                @if(!$loop->first)
                    <x-heroicon-c-chevron-right class="size-4"></x-heroicon-c-chevron-right>
                @endif
                <li class="@if($categoryItem->is($category)) text-gray-700 text-lg @endif hover:text-gray-700 hover:underline">
                    <a wire:navigate
                       href="{{ route('category.view', ['category' => $categoryItem] ) }}">{{ $categoryItem->name }}</a>
                </li>
            @endforeach
{{--                <x-heroicon-c-chevron-right class="size-4"></x-heroicon-c-chevron-right>--}}
{{--                <li class="">--}}
{{--                    <a wire:click="$dispatch('openModal', { component: 'components.category-hierarchy-tree-modal', arguments: { currentCategory: '{{ $category->slug }}' }})" class="hover:underline">Full category tree</a>--}}
{{--                </li>--}}
        </ol>
    </nav>
</div>

