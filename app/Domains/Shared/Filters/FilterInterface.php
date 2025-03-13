<?php

declare(strict_types=1);

namespace App\Domains\Shared\Filters;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function __construct(array $filters);

    public function apply(Builder $query): void;
}
