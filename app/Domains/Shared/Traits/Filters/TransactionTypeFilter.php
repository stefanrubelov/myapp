<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

use App\Domains\Expenses\TransactionType\Models\TransactionType;
use Illuminate\Support\Collection;

trait TransactionTypeFilter
{
    public Collection $transactionTypes;

    public array $selectedTransactionTypes = [];

    public function mountTransactionTypeFilter(): void
    {
        $this->transactionTypes = TransactionType::all();
        $this->selectedTransactionTypes = $this->transactionTypes->pluck('id')->mapWithKeys(fn ($id) => [$id => true])->toArray();
    }
}
