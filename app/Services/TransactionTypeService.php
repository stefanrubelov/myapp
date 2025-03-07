<?php

namespace App\Services;

use App\Models\TransactionType;
use Illuminate\Support\Collection;

class TransactionTypeService
{
    public function getAll(bool $enabledOnly = false): Collection
    {
        return TransactionType::when($enabledOnly, fn($query) => $query->isEnabled())
            ->orderBy('id')
            ->get();
    }
}
