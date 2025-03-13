<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Product;

use App\Domains\Expenses\Product\Models\Product;
use LivewireUI\Modal\ModalComponent;

class DeleteProductModal extends ModalComponent
{
    public $product;

    public function render()
    {
        return view('livewire.domains.expenses.product.delete-product-modal');
    }

    public function delete(): void
    {
        Product::destroy($this->product['id']);
        $this->dispatch('refreshProductsTable');
        $this->forceClose()->closeModal();
    }
}
