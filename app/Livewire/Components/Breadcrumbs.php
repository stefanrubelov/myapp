<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Breadcrumbs extends Component
{
    public string $currentRoute = '';

    public array $breadcrumbs = [];

    public bool $showHomeRoute = true;

    private const array BREADCRUMB_HIERARCHY = [
        'expenses' => [
            'title' => 'Expenses',
        ],

        'payments' => [
            'title' => 'Payments',
            'expenses' => 'Expenses',
        ],
        'payments.create' => [
            'title' => 'Add Payment',
            'expenses' => 'Expenses',
            'payments' => 'Payments',
        ],
        'payments.view' => [
            'title' => 'View Payment',
            'payments' => 'Payments',
            'expenses' => 'Expenses',
        ],
        'payments.edit' => [
            'title' => 'Edit Payment',
            'payments' => 'Payments',
            'expenses' => 'Expenses',
        ],

        'product.view' => [
            'title' => 'View Product',
            'products' => 'Products',
            'expenses' => 'Expenses',
        ],

        'products' => [
            'title' => 'Products',
            'expenses' => 'Expenses',
        ],
        'products.create' => [
            'title' => 'Add Product',
            'products' => 'Products',
            'expenses' => 'Expenses',
        ],
        'products.edit' => [
            'title' => 'Edit Product',
            'products' => 'Products',
            'expenses' => 'Expenses',
        ],
        'products.delete' => [
            'title' => 'Delete Product',
            'products' => 'Products',
            'expenses' => 'Expenses',
        ],

        'merchants' => [
            'title' => 'Merchants',
            'expenses' => 'Expenses',
        ],
    ];

    public function mount(): void
    {
        $this->breadcrumbs = $this->generateBreadcrumbs();
    }

    protected function generateBreadcrumbs(): array
    {
        $currentRouteName = $this->currentRoute != '' ? $this->currentRoute : Route::currentRouteName();

        if (! isset(self::BREADCRUMB_HIERARCHY[$currentRouteName])) {
            return [];
        }

        $currentBreadcrumb = self::BREADCRUMB_HIERARCHY[$currentRouteName];
        $breadcrumbs = [];

        foreach ($currentBreadcrumb as $route => $title) {
            if ($route === 'title') {
                continue;
            }

            $breadcrumbs[] = [
                'name' => $route,
                'title' => $title,
                'url' => route($route),
            ];
        }

        $breadcrumbs = array_reverse($breadcrumbs);

        $breadcrumbs[] = [
            'name' => $currentRouteName,
            'title' => $currentBreadcrumb['title'],
            //            'url' => route($currentRouteName),
        ];

        return $breadcrumbs;
    }

    public function render(): View
    {
        return view('livewire.components.breadcrumbs');
    }
}
