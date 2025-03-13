<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\Payment\ListPayments;
use App\Livewire\Domains\Expenses\Payment\PaymentReports;
use Illuminate\Support\Facades\Route;

Route::get('/', ListPayments::class)
    ->name('payments');

Route::get('/reports', PaymentReports::class)
    ->name('payments.reports');
