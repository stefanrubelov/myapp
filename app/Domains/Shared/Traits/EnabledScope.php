<?php

declare(strict_types=1);

namespace App\Domains\Shared\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait EnabledScope
{
    public function scopeIsEnabled(Builder $query): Builder
    {
        return $query->where('is_enabled', '=', true);
    }
}
