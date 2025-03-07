<?php

namespace App\Livewire\Components\SidebarMenu;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

//TODO: finish up permissions logic, here and in blade

abstract class SidebarMenuComponent extends Component
{
    public array $menuItems = [];

    public function mount(): void
    {
        $this->initializeMenu();
    }
    public abstract function initializeMenu(): void;

    public function render(): View|Factory|Application|\Illuminate\View\View
    {
        return view('livewire.components.sidebar-menu-component');
    }
}
