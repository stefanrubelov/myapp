<x-wire-elements-modal current-route="products.create">
    <x-slot:body>
        {{ $this->form }}
    </x-slot:body>

    <x-slot:footer class="justify-end">
        <x-button wire:click="save">
            Save
        </x-button>
    </x-slot:footer>
</x-wire-elements-modal>
