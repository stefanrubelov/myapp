<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\Category\CreateCategory;
use App\Livewire\Domains\Expenses\Category\EditCategory;
use App\Livewire\Domains\Expenses\Category\ListCategories;
use App\Livewire\Domains\Expenses\Category\ViewCategory;

Route::get('/', ListCategories::class)
    ->name('categories');

Route::get('/{category}', ViewCategory::class)
    ->name('category.view');

Route::get('/create', CreateCategory::class)
    ->name('categories.create');

Route::get('/{category}/edit', EditCategory::class)
    ->name('categories.edit');
