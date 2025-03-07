<?php

namespace App\Traits\Filters;

trait ProductNameFilter
{
    public string $productName = '';

    public function updatingProductName(): void
    {
        $this->resetPage();
    }
}
