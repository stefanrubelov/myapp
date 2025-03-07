<?php

namespace App\Services;

use App\Models\Merchant;
use Illuminate\Support\Collection;

class MerchantService
{
    public function getAll(): Collection
    {
        return Merchant::all();
    }

    public function getAllGroupedByName(): Collection
    {
        return Merchant::orderBy('name')
            ->get()
            ->groupBy(function($product) {
                return strtoupper(substr($product->name, 0, 1));
            })
            ->map(function($items) {
                return $items->values();
            });
    }
}
