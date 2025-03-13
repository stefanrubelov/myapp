<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Domains\Expenses\Category\Models\Category;
use Livewire\Component;

class CategoryHierarchy extends Component
{
    public Category $category;

    public function render()
    {
        $categories = $this->category->getCategoryHierarchy(true, false);

        return view('livewire.components.category-hierarchy', compact('categories'));
    }
}
