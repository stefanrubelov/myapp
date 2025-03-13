<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Payment;

use App\Domains\Expenses\Payment\Services\PaymentService;
use App\Domains\Shared\Traits\Filters\DiscountedOnlyFilter;
use App\Domains\Shared\Traits\Filters\MerchantNameFilter;
use App\Domains\Shared\Traits\Filters\PaymentDateFilter;
use App\Domains\Shared\Traits\Filters\PaymentMethodFilter;
use App\Domains\Shared\Traits\Filters\PaymentNumberFilter;
use App\Domains\Shared\Traits\Filters\PaymentPriceFilter;
use App\Domains\Shared\Traits\Filters\PerPageFilter;
use App\Domains\Shared\Traits\Filters\ProductNameFilter;
use App\Domains\Shared\Traits\Filters\SortByFilter;
use App\Domains\Shared\Traits\Filters\TransactionTypeFilter;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ListPayments extends Component
{
    use DiscountedOnlyFilter,
        MerchantNameFilter,
        PaymentDateFilter,
        PaymentMethodFilter,
        PaymentNumberFilter,
        PaymentPriceFilter,
        PerPageFilter,
        ProductNameFilter,
        SortByFilter,
        TransactionTypeFilter,
        WithPagination;

    protected $listeners = [
        'refreshPaymentsTable' => '$refresh',
    ];

    private PaymentService $paymentService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    private function filters(): array
    {
        return [
            'payment_number' => $this->paymentNumber,
            'product_name' => $this->productName,
            'merchant_name' => $this->merchantName,
            'min_price' => $this->minPrice,
            'max_price' => $this->maxPrice,
            'selected_transaction_types' => $this->selectedTransactionTypes,
            'selected_payment_methods' => $this->selectedPaymentMethods,
            'discounted_only' => $this->discountedOnly,
            'sort_field' => $this->sortField,
            'sort_direction' => $this->sortDirection,
            'payment_date_from' => $this->paymentDateFrom,
            'payment_date_to' => $this->paymentDateTo,
        ];
    }

    #[Title('Payments')]
    public function render(): View|\Illuminate\Contracts\View\View|Factory|Application
    {
        $payments = $this->paymentService->getPayments($this->filters(), $this->perPage);

        return view('livewire.domains.expenses.payment.list-payments',
            [
                'payments' => $payments,
            ]
        )->layout('layouts.expenses');
    }
}
