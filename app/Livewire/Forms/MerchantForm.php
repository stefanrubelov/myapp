<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Livewire\Form;

class MerchantForm extends Form
{
    /**
     * @return array
     */
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
                ->live(debounce: 350)
                ->afterStateUpdated(function (Set $set, $state) {
                    $set('slug', Str::slug($state));
                })
                ->required()
                ->minLength(3),

            TextInput::make('slug')
                ->required()
                ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                ->unique('categories', 'slug'),

            ColorPicker::make('accent_color')
                ->default('#0d9488'),

        ];
    }
}
