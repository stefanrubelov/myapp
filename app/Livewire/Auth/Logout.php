<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): RedirectResponse
    {
        if (Auth::check()) {

            Auth::guard('web')->logout();

            Session::invalidate();
            Session::regenerateToken();

        }

        return redirect()->route('home');
    }
}
