<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

use App\Domains\Expenses\PaymentMethod\Models\PaymentMethod;
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
            ->mapWithKeys(fn ($id) => [$id => true])
            ->toArray();
    }

    public function updatingSelectedPaymentMethods(): void
    {
        $this->resetPage();
    }
}
