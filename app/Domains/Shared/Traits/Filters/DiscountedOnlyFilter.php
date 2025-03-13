<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

trait DiscountedOnlyFilter
{
    public bool $discountedOnly = false;

    public function updatingDiscountedOnly(): void
    {
        $this->resetPage();
    }
}
