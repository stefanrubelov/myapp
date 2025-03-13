<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\TransactionType;

use Livewire\Component;

class CreateTransactionType extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.transaction-type.create-transaction-type')->layout('layouts.expenses');
    }
}
