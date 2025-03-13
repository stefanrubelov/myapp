<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Payment;

use Livewire\Component;

class PaymentReports extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.payment.payment-reports')->layout('layouts.expenses');
    }
}
