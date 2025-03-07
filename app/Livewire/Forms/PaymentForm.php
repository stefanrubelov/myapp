<?php

namespace App\Livewire\Forms;

use App\Models\Merchant;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\TransactionType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Livewire\Form;

class PaymentForm extends Form
{
    public static function schema(): array
    {
        return [
            TextInput::make('price')
                ->numeric()
                ->step(0.01)
                ->minValue(1)
                ->columnSpan(1)
                ->required(),

            ToggleButtons::make('discounted')
                ->label('Discounted?')
                ->options([
                    1 => 'Discounted',
                    0 => 'Full price',
                ])
                ->colors([
                    0 => 'gray',
                    1 => 'primary',
                ])
                ->grouped()
                ->default(0),

            Select::make('transaction_type_id')
                ->label('Transaction Type')
                ->options(TransactionType::all()->pluck('name', 'id'))
                ->default(1)
                ->required(),

            Select::make('payment_method_id')
                ->label('Payment Method')
                ->options(PaymentMethod::all()->pluck('name', 'id'))
                ->default(1)
                ->required(),

            Select::make('merchant_id')
                ->options(Merchant::all()->pluck('name', 'id')->toArray())
                ->columnSpan(2)
                ->required(),

            Select::make('product_id')
                ->options(function () {
                    return Product::orderBy('name')
                        ->get()
                        ->groupBy(function ($product) {
                            return strtoupper(substr($product->name, 0, 1));
                        })
                        ->map(function ($items) {
                            return $items->mapWithKeys(function ($item) {
                                return [$item->id => $item->name];
                            });
                        })
                        ->toArray();
                })
                ->required()
                ->columnSpan(2),

            DateTimePicker::make('payment_date')
                ->required()
                ->columnSpan(2)
                ->default(now())
                ->required(),

            Textarea::make('note')
                ->nullable()
                ->columnSpan(2)
                ->rows(5)
        ];
    }
}
