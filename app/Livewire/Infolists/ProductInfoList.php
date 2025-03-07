<?php

namespace App\Livewire\Infolists;

use Filament\Infolists\Components\TextEntry;

class ProductInfoList
{
    public static function schema(): array
    {
        return [
            TextEntry::make('id')
                ->label('ID'),

            TextEntry::make('name'),

            TextEntry::make('category.name')->columnSpan(2),

            TextEntry::make('updated_at')
                ->date(),

            TextEntry::make('created_at')
                ->date(),
        ];
    }
}
