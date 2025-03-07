<?php

namespace App\Livewire\Expenses\Merchant;

use App\Models\Merchant;
use App\Traits\Filters\PerPageFilter;
use App\Traits\Filters\SortByFilter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class ListMerchants extends Component
{
    use PerPageFilter,
        SortByFilter,
        WithPagination;

    protected $listeners = ['refreshMerchantsTable' => '$refresh'];

    private function getMerchants(): Merchant|LengthAwarePaginator|array
    {
        return Merchant::paginate($this->perPage);
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        $merchants = $this->getMerchants();

        return view('livewire.expenses.merchant.list-merchants', compact('merchants'))->layout('layouts.expenses');
    }
}
