<?php

namespace App\Livewire\Expenses\PaymentMethod;

use Livewire\Component;

class ListPaymentMethods extends Component
{
    public function render()
    {
        return view('livewire.expenses.payment-method.list-payment-methods')->layout('layouts.expenses');
    }
}
