<?php

namespace App\Livewire\Expenses\Product;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form as FilamentForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class CreateProductModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(FilamentForm $form): FilamentForm
    {
        return $form->schema(fn() => ProductForm::schema())
            ->model(Product::class)
            ->statePath('formData');
    }

    public function save(): void
    {
        if(Product::create($this->form->getState())){
            $this->dispatch('refreshProductsTable');
            $this->forceClose()->closeModal();
        }
    }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.expenses.product.create-product-modal');
    }
}
