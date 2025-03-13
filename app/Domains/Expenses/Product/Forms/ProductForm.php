<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Product\Forms;

use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Livewire\Form;

class ProductForm extends Form
{
    public static function schema(): array
    {
        return [
            SelectTree::make('category_id')
                ->relationship('category', 'name', 'parent_id')
                ->enableBranchNode()
                ->required()
                ->exists('categories', 'id')
                ->label('Category'),

            TextInput::make('name')
                ->reactive()
                ->live(debounce: 250)
                ->afterStateUpdated(function (Set $set, $state) {
                    $set('slug', Str::slug($state));
                })
                ->required()
                ->minLength(3),

            TextInput::make('slug')
                ->required()
                ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                ->unique('categories', 'slug'),
        ];
    }
}
