<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Payment\Infolists;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class PaymentInfoList
{
    public static function schema(): array
    {
        return [
            Section::make()->schema([
                TextEntry::make('payment_number')
                    ->formatStateUsing(function ($state) {
                        return '#'.$state;
                    })
                    ->label('')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->inlineLabel(false)
                    ->tooltip('Payment Number')
                    ->copyable(),

                TextEntry::make('payment_date')
                    ->columnSpan(1)
                    ->label('')
                    ->size(TextEntry\TextEntrySize::Medium),

            ])->columnSpan(2)->columns(2),

            Section::make()->schema([
                TextEntry::make('product.name')
                    ->label('')
                    ->columnSpan(1)
                    ->size(TextEntry\TextEntrySize::Large),

                TextEntry::make('price')
                    ->label('')
                    ->money('DKK')
                    ->columnSpan(1)
                    ->size(TextEntry\TextEntrySize::Large),

                TextEntry::make('merchant.name')
                    ->columnSpan(1)
                    ->label('')
                    ->size(TextEntry\TextEntrySize::Medium),

                TextEntry::make('discounted')
                    ->badge()
                    ->color(fn (bool $state) => match ($state) {
                        true => 'success',
                        false => 'gray',
                        default => 'danger'
                    })->label('')
                    ->formatStateUsing(fn (bool $state) => $state ? 'Discounted' : 'Full Price'),
            ])->columns(2)->columnSpan(2),

            Section::make()->schema([
                TextEntry::make('transactionType.name')
                    ->columns(1),

                TextEntry::make('paymentMethod.name')
                    ->columns(1),
            ])
                ->columns(2)
                ->columnSpan(2),

        ];
    }
}
