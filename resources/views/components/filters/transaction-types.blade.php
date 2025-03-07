<label class="block text-sm font-medium text-slate-800 dark:text-white">
    Transaction types
</label>
<div class="relative w-full" x-data="{ isOpen: false }">
    <div
        @click="isOpen = !isOpen"
        @keydown.escape.window="isOpen = false"
        class="inline-flex items-center py-2.5 px-1 justify-between overflow-hidden border bg-white dark:bg-slate-800 w-full rounded-lg border-gray-200 shadow-xs focus-within:border-teal-700 focus-within:ring-1 focus-within:ring-teal-700">
        <button
            type="button"
            class="text-sm/none text-slate-600 dark:text-white flex flex-between items-center justify-between w-full"
        >
            <span>
                Select
            </span>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-4"
                viewBox="0 0 20 20"
                fill="currentColor"
                :class="{ 'rotate-180': isOpen }"
            >
                <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </div>

    <div
        x-placement=""
        x-show="isOpen"
        @click.away="isOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute end-0 z-10 mt-2 w-56 rounded-md border border-gray-100 bg-white dark:bg-slate-800 shadow-lg"
        role="menu"
        style="display: none;"
    >
        <div class="p-2 flex flex-col">
            @foreach($transactionTypes as $item)
                <div>
                    <input wire:model.live="selectedTransactionTypes.{{$item->id}}"
                           value="{{$item->id}}"
                           type="checkbox"
                           id="transactionType_{{$item->id}}"
                           class="size-4 rounded-sm text-teal-700 border-gray-300 focus-within:border-none focus-within:ring-0 "/>
                    <label for="transactionType_{{$item->id}}" class="dark:text-white">{{ $item->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
