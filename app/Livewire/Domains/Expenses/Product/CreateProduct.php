<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Product;

use Livewire\Component;

class CreateProduct extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.product.create-product')->layout('layouts.expenses');
    }
}
