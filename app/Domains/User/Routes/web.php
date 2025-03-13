<?php

declare(strict_types=1);

use App\Livewire\Profile\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/my-profile', Profile::class)
    ->name('profile');
