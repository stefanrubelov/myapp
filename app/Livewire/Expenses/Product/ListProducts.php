<?php

namespace App\Livewire\Expenses\Product;

use App\Models\Product;
use App\Traits\Filters\PerPageFilter;
use App\Traits\Filters\SortByFilter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class ListProducts extends Component
{
    use PerPageFilter,
        SortByFilter,
        WithPagination;

    protected $listeners = ['refreshProductsTable' => '$refresh'];

    private function getProducts(): Product|LengthAwarePaginator|array
    {
        return Product::paginate($this->perPage);
    }

    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        $products = $this->getProducts();

        return view('livewire.expenses.product.list-products', compact('products'))->layout('layouts.expenses');
    }
}
