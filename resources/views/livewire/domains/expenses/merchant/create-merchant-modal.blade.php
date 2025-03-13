<x-wire-elements-modal current-route="merchants.create">
    <x-slot:body class="py-8">
        <div>
            {{ $this->form }}
        </div>
    </x-slot:body>

    <x-slot:footer class="justify-end py-5">
        <x-button wire:click="save">
            Save
        </x-button>
    </x-slot:footer>
</x-wire-elements-modal>

