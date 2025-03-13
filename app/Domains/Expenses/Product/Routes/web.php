<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\Product\CreateProduct;
use App\Livewire\Domains\Expenses\Product\EditProduct;
use App\Livewire\Domains\Expenses\Product\ListProducts;
use App\Livewire\Domains\Expenses\Product\ViewProduct;

Route::get('/', ListProducts::class)
    ->name('products');

Route::get('/{product}/', ViewProduct::class)
    ->name('product.view');

Route::get('/create', CreateProduct::class)
    ->name('products.create');

Route::get('/{product}/edit', EditProduct::class)
    ->name('products.edit');
