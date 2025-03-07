<?php

namespace App\Livewire\Expenses\TransactionType;

use Livewire\Component;

class EditTransactionType extends Component
{
    public function render()
    {
        return view('livewire.expenses.transaction-type.edit-transaction-type')->layout('layouts.expenses');
    }
}
