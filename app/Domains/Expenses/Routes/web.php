<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\Homepage\ExpensesHomepage;
use Illuminate\Support\Facades\Route;

Route::get('/', ExpensesHomepage::class)->name('expenses');

Route::prefix('payments')
    ->group(domain_path('Expenses/Payment/Routes/web.php'));

Route::prefix('products')
    ->group(domain_path('Expenses/Product/Routes/web.php'));

Route::prefix('merchants')
    ->group(domain_path('Expenses/Merchant/Routes/web.php'));

Route::prefix('categories')
    ->group(domain_path('Expenses/Category/Routes/web.php'));

Route::prefix('category-types')
    ->group(domain_path('Expenses/CategoryType/Routes/web.php'));

Route::prefix('transaction-types')
    ->group(domain_path('Expenses/TransactionType/Routes/web.php'));

Route::prefix('payment-methods')
    ->group(domain_path('Expenses/PaymentMethod/Routes/web.php'));
