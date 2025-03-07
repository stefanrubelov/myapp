<?php

namespace App\Livewire\Expenses\Merchant;

use Livewire\Component;

class CreateMerchant extends Component
{
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('livewire.expenses.merchant.create-merchant')->layout('layouts.expenses');
    }
}
