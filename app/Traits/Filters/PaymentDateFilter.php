<?php

namespace App\Traits\Filters;

trait PaymentDateFilter
{
    public $paymentDateFrom = "";
    public $paymentDateTo = "";

    public function updatingPaymentDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatingPaymentDateTo(): void
    {
        $this->resetPage();
    }
}
