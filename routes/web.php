<?php

declare(strict_types=1);

use App\Livewire\Domains\Expenses\CategoryType\CreateCategoryType;
use App\Livewire\Domains\Expenses\CategoryType\ListCategoryTypes;
use App\Livewire\Domains\Expenses\Payment\ListPayments;
use App\Livewire\Domains\Expenses\Payment\PaymentReports;
use App\Livewire\Domains\Expenses\PaymentMethod\CreatePaymentMethod;
use App\Livewire\Domains\Expenses\PaymentMethod\EditPaymentMethod;
use App\Livewire\Domains\Expenses\PaymentMethod\ListPaymentMethods;
use App\Livewire\Domains\Expenses\Product\CreateProduct;
use App\Livewire\Domains\Expenses\Product\EditProduct;
use App\Livewire\Domains\Expenses\Product\ListProducts;
use App\Livewire\Domains\Expenses\Product\ViewProduct;
use App\Livewire\Domains\Expenses\TransactionType\CreateTransactionType;
use App\Livewire\Domains\Expenses\TransactionType\EditTransactionType;
use App\Livewire\Domains\Expenses\TransactionType\ListTransactionTypes;
use App\Livewire\ExpensesHomepage;
use App\Livewire\Homepage;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');

// Route::group(['middleware' => ['auth']], function () {

// Route::view('my-profile', 'profile')
//    ->name('profile');
Route::prefix('expenses')->group(function () {

    Route::get('', ExpensesHomepage::class)->name('expenses');

    // Payments
    //        Route::get('payments', ListPayments::class)->name('payments');
    //        Route::get('payments/reports', PaymentReports::class)->name('payments.reports');

    // Products
    //        Route::get('products', ListProducts::class)->name('products');
    //        Route::get('products/{product}/', ViewProduct::class)->name('product.view');
    //        Route::get('products/create', CreateProduct::class)->name('products.create');
    //        Route::get('products/{product}/edit', EditProduct::class)->name('products.edit');

    // Merchants
    //        Route::get('merchants', ListMerchants::class)->name('merchants');
    //        Route::get('merchants/{merchant}/', ViewMerchant::class)->name('merchant.view');
    //        Route::get('merchants/create', CreateMerchant::class)->name('merchants.create');
    //        Route::get('merchants/{merchant}/edit', EditMerchant::class)->name('merchants.edit');

    // Categories
    //        Route::get('categories', ListCategories::class)->name('categories');
    //        Route::get('categories/{category}', ViewCategory::class)->name('category.view');
    //        Route::get('categories/create', CreateCategory::class)->name('categories.create');
    //        Route::get('categories/{category}/edit', CreateCategory::class)->name('categories.edit');

    // Category types
    //        Route::get('category-types', ListCategoryTypes::class)->name('categories.types');
    //        Route::get('category-types/create', CreateCategoryType::class)->name('categories.types.create');
    //        Route::get('category-types/{category}/edit', CreateCategoryType::class)->name('categories.types.edit');

    // Payment methods
    //        Route::get('payment-methods', ListPaymentMethods::class)->name('paymentMethods');
    //        Route::get('payment-methods/create', CreatePaymentMethod::class)->name('paymentMethods.create');
    //        Route::get('payment-methods/{paymentMethod}/edit', EditPaymentMethod::class)->name('paymentMethods.edit');

    // Transaction types
    //        Route::get('transaction-types', ListTransactionTypes::class)->name('transactionTypes');
    //        Route::get('transaction-types/create', CreateTransactionType::class)->name('transactionTypes.create');
    //        Route::get('transaction-types/{transactionType}/edit', EditTransactionType::class)->name('transactionTypes.edit');
});
// });

require __DIR__.'/auth.php';
