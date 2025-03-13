<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

trait PaymentNumberFilter
{
    public string $paymentNumber = '';

    public function updatingPaymentNumber(): void
    {
        $this->resetPage();
    }
}
