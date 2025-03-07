<?php

namespace App\Livewire\Expenses\Product;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;
use Filament\Forms\Form as FilamentForm;

class EditProductModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    public $product;

    public function mount($product): void
    {
        $this->product = $product;
        $this->form->fill($product);
    }

    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        return view('livewire.expenses.product.edit-product-modal');
    }

    public function form(FilamentForm $form): FilamentForm
    {
        return $form->schema(fn() => ProductForm::schema())
            ->statePath('formData');
    }

    public function update(): void
    {
        $data = $this->form->getState();

        if (Product::where("id", $this->product['id'])->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'category_id' => $data['category_id'],
        ])) {
            $this->dispatch('refreshProductsTable');
            $this->forceClose()->closeModal();
        }
    }
}
