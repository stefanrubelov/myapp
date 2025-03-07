<?php

namespace App\Livewire\Expenses\TransactionType;

use Livewire\Component;

class CreateTransactionType extends Component
{
    public function render()
    {
        return view('livewire.expenses.transaction-type.create-transaction-type')->layout('layouts.expenses');
    }
}
