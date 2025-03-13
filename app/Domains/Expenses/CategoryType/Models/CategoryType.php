<?php

declare(strict_types=1);

namespace App\Domains\Expenses\CategoryType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
