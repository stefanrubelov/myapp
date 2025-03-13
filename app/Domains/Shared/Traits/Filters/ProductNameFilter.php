<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

trait ProductNameFilter
{
    public string $productName = '';

    public function updatingProductName(): void
    {
        $this->resetPage();
    }
}
