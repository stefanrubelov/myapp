<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Merchant;

use Livewire\Component;

class CreateMerchant extends Component
{
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('livewire.domains.expenses.merchant.create-merchant')->layout('layouts.expenses');
    }
}
