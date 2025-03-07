<?php

namespace App\Traits\Filters;

trait DiscountedOnlyFilter
{
    public bool $discountedOnly = false;

    public function updatingDiscountedOnly(): void
    {
        $this->resetPage();
    }
}
