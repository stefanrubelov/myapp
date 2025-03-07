<button
    {{ $attributes->merge(['class' => 'inline-block rounded-lg border border-teal-600 bg-white px-6 py-2 text-sm font-medium text-teal-600 hover:bg-teal-600 hover:text-white focus:outline-none focus:ring-3 focus:ring-teal-400 active:bg-teal-700 cursor-pointer dark:border-0 dark:bg-slate-800 dark:text-teal-400 dark:hover:bg-teal-500 dark:hover:text-white dark:focus:ring-teal-300 dark:active:bg-teal-600 transition ease-in-out duration-300'])}}>
    {{ $slot }}
</button>
