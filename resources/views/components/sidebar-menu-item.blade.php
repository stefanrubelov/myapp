@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200'
                : 'block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
