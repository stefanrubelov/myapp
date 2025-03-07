<div
    x-
    x-data="{
        open: false,
        get iconClass() {
            return this.open ? 'transform rotate-180' : ''
        }
    }"
    class="relative"
>
    <label class="block text-sm font-medium text-gray-900 text-end">
        Sort by
    </label>
    <button
        @click="open = !open"
        class="flex items-center justify-between w-full py-2.5 px-3 rounded-lg border border-gray-200 text-gray-500 sm:text-sm focus:border-teal-700 focus:ring-1 focus:ring-teal-700"
    >
        {{ $sortOptions[$sortField] }}

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-4 transition-transform duration-200"
            :class="iconClass"
            viewBox="0 0 20 20"
            fill="currentColor"
        >
            <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"
            />
        </svg>
    </button>

    <div
        x-cloak
        x-show="open"
        @click.outside="open = false"
        class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-lg border border-gray-200"
    >
        @foreach($sortOptions as $field => $label)
            <button
                wire:click="sort('{{ $field }}')"
                @click="open = false"
                class="flex items-center justify-between w-full px-4 py-2 text-sm hover:bg-gray-200 @if($sortField == $field) bg-gray-100 rounded-md @endif"
            >
                {{ $label }}
                @if($sortField === $field)
                    <svg viewBox="0 0 24 24" class="h-4 w-4 transition-transform duration-200"
                         :class="{ 'transform rotate-180': '{{ $sortDirection }}' === 'desc' }"
                         fill="none"
                         stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M12 20L18 14M12 20L6 14M12 20L12 9.5M12 4V6.5" stroke="#1C274C" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                @endif
            </button>
        @endforeach
    </div>
</div>
