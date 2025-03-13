<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\TransactionType\CreateTransactionType;
use App\Livewire\Domains\Expenses\TransactionType\EditTransactionType;
use App\Livewire\Domains\Expenses\TransactionType\ListTransactionTypes;
use Illuminate\Support\Facades\Route;

Route::get('/', ListTransactionTypes::class)
    ->name('transactionTypes');

Route::get('/create', CreateTransactionType::class)
    ->name('transactionTypes.create');

Route::get('/{transactionType}/edit', EditTransactionType::class)
    ->name('transactionTypes.edit');
