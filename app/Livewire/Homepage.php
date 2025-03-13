<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        return view('livewire.homepage')->layout('layouts.app');
    }
}
