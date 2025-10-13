<?php

namespace App\Filament\Resources\MedicineStocks\Pages;

use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\MedicineStocks\MedicineStocksResource;

class ViewMedicineStocks extends ViewRecord
{
    protected static string $resource = MedicineStocksResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\MedicineStocks\Widgets\StockDetailStat::class,
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit')
                ->icon(Heroicon::OutlinedPencilSquare)
                ->modalHeading(fn ($record) => 'Edit ' . $record->name . ' Stock Details')
                ->modalDescription(fn ($record) => 'Update detailed information about the ' . $record->name . ' stock')
                ->schema([
                    Section::make('Medicine Information')
                        ->description('Enter the basic medicine information')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Medicine Name')
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('Enter medicine name'),
                                    TextInput::make('batch_id')
                                        ->label('Batch ID')
                                        ->required()
                                        ->placeholder('Enter batch ID'),
                                    TextInput::make('medicine_stocks_id')
                                        ->label('Medicine Stock ID')
                                        ->placeholder('Will be automatically generated')
                                        ->disabled()
                                        ->dehydrated(false),
                                ]),
                        ]),

                    Section::make('Stock & Pricing')
                        ->description('Manage stock quantity and pricing details')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('quantity')
                                        ->label('Stock Quantity')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->placeholder('Enter stock quantity'),
                                    TextInput::make('price')
                                        ->label('Price')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('Rp')
                                        ->placeholder('Enter price'),
                                    DatePicker::make('expired_date')
                                        ->label('Expired Date')
                                        ->required()
                                        ->placeholder('Select expired date'),
                                ]),
                        ]),

                    Section::make('Classification')
                        ->description('Select medicine type, category, and supplier')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    Select::make('medicine_types_id')
                                        ->label('Medicine Type')
                                        ->options(\App\Models\MedicineType::where('status', 'aktif')
                                            ->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->placeholder('Select Medicine Type'),
                                    Select::make('medicine_categories_id')
                                        ->label('Medicine Category')
                                        ->options(\App\Models\MedicineCategory::where('status', 'aktif')
                                            ->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->placeholder('Select Medicine Category'),
                                    Select::make('medicine_suppliers_id')
                                        ->label('Supplier')
                                        ->options(\App\Models\MedicineSupplier::where('status', 'aktif')
                                            ->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->placeholder('Select Supplier'),
                                ]),
                        ]),
                ]),
        ];
    }
}