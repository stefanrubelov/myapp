<div>
    <div class="flex flex-row justify-between mb-4">
        <x-button wire:click="$dispatch('openModal', { component: 'domains.expenses.product.create-product-modal' })">
            Add product
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

            <x-tables.header-cell class="rounded-tr-lg">
                Actions
            </x-tables.header-cell>
        </x-slot:head>

        <x-slot:body>
            @foreach($products as $product)
                <tr class="odd:bg-white odd:dark:bg-slate-800 even:bg-gray-50 even:dark:bg-slate-900">
                    <x-tables.data-cell>
                        {{ $product->id }}
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        <a wire:navigate href="{{ route('product.view', ['product' => $product]) }}"
                           class="hover:underline">
                            {{ $product->name }}
                        </a>
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        {{ $product->category->name}}
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        {{ Carbon\Carbon::parse($product->created_at)->diffForHumans() }}
                    </x-tables.data-cell>

                    <x-tables.data-cell>
                        <x-tables.actions-container>
                            <x-tables.action-modal-button
                                onclick="Livewire.dispatch('openModal', { component: 'domains.expenses.product.view-product-modal', arguments: { productId: {{ $product->id }} }})">
                                <x-icons.view fill="#6b7280"/>
                                <span>View</span>
                            </x-tables.action-modal-button>

                            <x-tables.action-modal-button
                                onclick="Livewire.dispatch('openModal', { component: 'domains.expenses.product.edit-product-modal', arguments: { product: {{ $product }} }})">
                                <x-icons.edit fill="#6b7280"/>
                                <span>Edit</span>
                            </x-tables.action-modal-button>

                            <x-tables.action-modal-button
                                onclick="Livewire.dispatch('openModal', { component: 'domains.expenses.product.delete-product-modal', arguments: { product: {{ $product }} }})">
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
        {{ $products->links()}}
    </x-tables.pagination>
</div>

