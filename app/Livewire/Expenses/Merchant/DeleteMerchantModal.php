<?php

namespace App\Livewire\Expenses\Merchant;

use App\Models\Merchant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class DeleteMerchantModal extends ModalComponent
{
    public $merchant;

    public function render(): View|Factory|Application|\Illuminate\View\View
    {
        return view('livewire.expenses.merchant.delete-merchant-modal');
    }

    public function delete(): void
    {
        Merchant::where("id", $this->merchant['id'])->delete();
        $this->dispatch('refreshMerchantsTable');
        $this->forceClose()->closeModal();
    }
}
