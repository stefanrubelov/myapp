<?php

namespace App\Livewire\Expenses\CategoryType;

use Livewire\Component;

class ListCategoryTypes extends Component
{
    public function render()
    {
        return view('livewire.expenses.category-type.list-category-types')->layout('layouts.expenses');
    }
}
