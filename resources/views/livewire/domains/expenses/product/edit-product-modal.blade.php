<x-wire-elements-modal  current-route="products.edit">
    <x-slot:body>
        {{ $this->form }}
    </x-slot:body>

    <x-slot:footer class="justify-end">
        <x-button wire:click="update">
            Save
        </x-button>
    </x-slot:footer>
</x-wire-elements-modal>
