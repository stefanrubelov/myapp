<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getAllGroupedByName(): Collection
    {
       return Product::orderBy('name')
            ->get()
            ->groupBy(function($product) {
                return strtoupper(substr($product->name, 0, 1));
            })
            ->map(function($items) {
                return $items->values();
            });
    }
}
