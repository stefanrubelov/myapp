<?php

use App\Livewire\Expenses\Category\CreateCategory;
use App\Livewire\Expenses\Category\ListCategories;
use App\Livewire\Expenses\Category\ViewCategory;
use App\Livewire\Expenses\CategoryType\CreateCategoryType;
use App\Livewire\Expenses\CategoryType\ListCategoryTypes;
use App\Livewire\Expenses\Merchant\ViewMerchant;
use App\Livewire\Expenses\Payment\PaymentReports;
use App\Livewire\Expenses\PaymentMethod\CreatePaymentMethod;
use App\Livewire\Expenses\PaymentMethod\EditPaymentMethod;
use App\Livewire\Expenses\PaymentMethod\ListPaymentMethods;
use App\Livewire\Expenses\Product\ViewProduct;
use App\Livewire\Expenses\TransactionType\CreateTransactionType;
use App\Livewire\Expenses\TransactionType\EditTransactionType;
use App\Livewire\Expenses\TransactionType\ListTransactionTypes;
use App\Livewire\ExpensesHomepage;
use App\Livewire\Homepage;
use App\Livewire\Expenses\Merchant\CreateMerchant;
use App\Livewire\Expenses\Merchant\EditMerchant;
use App\Livewire\Expenses\Merchant\ListMerchants;
use App\Livewire\Expenses\Payment\ListPayments;
use App\Livewire\Expenses\Product\CreateProduct;
use App\Livewire\Expenses\Product\EditProduct;
use App\Livewire\Expenses\Product\ListProducts;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::view('my-profile', 'profile')
        ->name('profile');
    Route::prefix('expenses')->group(function () {

        Route::get('', ExpensesHomepage::class)->name('expenses');

        //Payments
        Route::get('payments', ListPayments::class)->name('payments');
        Route::get('payments/reports', PaymentReports::class)->name('payments.reports');

        //Products
        Route::get('products', ListProducts::class)->name('products');
        Route::get('products/{product}/', ViewProduct::class)->name('product.view');
        Route::get('products/create', CreateProduct::class)->name('products.create');
        Route::get('products/{product}/edit', EditProduct::class)->name('products.edit');

        //Merchants
        Route::get('merchants', ListMerchants::class)->name('merchants');
        Route::get('merchants/{merchant}/', ViewMerchant::class)->name('merchant.view');
        Route::get('merchants/create', CreateMerchant::class)->name('merchants.create');
        Route::get('merchants/{merchant}/edit', EditMerchant::class)->name('merchants.edit');

        //Categories
        Route::get('categories', ListCategories::class)->name('categories');
        Route::get('categories/{category}', ViewCategory::class)->name('category.view');
        Route::get('categories/create', CreateCategory::class)->name('categories.create');
        Route::get('categories/{category}/edit', CreateCategory::class)->name('categories.edit');

        //Category types
        Route::get('category-types', ListCategoryTypes::class)->name('categories.types');
        Route::get('category-types/create', CreateCategoryType::class)->name('categories.types.create');
        Route::get('category-types/{category}/edit', CreateCategoryType::class)->name('categories.types.edit');

        //Payment methods
        Route::get('payment-methods', ListPaymentMethods::class)->name('paymentMethods');
        Route::get('payment-methods/create', CreatePaymentMethod::class)->name('paymentMethods.create');
        Route::get('payment-methods/{paymentMethod}/edit', EditPaymentMethod::class)->name('paymentMethods.edit');

        //Transaction types
        Route::get('transaction-types', ListTransactionTypes::class)->name('transactionTypes');
        Route::get('transaction-types/create', CreateTransactionType::class)->name('transactionTypes.create');
        Route::get('transaction-types/{transactionType}/edit', EditTransactionType::class)->name('transactionTypes.edit');
    });
});

require __DIR__ . '/auth.php';
