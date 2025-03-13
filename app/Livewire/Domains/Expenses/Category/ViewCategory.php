<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Category;

use App\Domains\Expenses\Category\Models\Category;
use Livewire\Component;

class ViewCategory extends Component
{
    public Category $category;

    public function render()
    {
        return view('livewire.domains.expenses.category.view-category')->layout('layouts.expenses');
    }
}
