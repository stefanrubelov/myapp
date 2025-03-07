<?php

namespace App\Traits\Filters;

use App\Models\TransactionType;
use Illuminate\Support\Collection;

trait TransactionTypeFilter
{
    public Collection $transactionTypes;
    public array $selectedTransactionTypes = [];

    public function mountTransactionTypeFilter(): void
    {
        $this->transactionTypes = TransactionType::all();
        $this->selectedTransactionTypes = $this->transactionTypes->pluck('id')->mapWithKeys(fn($id) => [$id => true])->toArray();
    }
}
