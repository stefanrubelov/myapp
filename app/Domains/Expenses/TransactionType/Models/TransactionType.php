<?php

declare(strict_types=1);

namespace App\Domains\Expenses\TransactionType\Models;

use App\Domains\Expenses\TransactionType\Factories\TransactionTypeFactory;
use App\Traits\EnabledScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TransactionType extends Model
{
    use EnabledScope, HasSlug;

    public static function newFactory(): TransactionTypeFactory
    {
        return TransactionTypeFactory::new();
    }
    
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => ucfirst($value),
        );
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
