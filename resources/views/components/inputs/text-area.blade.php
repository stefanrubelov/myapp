@props([
    'placeholder',
    'model',
])

<div class="w-full">
    <label for="{{ $model }}" class="block text-sm font-medium text-gray-700"> {{ $placeholder }} </label>

    <textarea
        wire:model="{{ $model }}"
        id="{{ $model }}"
        rows="5"
        {{ $attributes->class([
            'mt-2 w-full rounded-lg border-gray-200 align-top shadow-xs sm:text-sm',
            'border-red-500' => $errors->has($model)
        ])->merge() }}
    ></textarea>
</div>
