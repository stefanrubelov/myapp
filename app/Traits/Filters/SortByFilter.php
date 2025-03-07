<?php

namespace App\Traits\Filters;

trait SortByFilter
{
    public string $sortField = 'payment_number';
    public string $sortDirection = 'desc';

    public array $sortOptions = [
        'payment_number' => 'Payment Number',
        'products.name' => 'Product Name',
        'merchants.name' => 'Merchant Name',
        'transaction_type_id' => 'Transaction Type',
        'payment_method_id' => 'Payment Method',
        'payment_date' => 'Payment Date',
    ];

    public function sort($field): void
    {
        if (array_key_exists($field, $this->sortOptions)) {
            if ($this->sortField === $field) {
                $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                $this->sortField = $field;
                $this->sortDirection = 'asc';
            }
            $this->dispatch('sort-changed');
        }
    }
}
