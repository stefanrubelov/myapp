<?php

namespace App\Livewire\Components\SidebarMenu;

class MainSidebarMenu extends SidebarMenuComponent
{
    public function initializeMenu(): void
    {
        $listOfSidebarMenus = [
            ExpensesSidebarMenu::menuItems(),
        ];
        
        $this->menuItems = call_user_func_array("array_merge", $listOfSidebarMenus);
    }
}
