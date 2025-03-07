<?php

namespace App\Livewire\Expenses\PaymentMethod;

use Livewire\Component;

class CreatePaymentMethod extends Component
{
    public function render()
    {
        return view('livewire.expenses.payment-method.create-payment-method')->layout('layouts.expenses');
    }
}
