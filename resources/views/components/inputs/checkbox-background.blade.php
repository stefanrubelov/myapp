@props([
    'placeholder',
    'model'
])
<label
    for="{{ $model }}"
    class="flex cursor-pointer items-start gap-4 rounded-lg border border-gray-200 p-1.5 transition hover:bg-gray-50 has-checked:bg-teal-100"
>
    <div class="flex items-center">
        &#8203;
        <input wire:model.live="{{ $model }}" type="checkbox" id="{{ $model }}"
        {{ $attributes->class([
            'size-4 rounded-sm text-teal-700 border-gray-300 focus-within:border-none focus-within:ring-0 ',
            'border-red-500' => $errors->has($model)
        ])->merge() }}
        />
    </div>

    <div>
        <strong class="font-sm text-gray-600"> {{ $placeholder }} </strong>
    </div>
</label>
