<?php

namespace App\Livewire\Expenses\Category;

use App\Models\Category;
use Livewire\Component;

class ViewCategory extends Component
{
    public Category $category;

    public function render()
    {
        return view('livewire.expenses.category.view-category')->layout('layouts.expenses');
    }
}
