<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Category;

use Livewire\Component;

class ListCategories extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.category.list-categories')->layout('layouts.expenses');
    }
}
