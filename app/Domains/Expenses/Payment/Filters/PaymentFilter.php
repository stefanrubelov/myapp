<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Payment\Filters;

use App\Domains\Shared\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class PaymentFilter implements FilterInterface
{
    private array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function apply(Builder $query): void
    {
        $query->when(strlen($this->filters['payment_number'] ?? '') > 3, function ($query) {
            return $query->where('payment_number', 'like', $this->filters['payment_number'].'%');
        });

        $query->when(strlen($this->filters['product_name'] ?? '') > 2, function ($query) {
            $query->whereHas('product', function ($query) {
                $query->where('name', 'like', '%'.$this->filters['product_name'].'%');
            });
        });

        $query->when(strlen($this->filters['merchant_name'] ?? '') > 2, function ($query) {
            $query->whereHas('merchant', function ($query) {
                $query->where('name', 'like', '%'.$this->filters['merchant_name'].'%');
            });
        });

        $query->when(
            isset($this->filters['min_price'], $this->filters['max_price']) &&
            $this->filters['min_price'] >= 0 &&
            $this->filters['max_price'] > $this->filters['min_price'],
            function ($query) {
                $query->whereBetween('price', [
                    $this->filters['min_price'] * 100,
                    $this->filters['max_price'] * 100,
                ]);
            }
        );

        $query->when(! empty($this->filters['selected_transaction_types']), function ($query) {
            $query->whereIn('transaction_type_id', array_keys(array_filter($this->filters['selected_transaction_types'])));
        });

        $query->when(
            ! empty($this->filters['selected_payment_methods']),
            function ($query) {
                $filteredMethods = array_filter(
                    $this->filters['selected_payment_methods'],
                    fn ($value) => is_numeric($value)
                );

                if (! empty($filteredMethods)) {
                    $query->whereIn('payment_method_id', $filteredMethods);
                }
            }
        );

        $query->when($this->filters['discounted_only'] ?? false, function ($query) {
            $query->where('discounted', 1);
        });

        if (! empty($this->filters['sort_field'])) {
            if ($this->filters['sort_field'] === 'products.name') {
                $query->leftJoin('products', 'payments.product_id', '=', 'products.id')
                    ->orderBy('products.name', $this->filters['sort_direction'] ?? 'asc')
                    ->select('payments.*');
            } elseif ($this->filters['sort_field'] === 'merchants.name') {
                $query->leftJoin('merchants', 'payments.merchant_id', '=', 'merchants.id')
                    ->orderBy('merchants.name', $this->filters['sort_direction'] ?? 'asc')
                    ->select('payments.*');
            } else {
                $query->orderBy($this->filters['sort_field'], $this->filters['sort_direction'] ?? 'desc');
            }
        } else {
            $query->orderBy('payments.payment_number', 'desc');
        }

        $query->when(! empty($this->filters['payment_date_from']), function ($query) {
            $query->where('payments.payment_date', '>=', $this->filters['payment_date_from']);
        });

        $query->when(! empty($this->filters['payment_date_to']), function ($query) {
            $query->where('payments.payment_date', '<=', $this->filters['payment_date_to']);
        });

        $query->when(! empty($this->filters['product_id']), function ($query) {
            return $query->where('product_id', '=', $this->filters['product_id']);
        });

        $query->when(! empty($this->filters['merchant_id']), function ($query) {
            return $query->where('merchant_id', '=', $this->filters['merchant_id']);
        });

        $query->distinct();
    }
}
