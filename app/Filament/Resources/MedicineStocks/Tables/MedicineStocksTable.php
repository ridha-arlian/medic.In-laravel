<?php

namespace App\Filament\Resources\MedicineStocks\Tables;

use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class MedicineStocksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->searchable()
            ->emptyStateHeading('Stocks not avalailable')
            ->columns([
                TextColumn::make('medicine_stocks_id')
                    ->label('Stock ID'),
                TextColumn::make('batch_id')
                    ->label('Batch ID'),
                TextColumn::make('name'),
                TextColumn::make('quantity'),
                TextColumn::make('price')
                    ->money('IDR', decimalPlaces: 0),
                TextColumn::make('expired_date')
                    ->date()
                    ->label('Expired Date'),
                TextColumn::make('medicine_types.name')
                    ->label('Drug Type'),
                TextColumn::make('medicine_categories.name')
                    ->label('Drug Category'),
                TextColumn::make('medicine_suppliers.name')
                    ->label('Supplier Name'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make(),
                        ViewAction::make(),
                    ])->dropdown(false),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All'),
            ]);
    }
}
