<div>
    <div class="flex flex-row justify-between mb-4">
        <x-button wire:click="$dispatch('openModal', { component: 'expenses.merchant.create-merchant-modal' })">
            Add merchant
        </x-button>
    </div>
    <x-tables.table-template>
        <x-slot:head>
            <x-tables.header-cell class="rounded-tl-lg">
                #
            </x-tables.header-cell>

            <x-tables.header-cell>
                Name
            </x-tables.header-cell>

            <x-tables.header-cell>
                Category
            </x-tables.header-cell>

            <x-tables.header-cell>
                Created at
            </x-tables.header-cell>

            <x-tables.header-cell>
                Accent color
            </x-tables.header-cell>

            <x-tables.header-cell class="rounded-tr-lg">
                Actions
            </x-tables.header-cell>
        </x-slot:head>

        <x-slot:body>
            @foreach($merchants as $merchant)
                <tr class="odd:bg-white odd:dark:bg-slate-800 even:bg-gray-50 even:dark:bg-slate-900"
                    wire:key="{{uniqid()}}">
                    <x-tables.data-cell>
                        {{ $merchant->id }}
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        <a wire:navigate href="{{ route('merchant.view', ['merchant' => $merchant]) }}"
                           class="hover:underline">
                            {{ $merchant->name }}
                        </a>
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        {{ $merchant->category->name}}
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        {{ Carbon\Carbon::parse($merchant->created_at)->diffForHumans() }}
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        <button type="button" onclick="copyToClipboard('{{$merchant->accent_color}}')"
                                class="w-24 h-4 py-4 mx-auto flex flex-row rounded-lg"
                                style="background: {{$merchant->accent_color}}">

                        </button>
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        <x-tables.actions-container>
                            <x-tables.action-modal-button
                                onclick="Livewire.dispatch('openModal', { component: 'expenses.merchant.view-merchant-modal', arguments: { merchantId: {{ $merchant->id }} }})">
                                <x-icons.view fill="#6b7280"/>
                                <span>View</span>
                            </x-tables.action-modal-button>

                            <x-tables.action-modal-button
                                onclick="Livewire.dispatch('openModal', { component: 'expenses.merchant.edit-merchant-modal', arguments: { merchant: {{ $merchant }} }})">
                                <x-icons.edit fill="#6b7280"/>
                                <span>Edit</span>
                            </x-tables.action-modal-button>

                            <x-tables.action-modal-button
                                onclick="Livewire.dispatch('openModal', { component: 'expenses.merchant.delete-merchant-modal', arguments: { merchant: {{ $merchant }} }})">
                                <x-icons.trashcan class="text-red-500" fill="#ef4444"/>
                                <span>Delete</span>
                            </x-tables.action-modal-button>
                        </x-tables.actions-container>
                    </x-tables.data-cell>
                </tr>
            @endforeach
        </x-slot:body>

    </x-tables.table-template>

    <x-tables.pagination>
        {{ $merchants->links()}}
    </x-tables.pagination>
</div>
<script>
    function copyToClipboard(value) {
        navigator.clipboard.writeText(value);
        Livewire.dispatch('sendNotification', {title: 'Copied to clipboard'})
    }
</script>

