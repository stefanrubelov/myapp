<x-wire-elements-modal>
    <x-slot:body>
        {{ $this->infoList }}
    </x-slot:body>
    <x-slot:footer>

    </x-slot:footer>
</x-wire-elements-modal>
{{--<div class="bg-white rounded-lg shadow-2xl w-full mx-auto border border-gray-100">--}}
{{--    <!-- Modal Header -->--}}
{{--    <div class="border-b px-6 py-4">--}}
{{--        <h3 class="text-lg">--}}
{{--            <span class="text-gray-700 font-italic">Payment Details</span> <span class="font-medium text-gray-900">#{{ $payment->payment_number }}</span>--}}
{{--        </h3>--}}
{{--    </div>--}}

{{--    <!-- Modal Content -->--}}
{{--    <div class="px-6 py-4 space-y-4">--}}
{{--        <!-- Price -->--}}
{{--        <div class="flex justify-between text-lg">--}}
{{--            <span class="font-medium text-gray-900">{{ $payment->product->name }}</span>--}}
{{--            <span class="font-medium">{{ number_format($payment->price, 2) }} dkk</span>--}}
{{--        </div>--}}

{{--        <!-- Product and Merchant -->--}}
{{--        <div class="grid grid-cols-2 gap-4">--}}
{{--            <div>--}}
{{--                <span class="text-gray-600 block">Merchant</span>--}}
{{--                <span class="font-medium">{{ $payment->merchant->name }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Transaction and Payment Method -->--}}
{{--        <div class="grid grid-cols-2 gap-4">--}}
{{--            <div>--}}
{{--                <span class="text-gray-600 block">Transaction Type</span>--}}
{{--                <span class="font-medium">{{ $payment->transactionType->name }}</span>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <span class="text-gray-600 block">Payment Method</span>--}}
{{--                <span class="font-medium">{{ $payment->paymentMethod->name }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Discount Status -->--}}
{{--        <div class="flex justify-between">--}}
{{--            <span class="text-gray-600">Discounted</span>--}}
{{--            <span class="font-medium">{{ $payment->discounted ? 'Yes' : 'No' }}</span>--}}
{{--        </div>--}}

{{--        <!-- Note -->--}}
{{--        @if($payment->note)--}}
{{--            <div>--}}
{{--                <span class="text-gray-600 block">Note</span>--}}
{{--                <p class="mt-1 text-gray-800">{{ $payment->note }}</p>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <!-- Timestamps -->--}}
{{--        <div class="text-sm text-gray-500 space-y-1">--}}
{{--            <div>Created: {{ \Carbon\Carbon::parse($payment->created_at)->format('M d, Y H:i') }}</div>--}}
{{--            <div>Updated: {{ \Carbon\Carbon::parse($payment->updated_at)->format('M d, Y H:i') }}</div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Modal Footer -->--}}
{{--    <div class="border-t px-6 py-4 flex justify-end">--}}
{{--        <button--}}
{{--            wire:click="$dispatch('closeModal')"--}}
{{--            class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg transition-colors"--}}
{{--        >--}}
{{--            Close--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}
