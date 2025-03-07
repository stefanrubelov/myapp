<?php

namespace App\Livewire\Expenses\Product;

use Livewire\Component;

class CreateProduct extends Component
{
    public function render()
    {
        return view('livewire.expenses.product.create-product')->layout('layouts.expenses');
    }
}
