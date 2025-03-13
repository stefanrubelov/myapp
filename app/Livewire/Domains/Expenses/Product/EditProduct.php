<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Product;

use Livewire\Component;

class EditProduct extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.product.edit-product')->layout('layouts.expenses');
    }
}
