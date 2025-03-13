<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Merchant;

use App\Domains\Expenses\Merchant\Models\Merchant;
use App\Domains\Shared\Traits\Filters\PerPageFilter;
use App\Domains\Shared\Traits\Filters\SortByFilter;
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

        return view('livewire.domains.expenses.merchant.list-merchants', compact('merchants'))->layout('layouts.expenses');
    }
}
