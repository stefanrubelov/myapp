<?php

namespace App\Livewire\Expenses\Product;

use Livewire\Component;

class EditProduct extends Component
{

    public function render()
    {
        return view('livewire.expenses.product.edit-product')->layout('layouts.expenses');
    }
}
