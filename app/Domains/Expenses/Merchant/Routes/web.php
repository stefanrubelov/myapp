<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\Merchant\CreateMerchant;
use App\Livewire\Domains\Expenses\Merchant\EditMerchant;
use App\Livewire\Domains\Expenses\Merchant\ListMerchants;
use App\Livewire\Domains\Expenses\Merchant\ViewMerchant;

Route::get('/', ListMerchants::class)
    ->name('merchants');

Route::get('/{merchant}/', ViewMerchant::class)
    ->name('merchant.view');

Route::get('/create', CreateMerchant::class)
    ->name('merchants.create');

Route::get('/{merchant}/edit', EditMerchant::class)
    ->name('merchants.edit');
