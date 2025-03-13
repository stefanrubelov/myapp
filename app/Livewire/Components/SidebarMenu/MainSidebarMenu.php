<?php

declare(strict_types=1);

namespace App\Livewire\Components\SidebarMenu;

class MainSidebarMenu extends SidebarMenuComponent
{
    public function initializeMenu(): void
    {
        $this->menuItems = [
            MenuItem::make('Expenses')
                ->route('expenses')
                ->icon('heroicon-o-squares-plus')
                ->toArray(),
        ];
    }
}
