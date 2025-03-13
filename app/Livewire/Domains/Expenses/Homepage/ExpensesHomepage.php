<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\General;

use Livewire\Component;

class ExpensesHomepage extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.expenses-homepage')->layout('layouts.expenses');
    }
}
