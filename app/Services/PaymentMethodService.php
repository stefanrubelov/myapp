<?php

namespace App\Services;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

class PaymentMethodService
{
    public function getAllGroupedByName(): Collection
    {
        return PaymentMethod::all();
    }
}
