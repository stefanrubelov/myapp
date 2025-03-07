<?php

namespace App\Traits\Filters;

use Livewire\Attributes\Url;

trait PerPageFilter
{
    #[Url('perPage', false, true)]
    public int $perPage = 20;

    public array $perPageOptions = [20, 50, 100, 200];

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }
}
