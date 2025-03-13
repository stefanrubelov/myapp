@props([
    'model',
    'title',
    'placeholder' => ''
])
<label for="{{ $model }}" class="block text-sm font-medium text-gray-90">
    {{ $title }}
</label>

<input wire:model.live.debounce.250ms="{{ $model }}" type="datetime-local" id="{{ $model }}"
        {{ $attributes->class([
            'mt-1 w-full rounded-lg border-gray-200 text-gray-700 sm:text-sm focus-within:border-teal-700 focus-within:ring-1 focus-within:ring-teal-700',
            'border-red-500' => $errors->has($model)
        ])->merge() }}
>
