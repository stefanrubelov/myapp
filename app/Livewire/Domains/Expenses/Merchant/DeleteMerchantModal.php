<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Merchant;

use App\Domains\Expenses\Merchant\Models\Merchant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class DeleteMerchantModal extends ModalComponent
{
    public $merchant;

    public function render(): View|Factory|Application|\Illuminate\View\View
    {
        return view('livewire.domains.expenses.merchant.delete-merchant-modal');
    }

    public function delete(): void
    {
        // TODO handle delete constraint in payments table
        Merchant::where('id', $this->merchant['id'])->delete();
        $this->dispatch('refreshMerchantsTable');
        $this->forceClose()->closeModal();
    }
}
