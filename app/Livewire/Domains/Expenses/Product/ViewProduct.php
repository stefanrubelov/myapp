<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Product;

use App\Domains\Expenses\Payment\Services\PaymentService;
use App\Domains\Expenses\Product\Models\Product;
use App\Domains\Shared\Traits\Filters\DiscountedOnlyFilter;
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
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ViewProduct extends Component
{
    use DiscountedOnlyFilter,
        PaymentDateFilter,
        PaymentMethodFilter,
        PaymentNumberFilter,
        PaymentPriceFilter,
        PerPageFilter,
        ProductNameFilter,
        SortByFilter,
        TransactionTypeFilter,
        WithPagination;

    public Product $product;

    private PaymentService $paymentService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    public function render(): Factory|View|Application|\Illuminate\View\View
    {
        $payments = $this->paymentService->getOutgoingPaymentsByProductId($this->product->id);

        $highestPayment = $payments->sortByDesc('price')->first();
        $lowestPayment = $payments->sortByDesc('price')->last();
        $latestPayment = $payments->sortByDesc('payment_date')->first();

        return view('livewire.domains.expenses.product.view-product', [
            'payments' => $this->paymentService->getPayments($this->filters(), $this->perPage),
            'highestPayment' => $highestPayment,
            'lowestPayment' => $lowestPayment,
            'latestPayment' => $latestPayment,
        ])->layout('layouts.expenses');
    }

    private function filters(): array
    {
        return [
            'payment_number' => $this->paymentNumber,
            'product_name' => $this->productName,
            'min_price' => $this->minPrice,
            'max_price' => $this->maxPrice,
            'selected_transaction_types' => $this->selectedTransactionTypes,
            'selected_payment_methods' => $this->selectedPaymentMethods,
            'discounted_only' => $this->discountedOnly,
            'sort_field' => $this->sortField,
            'sort_direction' => $this->sortDirection,
            'payment_date_from' => $this->paymentDateFrom,
            'payment_date_to' => $this->paymentDateTo,
            'product_id' => $this->product->id,
        ];
    }
}
