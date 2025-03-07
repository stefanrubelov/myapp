<?php

namespace App\Livewire\Expenses\Product;

use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class DeleteProductModal extends ModalComponent
{
    public $product;

    public function render()
    {
        return view('livewire.expenses.product.delete-product-modal');
    }

    public function delete(): void
    {
        Product::destroy($this->product['id']);
        $this->dispatch('refreshProductsTable');
        $this->forceClose()->closeModal();
    }
}
