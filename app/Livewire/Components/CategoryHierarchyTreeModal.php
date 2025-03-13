<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use LivewireUI\Modal\ModalComponent;

class CategoryHierarchyTreeModal extends ModalComponent
{
    public $categories;

    public $currentCategory;

    public function mount($categories, $currentCategory)
    {
        $this->categories = $categories;
        $this->currentCategory = $currentCategory;
    }

    public function renderTreeItem($categories = [], $hasParent = false)
    {
        if ($categories == []) {
            $categories = $this->categories;
        }
        $html = '';
        foreach ($categories as $index => $category) {
            $isLast = $index === array_key_last($categories);

            $html .= view('livewire.components.category-hierarchy-tree', [
                'category' => $category,
                'hasParent' => $hasParent,
                'isLast' => $isLast,
                'currentCategory' => $this->currentCategory,
            ])->render();
        }

        return $html;
    }

    public function render()
    {
        $categories = $this->categories;

        return view('livewire.components.category-hierarchy-tree-modal', [
            'renderTreeItem' => $this->renderTreeItem($categories, false),
        ]);
    }
}
