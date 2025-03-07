<div x-data="{ open: false }" class="relative">
    <button
        @click="open = !open"
        class="inline-flex items-center rounded-lg border border-slate-100 dark:border-slate-400 bg-white dark:bg-slate-900 h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700">
        <x-heroicon-c-ellipsis-vertical class="size-4 dark:text-white"/>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-4"
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
        x-transition
        class="absolute end-0 z-10 mt-0.5 w-52 rounded-md border border-slate-100 dark:border-slate-400 bg-white dark:bg-slate-900 shadow-2xl dark:shadow-lg dark:shadow-gray-700 overflow-hidden"
        role="menu"
    >
        <div class="divide-y dark:divide-slate-400 px-0">
            {{$slot}}
        </div>
    </div>
</div>
