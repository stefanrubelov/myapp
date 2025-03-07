<?php

namespace App\Traits\Filters;

use Livewire\Attributes\Url;

trait PaymentPriceFilter
{
    /**
     * @var int
     */
    #[Url('minPrice')]
    public int $minPrice = 0;

    /**
     * @var int
     */
    #[Url('maxPrice')]
    public int $maxPrice = 10000;

    /**
     * @return void
     */
    public function updatingMaxPrice(): void
    {
        $this->resetPage();
    }

    /**
     * @return void
     */
    public function updatingMinPrice(): void
    {
        $this->resetPage();
    }

    /**
     * @param $value
     * @return void
     */
    public function updatedMinPrice($value): void
    {
        $this->minPrice = $value === null || '' ? 0 : $value;
    }

    /**
     * @param $value
     * @return void
     */
    public function updatedMaxPrice($value): void
    {
        $this->maxPrice = $value === null || '' ? 10000 : $value;
    }
}
