<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Profile extends Component
{
    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        return view('livewire.profile.profile')->layout('layouts.app');
    }
}
