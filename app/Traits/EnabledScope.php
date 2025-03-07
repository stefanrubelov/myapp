<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait EnabledScope
{
    public function scopeIsEnabled(Builder $query): Builder
    {
        return $query->where('is_enabled', '=', true);
    }
}
