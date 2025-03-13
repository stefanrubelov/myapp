<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

trait MerchantNameFilter
{
    public string $merchantName = '';

    public function updatingMerchantName(): void
    {
        $this->resetPage();
    }
}
