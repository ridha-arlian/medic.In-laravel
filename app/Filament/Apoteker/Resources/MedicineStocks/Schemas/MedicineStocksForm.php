<?php

namespace App\Filament\Apoteker\Resources\MedicineStocks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class MedicineStocksForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Medicine Name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter medicine name'),
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
                    ->placeholder('Enter price'),
                TextInput::make('batch_id')
                    ->label('Batch ID')
                    ->required()
                    ->placeholder('Enter batch ID'),
                DatePicker::make('expired_date')
                    ->label('Expired Date')
                    ->required()
                    ->placeholder('Enter expired date'),
                Select::make('medicine_types_id')
                    ->label('Medicine Type')
                    ->options(\App\Models\MedicineType::where('status', 'aktif')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->placeholder('Pilih Tipe Obat'),
                Select::make('medicine_categories_id')
                    ->label('Medicine Category')
                    ->options(\App\Models\MedicineCategory::where('status', 'aktif')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->placeholder('Pilih Kategori Obat'),
                Select::make('medicine_suppliers_id')
                    ->label('Supplier')
                    ->options(\App\Models\MedicineSupplier::where('status', 'aktif')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->placeholder('Pilih Supplier'),
            ]);
    }
}