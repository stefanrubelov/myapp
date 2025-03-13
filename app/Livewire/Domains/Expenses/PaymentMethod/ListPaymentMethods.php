<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\PaymentMethod;

use Livewire\Component;

class ListPaymentMethods extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.payment-method.list-payment-methods')->layout('layouts.expenses');
    }
}
