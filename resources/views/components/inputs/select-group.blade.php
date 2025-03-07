@props([
    'model',
    'placeholder',
    'data',
])
<label for="{{ $model }}" class="block text-sm font-medium text-gray-900">{{ $placeholder }}</label>

<select
    wire:model="{{ $model }}"
    id="{{ $model }}"
    {{ $attributes->class([
            'mt-1 w-full rounded-lg border-gray-200 text-gray-700 sm:text-sm focus-within:border-teal-700 focus-within:ring-1 focus-within:ring-teal-700',
            'border-red-500' => $errors->has($model)
        ])->merge() }}
>
    <option hidden>Select one</option>
    @foreach($data as $key => $values)
        <optgroup label="{{ $key }}">
            @foreach($values as $value)
                <option value="{{ $value->id  }}">{{ $value->name }}</option>
            @endforeach
        </optgroup>
    @endforeach
</select>
