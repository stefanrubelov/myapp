<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\CategoryType;

use Livewire\Component;

class ListCategoryTypes extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.category-type.list-category-types')->layout('layouts.expenses');
    }
}
