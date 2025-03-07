<?php

namespace App\Traits\Filters;

trait MerchantNameFilter
{
    public string $merchantName = '';

    public function updatingMerchantName(): void
    {
        $this->resetPage();
    }
}
