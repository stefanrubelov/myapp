<div>
    <div>
        <div class="mt-4">
            <span class="text-4xl text-gray-600">{{ $product->name }}</span>
        </div>
        <div class="mb-2">
            @livewire('components.category-hierarchy', ['category' => $product->category])
        </div>
        <div class="flex flex-row w-full" w>
            <div class="w-full" wire:ignore>
                @livewire('domains.expenses.product.product-chart', ['product' => $product])
            </div>

            <div class="space-y-2 mt-8">
                @if($highestPayment)
                    <x-widgets.number class="!bg-red-100">
                        <x-slot:number class="!text-red-500">
                            {{ $highestPayment->price }}
                        </x-slot:number>
                        <x-slot:title class="!text-red-500 flex flex-col">
                            <span>Highest price</span>
                            <span>{{ $highestPayment->merchant->name }}</span>
                            <span>{{ \Carbon\Carbon::parse($highestPayment->payment_date)->format('Y-m-d') }}</span>
                        </x-slot:title>
                    </x-widgets.number>
                @endif
                @if($lowestPayment)
                    <x-widgets.number>
                        <x-slot:number>
                            {{ $lowestPayment->price }}
                        </x-slot:number>
                        <x-slot:title class="flex flex-col">
                            <span>Lowest price</span>
                            <span>{{ $lowestPayment->merchant->name }}</span>
                            <span>{{ \Carbon\Carbon::parse($lowestPayment->payment_date)->format('Y-m-d') }}</span>
                        </x-slot:title>
                    </x-widgets.number>
                @endif

                @if($latestPayment)
                    <x-widgets.number class="!bg-sky-100">
                        <x-slot:number class="!text-sky-500">
                            {{ $latestPayment->price }}
                        </x-slot:number>
                        <x-slot:title class="!text-sky-500 flex flex-col">
                            <span>Latest payment</span>
                            <span>{{ $latestPayment->merchant->name }}</span>
                            <span>{{ \Carbon\Carbon::parse($latestPayment->payment_date)->format('Y-m-d') }}</span>
                        </x-slot:title>
                    </x-widgets.number>
                @endif
            </div>
        </div>

        <hr class="my-12 h-0.5 border-t-0 bg-neutral-100 dark:bg-white/10"/>

        <div>
            <div class="w-full flex flex-row items-end justify-between mb-2">
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-span-2">
                        <x-inputs.text model="paymentNumber" title="Payment number" placeholder="Payment number"/>
                    </div>

                    <div class="col-span-1">
                        <x-inputs.number-input class="py-2.5" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                               model="minPrice"
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
                    <x-filters.sort-by :sortOptions="$sortOptions" :sortField="$sortField"
                                       :sortDirection="$sortDirection"/>
                </div>
            </div>
            <div>
                <div class="rounded-lg border border-gray-200 mt-4">
                    <div class="rounded-t-lg">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                            <tr class="bg-gray-50">
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">#</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">Price</th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">Merchant
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
                                    Transaction
                                    Type
                                </th>
                                <th class="hidden md:table-cell whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
                                    Payment Method
                                </th>
                                <th class="hidden md:table-cell whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
                                    Discounted
                                </th>
                                <th class="hidden md:table-cell whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
                                    Date
                                </th>
                                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">Actions
                                </th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                            @foreach($payments as $payment)
                                <tr class="@if($loop->iteration % 2 == 0) bg-gray-50 @endif">
                                    <td class="text-center whitespace-nowrap px-4 py-2 text-gray-900">{{ $payment->payment_number }}</td>
                                    <td class="text-right whitespace-nowrap px-4 py-2 text-gray-700">{{ $payment->price }}</td>
                                    <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{ $payment->merchant->name }}</td>
                                    <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">
                                            <span
                                                class="inline-flex items-center justify-center">
                                                @if($payment->transactionType->slug == \App\Domains\Expenses\TransactionType\Enums\TransactionTypeEnum::INCOMING->value)
                                                    <x-badges.teal-700>
                                                        Incoming
                                                    </x-badges.teal-700>
                                                @else
                                                    <x-badges.red-800>
                                                        Outgoing
                                                    </x-badges.red-800>
                                                @endif
                                            </span>
                                    </td>
                                    <td class="hidden md:table-cell text-center whitespace-nowrap px-4 py-2 text-gray-700">
                                        @switch($payment->paymentMethod->slug)
                                            @case(\App\Domains\Expenses\PaymentMethod\Enums\PaymentMethodEnum::CARD->value)
                                                <x-badges.violet-800>
                                                    Card
                                                </x-badges.violet-800>
                                                @break
                                            @case(\App\Domains\Expenses\PaymentMethod\Enums\PaymentMethodEnum::CASH->value)
                                                <x-badges.green>
                                                    Cash
                                                </x-badges.green>
                                                @break
                                            @case(Str::slug(\App\Domains\Expenses\PaymentMethod\Enums\PaymentMethodEnum::BANK_TRANSFER->value, '-'))
                                                <x-badges.gray>
                                                    Bank
                                                </x-badges.gray>
                                                @break
                                            @case(Str::slug(\App\Domains\Expenses\PaymentMethod\Enums\PaymentMethodEnum::MOBILE_PAY->value))
                                                <x-badges.slate-900>
                                                    Mobile pay
                                                </x-badges.slate-900>
                                        @endswitch
                                    </td>
                                    <td class="hidden md:table-cell text-center whitespace-nowrap px-4 py-2 text-gray-700">
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
                                    </td>
                                    <td class="hidden md:table-cell text-center whitespace-nowrap px-4 py-2 text-gray-700">{{ $payment->payment_date }}</td>
                                    <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700 relative">
                                        <div x-data="{ open: false }" class="relative">
                                            <button
                                                @click="open = !open"
                                                class="inline-flex items-center rounded-lg border bg-white h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700">
                                                <span class="">Menu</span>
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="size-4"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                            <div
                                                x-cloak
                                                x-show="open"
                                                @click.outside="open = false"
                                                x-transition
                                                class="absolute end-0 z-[9999] mt-0.5 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-2xl"
                                                role="menu">
                                                <div class="divide-y divide-gray-100 p-2 z-50">
                                                    <div class="">
                                                        <button type="button"
                                                                onclick="Livewire.dispatch('openModal', { component: 'domains.expenses.payment.view-payment-modal', arguments: { payment: {{ $payment }} }})"
                                                                class="flex w-full space-x-1 flex-row items-center justify-center rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                                                role="menuitem">
                                                            <x-icons.view fill="#6b7280"/>
                                                            <span>View</span>
                                                        </button>
                                                        <button type="button"
                                                                onclick="Livewire.dispatch('openModal', { component: 'domains.expenses.payment.edit-payment-modal', arguments: { payment: {{ $payment }} }})"
                                                                class="flex w-full space-x-1 flex-row items-center justify-center rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                                                role="menuitem">
                                                            <x-icons.edit fill="#6b7280"/>
                                                            <span>Edit</span>
                                                        </button>
                                                    </div>
                                                    <div class="p2">
                                                        <button
                                                            type="button"
                                                            onclick="Livewire.dispatch('openModal', { component: 'domains.expenses.payment.delete-payment-modal', arguments: { payment: {{ $payment }} }})"
                                                            class="flex w-full space-x-1 flex-row items-center justify-center rounded-lg px-4 py-2 text-sm text-red-500 hover:bg-gray-50 hover:text-red-700"
                                                            role="menuitem"
                                                        >
                                                            <x-icons.trashcan class="text-red-500" fill="#ef4444"/>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($payments) > $perPage)
                        <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
                            {{ $payments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
