<?php

namespace App\Livewire\Expenses\Product;

use App\Livewire\Infolists\ProductInfoList;
use App\Models\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ViewProductModal extends ModalComponent implements HasForms, HasInfolists
{
    use InteractsWithInfolists,
        InteractsWithForms;

    public int $productId;
    public Product $product;

    public function mount(): void
    {
        $this->product = Product::find($this->productId);
    }

    public function infoList(InfoList $infoList): Infolist
    {
        return $infoList
            ->schema(fn() => ProductInfoList::schema())
            ->record($this->product)
            ->columns(2);
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.expenses.product.view-product-modal');
    }
}
