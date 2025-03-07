<?php

namespace App\Livewire\Expenses\Merchant;

use App\Models\Merchant;
use App\Models\Payment;
use App\Traits\Filters\DiscountedOnlyFilter;
use App\Traits\Filters\PaymentDateFilter;
use App\Traits\Filters\PaymentMethodFilter;
use App\Traits\Filters\PaymentNumberFilter;
use App\Traits\Filters\PaymentPriceFilter;
use App\Traits\Filters\PerPageFilter;
use App\Traits\Filters\ProductNameFilter;
use App\Traits\Filters\SortByFilter;
use App\Traits\Filters\TransactionTypeFilter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ViewMerchant extends Component
{
    use WithPagination,
        PerPageFilter,
        ProductNameFilter,
        PaymentPriceFilter,
        TransactionTypeFilter,
        PaymentMethodFilter,
        PaymentDateFilter,
        DiscountedOnlyFilter,
        PaymentNumberFilter,
        SortByFilter;

    public Merchant $merchant;

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
        $payments = $this->paymentsQuery()->paginate($this->perPage);
        $categories = [$this->merchant->category->getCategoryHierarchyTree()];

        return view('livewire.expenses.merchant.view-merchant', compact('payments', 'categories'))->layout('layouts.expenses');
    }

    private function paymentsQuery()
    {
        return Payment::with('product', 'merchant', 'transactionType', 'paymentMethod')
            ->where('merchant_id', $this->merchant->id)
            ->when(strlen($this->paymentNumber) > 3, function ($query) {
                return $query->where('payment_number', 'like', $this->paymentNumber . '%');
            })
            ->when($this->minPrice >= 0 && $this->maxPrice > $this->minPrice, function ($query) {
                $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
            })
            ->whereIn('transaction_type_id', collect($this->selectedTransactionTypes)->filter()->keys())
            ->whereIn('payment_method_id', collect($this->selectedPaymentMethods)->filter()->keys())
            ->when($this->discountedOnly, function ($query) {
                $query->where('discounted', 1);
            })
            ->when($this->sortField === 'products.name', function ($query) {
                $query->join('products', 'payments.product_id', '=', 'products.id')
                    ->orderBy('products.name', $this->sortDirection)
                    ->select('payments.*');
            })
            ->when(!in_array($this->sortField, ['products.name']), function ($query) {
                $query->orderBy($this->sortField ?: 'payments.payment_number', $this->sortDirection ?: 'desc');
            })
            ->when($this->paymentDateFrom != "", function ($query) {
                $query->where('payments.payment_date', '>=', $this->paymentDateFrom);
            })
            ->when($this->paymentDateTo != "", function ($query) {
                $query->where('payments.payment_date', '<=', $this->paymentDateTo);
            })
            ->orderBy('payment_date');
    }
}
