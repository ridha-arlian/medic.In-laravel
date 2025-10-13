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
                Section::make('Medicine Information')
                    ->description('Basic medicine information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Medicine Name')
                                    ->weight('bold')
                                    ->size(TextSize::Large),
                                TextEntry::make('batch_id')
                                    ->label('Batch ID')
                                    ->copyable()
                                    ->icon('heroicon-o-hashtag'),
                                TextEntry::make('medicine_stocks_id')
                                    ->label('Medicine Stock ID')
                                    ->copyable()
                                    ->icon('heroicon-o-hashtag'),
                            ]),
                    ]),
                    
                Section::make('Stock & Pricing')
                    ->description('Manage stock quantity and pricing details')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('quantity')
                                    ->label('Stock Quantity')
                                    ->badge()
                                    ->color(fn (string $state): string => match (true) {
                                        $state <= 10 => 'danger',
                                        $state <= 50 => 'warning', 
                                        default => 'success',
                                    })
                                    ->size(TextSize::Large),
                                TextEntry::make('price')
                                    ->label('Price')
                                    ->money('IDR', divideBy: 1, decimalPlaces: 0),
                                TextEntry::make('expired_date')
                                    ->label('Expired Date')
                                    ->date('d M, Y')
                                    ->color(fn (string $state): string => now()->addDays(90)->gte($state) ? 'danger' : 'success'),
                            ]),
                    ]),
                    
                Section::make('Classification')
                    ->description('Medicine type, category, and supplier')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('medicine_types.name')
                                    ->label('Medicine Type')
                                    ->badge()
                                    ->size(TextSize::Large),
                                TextEntry::make('medicine_categories.name')
                                    ->label('Medicine Category')
                                    ->badge()
                                    ->size(TextSize::Large),
                                TextEntry::make('medicine_suppliers.name')
                                    ->label('Supplier')
                                    ->badge()
                                    ->size(TextSize::Large),
                            ]),
                    ]),
                    
                Section::make('Status')
                    ->description('Registered and updated timestamps')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Registered Since'),
                                TextEntry::make('updated_at')
                                    ->label('Last Updated'),
                            ]),
                    ]),
            ]);
    }
}