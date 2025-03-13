<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\TransactionType;

use Livewire\Component;

class ListTransactionTypes extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.transaction-type.list-transaction-types')->layout('layouts.expenses');
    }
}
