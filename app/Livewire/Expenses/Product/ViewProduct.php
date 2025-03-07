<?php

namespace App\Livewire\Expenses\Product;

use App\Enums\TransactionTypeEnum;
use App\Models\Payment;
use App\Models\Product;
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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ViewProduct extends Component
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

    public Product $product;

    public function render(): Factory|View|Application|\Illuminate\View\View
    {
        $payments = $this->getAllPayments();

        $highestPayment = $payments->sortByDesc('price')->first();
        $lowestPayment = $payments->sortByDesc('price')->last();
        $latestPayment = $payments->sortByDesc('payment_date')->first();

        return view('livewire.expenses.product.view-product', [
            'payments' => $this->getPaymentsQuery()->paginate($this->perPage),
            'highestPayment' => $highestPayment,
            'lowestPayment' => $lowestPayment,
            'latestPayment' => $latestPayment,
        ])->layout('layouts.expenses');
    }

    private function getPaymentsQuery()
    {
        return Payment::with('product', 'merchant', 'transactionType', 'paymentMethod')
            ->where('product_id', $this->product->id)
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
            ->when(!in_array($this->sortField, ['products.name', 'merchants.name']), function ($query) {
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

    private function getAllPayments(): Collection|Payment|array
    {
        return Payment::with('merchant')
            ->where('product_id', $this->product->id)
            ->whereRelation('transactionType', 'slug', '=', TransactionTypeEnum::OUTGOING->value)
            ->orderBy('payment_date')
            ->get();

    }
}
