<?php

namespace App\Traits\Filters;

use App\Models\PaymentMethod;
use Illuminate\Support\Collection;

trait PaymentMethodFilter
{
    public Collection $paymentMethods;

    public array $selectedPaymentMethods = [];

    public function mountPaymentMethodFilter(): void
    {
        $this->paymentMethods = PaymentMethod::all();

        $this->selectedPaymentMethods = $this->paymentMethods
            ->pluck('id')
            ->mapWithKeys(fn($id) => [$id => true])
            ->toArray();
    }

    public function updatingSelectedPaymentMethods(): void
    {
        $this->resetPage();
    }
}
