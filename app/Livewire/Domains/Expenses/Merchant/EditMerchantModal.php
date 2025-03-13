<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Merchant;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class EditMerchantModal extends ModalComponent
{
    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.domains.expenses.merchant.edit-merchant-modal');
    }
}
