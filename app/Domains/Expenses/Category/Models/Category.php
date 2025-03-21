<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Category\Models;

use App\Domains\Expenses\Category\Factories\CategoryFactory;
use App\Domains\Expenses\Product\Models\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;

    public static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => ucwords($value),
        );
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all parent and children categories of the current category.
     *
     * @param  bool  $includeSelf  Whether to include the current category in the result.
     * @param  bool  $includeChildren  Whether to include children categories in the result.
     */
    public function getCategoryHierarchy(
        bool $includeSelf = false,
        bool $includeChildren = true
    ): Collection {
        $categories = [];

        // Add parents if requested
        $parentCategories = [];
        $category = $this;

        while ($category->parent) {
            $category = $category->parent;
            $parentCategories[] = $category;
        }

        $categories = array_merge($categories, array_reverse($parentCategories));

        // Add current category if requested
        if ($includeSelf) {
            $categories[] = $this;
        }

        // Add children if requested
        if ($includeChildren) {
            $childCategories = [];
            $this->getAllChildCategories($this, $childCategories);
            $categories = array_merge($categories, $childCategories);
        }

        return collect($categories);
    }

    /**
     * Helper method to recursively get ALL nested children categories.
     *
     * @param  Category  $category  The category to get children from
     * @param  array  &$categories  Array to store all the categories
     */
    private function getAllChildCategories(Category $category, array &$categories): void
    {
        // Get immediate children
        $children = $category->children;
        foreach ($children as $child) {
            $categories[] = $child;
            // If this child has children, recursively get them
            if ($child->children->count() > 0) {
                $this->getAllChildCategories($child, $categories);
            }
        }
    }

    /**
     * Get the parent category of the current category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the children categories of the current category.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
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

    /**
     * Get the category hierarchy as a nested tree structure.
     * Each category will contain its children in a 'children' key.
     *
     * @param  bool  $includeSelf  Whether to include the current category as the root.
     * @param  int|null  $maxDepth  Maximum depth of children to include (null for unlimited)
     */
    public function getCategoryHierarchyTree(bool $includeSelf = true, ?int $maxDepth = null): array
    {
        if (! $includeSelf) {
            // If we don't want the current category, start with its parent
            if (! $this->parent) {
                return [];
            }

            return $this->parent->getCategoryHierarchyTree(true, $maxDepth);
        }

        // Start building the tree from the root category
        $rootCategory = $this;
        while ($rootCategory->parent) {
            $rootCategory = $rootCategory->parent;
        }

        return $this->buildCategoryTreeArray($rootCategory, $maxDepth);
    }

    /**
     * Helper method to recursively build the category tree array.
     *
     * @param  int|null  $maxDepth  Maximum depth to traverse (null for unlimited)
     * @param  int  $currentDepth  Current depth in the tree
     */
    private function buildCategoryTreeArray(Category $category, ?int $maxDepth = null, int $currentDepth = 0): array
    {
        $categoryData = $category->toArray();

        // Remove any existing 'children' key from the base data
        unset($categoryData['children']);

        // Check if we should continue adding children based on depth
        if ($maxDepth !== null && $currentDepth >= $maxDepth) {
            $categoryData['children'] = [];

            return $categoryData;
        }

        // Get immediate children and recursively build their trees
        $children = $category->children;
        if ($children->count() > 0) {
            $categoryData['children'] = $children->map(function ($child) use ($maxDepth, $currentDepth) {
                return $this->buildCategoryTreeArray($child, $maxDepth, $currentDepth + 1);
            })->values()->all();
        } else {
            $categoryData['children'] = [];
        }

        return $categoryData;
    }
}
