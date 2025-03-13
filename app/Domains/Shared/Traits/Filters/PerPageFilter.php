<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits\Filters;

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
