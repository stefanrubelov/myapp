<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\TransactionType;

use Livewire\Component;

class EditTransactionType extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.transaction-type.edit-transaction-type')->layout('layouts.expenses');
    }
}
