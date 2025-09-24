<?php

namespace App\Filament\Resources\MedicineStocks\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;

class MedicineStocksInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Basic Information Section
                Section::make('Basic Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('medicine_stocks_id') // sesuai field kamu
                                    ->label('Stock ID')
                                    ->copyable()
                                    ->icon('heroicon-o-hashtag'),
                                TextEntry::make('name')
                                    ->size(TextSize::Large)
                                    ->weight('bold'),
                            ]),
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('medicine_types.name') // sesuai relationship kamu
                                    ->label('Drug Type')
                                    ->badge(),
                                TextEntry::make('medicine_categories.name')
                                    ->label('Drug Category')
                                    ->badge(),
                                TextEntry::make('medicine_suppliers.name')
                                    ->label('Supplier')
                                    ->badge(),
                            ]),
                    ]),

                // Stock Information Section
                Section::make('Stock Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('quantity')
                                    ->label('Current Stock')
                                    ->badge()
                                    ->color(fn (string $state): string => match (true) {
                                        $state <= 10 => 'danger',
                                        $state <= 50 => 'warning', 
                                        default => 'success',
                                    }),
                                TextEntry::make('price')
                                    ->label('Price')
                                    ->money('IDR', divideBy: 1),
                            ]),
                    ]),

                // Batch & Expiry Section
                Section::make('Batch & Expiry')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('batch_id')
                                    ->label('Batch ID')
                                    ->copyable(),
                                TextEntry::make('expired_date')
                                    ->label('Expiry Date')
                                    ->date('d M Y')
                                    ->color(fn (string $state): string => 
                                        now()->addDays(90)->gte($state) ? 'danger' : 'success'
                                    ),
                            ]),
                    ]),

                // System Info
                Section::make('System Information')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Added on')
                            ->since(),
                        TextEntry::make('updated_at')
                            ->label('Last updated')
                            ->since(),
                    ])
                    ->columns(2),
            ]);
    }
}