<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Header extends Component
{
    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.components.header');
    }
}
