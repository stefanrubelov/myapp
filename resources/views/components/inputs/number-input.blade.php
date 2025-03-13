@props([
    'model',
    'title',
    'placeholder',
])

<div class="w-full">
    <label for="{{ $model }}" class="block text-sm font-medium text-gray-900 dark:text-white"> {{ $title }} </label>

    <input
        wire:model.live="{{ $model }}"
        inputmode="decimal"
        type="text"
        pattern="[0-9]*[.,]?[0-9]*"
        placeholder="{{ $placeholder }}"
        id="{{ $model }}"
        {{ $attributes->class([
            'w-full rounded-lg border-gray-200 shadow-xs sm:text-sm focus-within:border-teal-700 focus-within:ring-1 focus-within:ring-teal-700 dark:bg-slate-800 dark:text-white',
            'border-red-500' => $errors->has($model)
        ])->merge() }}
    />
</div>
