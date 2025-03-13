<?php

declare(strict_types=1);

namespace App\Livewire\Components\SidebarMenu;

class ExpensesSidebarMenu extends SidebarMenuComponent
{
    public function initializeMenu(): void
    {
        $this->menuItems = $this->menuItems();
    }

    public static function menuItems(): array
    {
        return [
            MenuItem::make('Home')
                ->route('home')
                ->icon('heroicon-o-home')
                ->toArray(),

            MenuItem::make('General')
                ->route('expenses')
                ->icon('heroicon-o-squares-plus')
                ->toArray(),

            MenuGroup::make('Payments')
                ->icon('heroicon-o-currency-dollar')
                ->items([
                    MenuItem::make('List of payments')
                        ->route('payments')
                        ->icon('heroicon-o-currency-euro'),
                    MenuItem::make('Reports')
                        ->route('payments.reports')
                        ->icon('heroicon-o-chart-bar-square'),
                ])
                ->toArray(),

            MenuItem::make('Products')
                ->route('products')
                ->icon('heroicon-o-inbox-stack')
                ->toArray(),

            MenuItem::make('Merchants')
                ->route('merchants')
                ->icon('heroicon-o-building-storefront')
                ->toArray(),

            MenuGroup::make('Categories')
                ->icon('heroicon-o-rectangle-group')
                ->items([
                    MenuItem::make('List of categories')
                        ->route('categories')
                        ->icon('heroicon-o-rectangle-stack'),
                    MenuItem::make('Category types')
                        ->route('categories.types')
                        ->icon('heroicon-o-queue-list'),
                ])
                ->toArray(),

            MenuGroup::make('Payment settings')
                ->icon('heroicon-o-wallet')
                ->items([
                    MenuItem::make('Payment methods')
                        ->route('paymentMethods')
                        ->icon('heroicon-o-credit-card'),
                    MenuItem::make('Transaction types')
                        ->route('transactionTypes')
                        ->icon('heroicon-o-banknotes'),
                ])
                ->toArray(),
        ];
    }
}
