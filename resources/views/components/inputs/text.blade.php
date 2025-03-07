@props([
    'model',
    'title',
    'placeholder',
])
<label for="{{ $model }}" class="block text-sm font-medium text-slate-800 dark:text-white">
    {{ $title }}
</label>

<input
    wire:model.live="{{ $model }}"
    type="text"
    id="{{ $model }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class'=> 'w-full rounded-lg border-gray-200 dark:border-slate-400 shadow-xs focus-within:border-teal-700 dark:focus-within:border-teal-700 focus-within:ring-1 focus-within:ring-teal-700 bg-white dark:bg-slate-800 dark:placeholder-slate-400 dark:text-white dark:caret-white']) }}
/>
