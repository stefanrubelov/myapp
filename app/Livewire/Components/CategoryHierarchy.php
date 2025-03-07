<?php

namespace App\Livewire\Components;

use App\Models\Category;
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
