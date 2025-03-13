<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

trait PaymentDateFilter
{
    public $paymentDateFrom = '';

    public $paymentDateTo = '';

    public function updatingPaymentDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatingPaymentDateTo(): void
    {
        $this->resetPage();
    }
}
