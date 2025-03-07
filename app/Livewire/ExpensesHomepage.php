<?php

namespace App\Livewire;

use Livewire\Component;

class ExpensesHomepage extends Component
{
    public function render()
    {
        return view('livewire.expenses-homepage')->layout('layouts.expenses');
    }
}
