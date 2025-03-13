<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\PaymentMethod;

use Livewire\Component;

class CreatePaymentMethod extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.payment-method.create-payment-method')->layout('layouts.expenses');
    }
}
