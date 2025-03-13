<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Merchant;

use Livewire\Component;

class EditMerchant extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.merchant.edit-merchant')->layout('layouts.expenses');
    }
}
