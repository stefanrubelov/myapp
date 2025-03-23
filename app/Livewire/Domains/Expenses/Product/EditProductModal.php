<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Product;

use App\Domains\Expenses\Product\Forms\ProductForm;
use App\Domains\Expenses\Product\Models\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form as FilamentForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

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
        return view('livewire.domains.expenses.product.edit-product-modal');
    }

    public function form(FilamentForm $form): FilamentForm
    {
        return $form->schema(fn () => ProductForm::schema())
            ->statePath('formData')
            ->model(Product::class);
    }

    public function update(): void
    {
        $data = $this->form->getState();

        if (Product::where('id', $this->product['id'])->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'category_id' => $data['category_id'],
        ])) {
            $this->dispatch('refreshProductsTable');
            $this->forceClose()->closeModal();
        }
    }
}
