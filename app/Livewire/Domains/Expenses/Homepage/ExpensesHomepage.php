<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Homepage;

use Livewire\Component;

class ExpensesHomepage extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.homepage.expenses-homepage')->layout('layouts.expenses');
    }
}
