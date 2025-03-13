<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Product;

use App\Domains\Expenses\Product\Forms\ProductForm;
use App\Domains\Expenses\Product\Models\Product;
use App\Domains\Expenses\Product\Services\ProductService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form as FilamentForm;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class CreateProductModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    private ProductService $productService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->productService = app()->make(ProductService::class);
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(FilamentForm $form): FilamentForm
    {
        return $form->schema(fn () => ProductForm::schema())
            ->model(Product::class)
            ->statePath('formData');
    }

    public function save(): void
    {
        if ($this->productService->saveProduct($this->form->getState())) {
            $this->dispatch('refreshProductsTable');
            $this->forceClose()->closeModal();
        }
    }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.domains.expenses.product.create-product-modal');
    }
}
