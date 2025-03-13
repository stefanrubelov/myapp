<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Merchant;

use App\Domains\Expenses\Merchant\Models\Merchant;
use App\Domains\Expenses\Payment\Services\PaymentService;
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

class ViewMerchant extends Component
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

    public Merchant $merchant;

    private PaymentService $paymentService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    public function mount(): void
    {
        $this->sortOptions = [
            'payment_number' => 'Payment Number',
            'products.name' => 'Product Name',
            'transaction_type_id' => 'Transaction Type',
            'payment_method_id' => 'Payment Method',
            'payment_date' => 'Payment Date',
        ];
    }

    public function render(): Factory|View|Application|\Illuminate\View\View
    {
        $payments = $this->paymentService->getPayments($this->filters(), $this->perPage);

        $categories = [$this->merchant->category->getCategoryHierarchyTree()];

        return view('livewire.domains.expenses.merchant.view-merchant', compact('payments', 'categories'))->layout('layouts.expenses');
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
            'merchant_id' => $this->merchant->id,
        ];
    }
}
