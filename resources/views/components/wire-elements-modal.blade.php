@props([
    'currentRoute' => '',
    'type' => ''
])

<div class="p-10 bg-white dark:bg-slate-700">
    <div class="flex flex-row align-items-center justify-between w-full">
        @livewire('components.breadcrumbs', ['currentRoute' => $currentRoute])
        <span wire:click="$dispatch('closeModal')" class="size-6 fill-current pb-1 cursor-pointer">
            <x-heroicon-o-x-circle class="size-7 text-slate-900 dark:text-white hover:scale-110 transition"/>
        </span>
    </div>

    <div {{ $body->attributes->merge(['class' => 'py-6 text-slate-900 dark:text-white']) }}>
        {{ $body }}
    </div>

    <div {{ $footer->attributes->class(['w-full', 'flex', 'flex-row', 'justify-center' => $type == 'delete', 'space-x-4' => $type == 'delete']) }}>
        @if($type == 'delete')
            <x-button wire:click="$dispatch('closeModal')">
                Cancel
            </x-button>
            <x-button wire:click="delete"
                      class="!border-red-600 !text-red-600 hover:!bg-red-600 hover:!text-white !focus:ring-red-400 !active:bg-red-700 !font-extrabold">
                Delete
            </x-button>
        @else
            {{ $footer }}
        @endif
    </div>
</div>
