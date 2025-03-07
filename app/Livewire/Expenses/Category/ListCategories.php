<?php

namespace App\Livewire\Expenses\Category;

use Livewire\Component;

class ListCategories extends Component
{
    public function render()
    {
        return view('livewire.expenses.category.list-categories')->layout('layouts.expenses');
    }
}
