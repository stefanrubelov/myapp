<div>
    <div class="flex flex-row justify-between mb-4">
        <x-button wire:click="$dispatch('openModal', { component: 'expenses.payment.create-payment-modal' })">
            Add Payment
        </x-button>
    </div>
    <div class="w-full flex flex-row items-end justify-between mb-2">
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-2">
                <x-inputs.text model="productName" title="Product name" placeholder="Bananas"/>
            </div>

            <div class="col-span-2">
                <x-inputs.text model="merchantName" placeholder="Lidl" title="Merchant name"/>
            </div>

            <div class="col-span-1">
                <x-inputs.number-input class="py-2.5" min="{{ $minPrice }}" max="{{ $maxPrice }}" model="minPrice"
                                       title="Price (from)" placeholder=""/>
            </div>

            <div class="col-span-2">
                <x-filters.transaction-types :transaction-types="$transactionTypes"/>
            </div>
            <div class="col-span-2">
                <x-inputs.date-time title="Date (from)" model="paymentDateFrom"/>
            </div>

            <div class="col-span-1 w-full col-start-12">
                <x-filters.per-page :perPage="$perPage" :perPageOptions="$perPageOptions"/>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-2">
            <x-inputs.text model="paymentNumber" title="Payment number" placeholder="#123123"/>
        </div>

        <div class="col-span-2">
            <x-filters.discounted-payment/>
        </div>

        <div class="col-span-1">
            <x-inputs.number-input class="py-2.5" min="{{ $minPrice }}" max="{{ $maxPrice }}" model="maxPrice"
                                   title="Price (to)" placeholder="" x-data="{ value: '{{  $maxPrice }}' }"/>
        </div>

        <div class="col-span-2">
            <x-filters.payment-methods :payment-methods="$paymentMethods"/>
        </div>

        <div class="col-span-2">
            <x-inputs.date-time title="Date (to)" model="paymentDateTo"/>
        </div>

        <div class="col-span-2 col-start-11">
            <x-filters.sort-by :sortOptions="$sortOptions" :sortField="$sortField" :sortDirection="$sortDirection"/>
        </div>
    </div>
    @if(!$payments->isEmpty())
        <x-tables.table-template>
            <x-slot:head>
                <x-tables.header-cell>
                    #
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Product
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Price
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Merchant
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Transaction Type
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Payment Method
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Discounted
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Date
                </x-tables.header-cell>

                <x-tables.header-cell>
                    Actions
                </x-tables.header-cell>
            </x-slot:head>

            <x-slot:body>
                @foreach($payments as $payment)
                    <tr class="odd:bg-white odd:dark:bg-slate-800 even:bg-gray-50 even:dark:bg-slate-900">
                        <x-tables.data-cell>
                            {{  $payment->payment_number }}
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                            @if($payment->product)
                                <a wire:navigate href="{{ route('product.view', ['product' => $payment->product]) }}"
                                   class="hover:underline">
                                    {{ $payment->product->name }}
                                </a>
                            @endif
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                            {{ $payment->price }}
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                            @if($payment->merchant)
                                <a wire:navigate href="{{ route('merchant.view', ['merchant' => $payment->merchant]) }}"
                                   class="hover:underline">
                                    {{ $payment->merchant->name }}
                                </a>
                            @endif
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                        <span class="inline-flex items-center justify-center">
                            @if($payment->transactionType->slug == \App\Enums\TransactionTypeEnum::INCOMING->value)
                                <x-badges.teal-700>
                                        Incoming
                                </x-badges.teal-700>
                            @else
                                <x-badges.red-800>
                                        Outgoing
                                </x-badges.red-800>
                            @endif
                        </span>
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                            @switch($payment->paymentMethod->slug)
                                @case(App\Enums\PaymentMethodEnum::CARD->value)
                                    <x-badges.violet-800>
                                        Card
                                    </x-badges.violet-800>
                                    @break
                                @case(\App\Enums\PaymentMethodEnum::CASH->value)
                                    <x-badges.green>
                                        Cash
                                    </x-badges.green>
                                    @break
                                @case(Str::slug(\App\Enums\PaymentMethodEnum::BANK_TRANSFER->value))
                                    <x-badges.gray>
                                        Bank
                                    </x-badges.gray>
                                    @break
                                @case(Str::slug(\App\Enums\PaymentMethodEnum::MOBILE_PAY->value))
                                    <x-badges.slate-900>
                                        Mobile pay
                                    </x-badges.slate-900>
                            @endswitch
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                        <span class="inline-flex items-center justify-center">
                            @if($payment->discounted)
                                <x-badges.teal-700>
                                    Discounted
                                </x-badges.teal-700>
                            @else
                                <x-badges.gray>
                                    Full price
                                </x-badges.gray>
                            @endif
                        </span>
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                            {{$payment->payment_date}}
                        </x-tables.data-cell>

                        <x-tables.data-cell>
                            <x-tables.actions-container>
                                <x-tables.action-modal-button
                                    onclick="Livewire.dispatch('openModal', { component: 'expenses.payment.view-payment-modal', arguments: { payment: {{ $payment }} }})">
                                    <x-heroicon-o-eye class="size-5"/>
                                    <span>View</span>
                                </x-tables.action-modal-button>

                                <x-tables.action-modal-button
                                    onclick="Livewire.dispatch('openModal', { component: 'expenses.payment.edit-payment-modal', arguments: { payment: {{ $payment }} }})">
                                    <x-heroicon-o-pencil-square class="size-5"/>
                                    <span>Edit</span>
                                </x-tables.action-modal-button>

                                <x-tables.action-modal-button
                                    onclick="Livewire.dispatch('openModal', { component: 'expenses.payment.delete-payment-modal', arguments: { payment: {{ $payment }} }})">
                                    <x-heroicon-o-trash class="size-5"/>
                                    <span>Delete</span>
                                </x-tables.action-modal-button>
                            </x-tables.actions-container>
                        </x-tables.data-cell>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-tables.table-template>
    @else
        imat snemeno
    @endif

    <x-tables.pagination>
        {{ $payments->links()}}
    </x-tables.pagination>
</div>
