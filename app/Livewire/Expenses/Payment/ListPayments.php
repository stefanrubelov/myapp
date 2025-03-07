<?php

namespace App\Livewire\Expenses\Payment;

use App\Models\Payment;
use App\Traits\Filters\DiscountedOnlyFilter;
use App\Traits\Filters\MerchantNameFilter;
use App\Traits\Filters\PaymentDateFilter;
use App\Traits\Filters\PaymentMethodFilter;
use App\Traits\Filters\PaymentNumberFilter;
use App\Traits\Filters\PaymentPriceFilter;
use App\Traits\Filters\PerPageFilter;
use App\Traits\Filters\ProductNameFilter;
use App\Traits\Filters\SortByFilter;
use App\Traits\Filters\TransactionTypeFilter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ListPayments extends Component
{
    use WithPagination,
        PerPageFilter,
        ProductNameFilter,
        PaymentPriceFilter,
        MerchantNameFilter,
        TransactionTypeFilter,
        PaymentMethodFilter,
        PaymentDateFilter,
        DiscountedOnlyFilter,
        PaymentNumberFilter,
        SortByFilter;

    protected $listeners = [
        'refreshPaymentsTable' => '$refresh'
    ];

    #[Title('Payments')]
    public function render(): View|\Illuminate\Contracts\View\View|Factory|Application
    {

        return view('livewire.expenses.payment.list-payments',
            [
                'payments' => $this->getPayments()
            ]
        )->layout('layouts.expenses');
    }

    private function getPayments(): LengthAwarePaginator
    {
        return Payment::with('product', 'merchant', 'transactionType', 'paymentMethod')
            ->when(strlen($this->paymentNumber) > 3, function ($query) {
                return $query->where('payment_number', 'like', $this->paymentNumber . '%');
            })
            ->when(strlen($this->productName) > 2, function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('name', 'like', '%' . $this->productName . '%');
                });
            })
            ->when(strlen($this->merchantName) > 2, function ($query) {
                $query->whereHas('merchant', function ($query) {
                    $query->where('name', 'like', '%' . $this->merchantName . '%');
                });
            })
            ->when($this->minPrice >= 0 && $this->maxPrice > $this->minPrice, function ($query) {
                $query->whereBetween('price', [$this->minPrice * 100, $this->maxPrice * 100]);
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
            ->when($this->sortField === 'merchants.name', function ($query) {
                $query->join('merchants', 'payments.merchant_id', '=', 'merchants.id')
                    ->orderBy('merchants.name', $this->sortDirection)
                    ->select('payments.*');
            })
            ->when(!in_array($this->sortField, ['products.name', 'merchants.name']), function ($query) {
                $query->orderBy($this->sortField ?: 'payments.payment_number', $this->sortDirection ?: 'desc');
            })
            ->when($this->paymentDateFrom != "", function ($query) {
                $query->where('payments.payment_date', '>=', $this->paymentDateFrom);
            })
            ->when($this->paymentDateTo != "", function ($query) {
                $query->where('payments.payment_date', '<=', $this->paymentDateTo);
            })
            ->orderBy('payments.payment_number', 'desc')
            ->paginate($this->perPage);
    }
}
