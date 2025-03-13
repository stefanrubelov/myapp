<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\CategoryType\CreateCategoryType;
use App\Livewire\Domains\Expenses\CategoryType\ListCategoryTypes;
use Illuminate\Support\Facades\Route;

Route::get('/', ListCategoryTypes::class)
    ->name('categories.types');

Route::get('/create', CreateCategoryType::class)
    ->name('categories.types.create');

Route::get('/{category}/edit', CreateCategoryType::class)
    ->name('categories.types.edit');
