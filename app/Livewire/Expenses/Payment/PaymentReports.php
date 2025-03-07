<?php

namespace App\Livewire\Expenses\Payment;

use Livewire\Component;

class PaymentReports extends Component
{
    public function render()
    {
        return view('livewire.expenses.payment.payment-reports')->layout('layouts.expenses');
    }
}
