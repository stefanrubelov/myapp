<?php

namespace App\Traits\Filters;

trait PaymentNumberFilter
{
    public string $paymentNumber = '';

    public function updatingPaymentNumber(): void
    {
        $this->resetPage();
    }
}
