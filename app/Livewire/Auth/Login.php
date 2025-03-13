<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Domains\Auth\Forms\LoginForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        return view('livewire.auth.login')->layout('layouts.guest');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}
