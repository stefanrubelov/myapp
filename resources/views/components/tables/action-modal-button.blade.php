<button type="button"
        role="menuitem"
    {{$attributes->merge(['class' => 'flex w-full space-x-1 flex-row items-center justify-center px-4 py-2.5 text-sm text-gray-500 dark:text-white hover:bg-gray-50 dark:hover:bg-slate-700 hover:text-gray-700'])}}
>
    {{ $slot }}
</button>
