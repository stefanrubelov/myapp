<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\PaymentMethod\CreatePaymentMethod;
use App\Livewire\Domains\Expenses\PaymentMethod\EditPaymentMethod;
use App\Livewire\Domains\Expenses\PaymentMethod\ListPaymentMethods;
use Illuminate\Support\Facades\Route;

Route::get('/', ListPaymentMethods::class)
    ->name('paymentMethods');

Route::get('/create', CreatePaymentMethod::class)
    ->name('paymentMethods.create');

Route::get('/{paymentMethod}/edit', EditPaymentMethod::class)
    ->name('paymentMethods.edit');
