<?php

namespace App\Livewire\Expenses\TransactionType;

use Livewire\Component;

class ListTransactionTypes extends Component
{
    public function render()
    {
        return view('livewire.expenses.transaction-type.list-transaction-types')->layout('layouts.expenses');
    }
}
