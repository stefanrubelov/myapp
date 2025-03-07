<?php

namespace App\Livewire\Expenses\Merchant;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class EditMerchantModal extends ModalComponent
{
    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.expenses.merchant.edit-merchant-modal');
    }
}
