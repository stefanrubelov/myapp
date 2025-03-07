<?php

namespace App\Livewire\Expenses\PaymentMethod;

use Livewire\Component;

class EditPaymentMethod extends Component
{
    public function render()
    {
        return view('livewire.expenses.payment-method.edit-payment-method')->layout('layouts.expenses');
    }
}
