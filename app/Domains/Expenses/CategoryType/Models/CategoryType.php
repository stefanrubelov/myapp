<?php

declare(strict_types=1);

namespace App\Domains\Expenses\CategoryType\Models;

use App\Domains\Expenses\CategoryType\Factories\CategoryTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static function newFactory(): CategoryTypeFactory
    {
        return CategoryTypeFactory::new();
    }
}
