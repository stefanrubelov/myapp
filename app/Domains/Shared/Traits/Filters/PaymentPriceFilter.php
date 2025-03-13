<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

use Livewire\Attributes\Url;

trait PaymentPriceFilter
{
    #[Url('minPrice')]
    public int $minPrice = 0;

    #[Url('maxPrice')]
    public int $maxPrice = 10000;

    public function updatingMaxPrice(): void
    {
        $this->resetPage();
    }

    public function updatingMinPrice(): void
    {
        $this->resetPage();
    }

    public function updatedMinPrice($value): void
    {
        $this->minPrice = $value === null || '' ? 0 : $value;
    }

    public function updatedMaxPrice($value): void
    {
        $this->maxPrice = $value === null || '' ? 10000 : $value;
    }
}
