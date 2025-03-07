<?php

namespace App\Livewire\Expenses\Merchant;

use Livewire\Component;

class EditMerchant extends Component
{
    public function render()
    {
        return view('livewire.expenses.merchant.edit-merchant')->layout('layouts.expenses');
    }
}
