<?php

namespace App\Filament\Resources\Suppliers;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\MedicineSupplier;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Suppliers\Pages\EditSuppliers;
use App\Filament\Resources\Suppliers\Pages\ListSuppliers;
use App\Filament\Resources\Suppliers\Pages\ViewSuppliers;
use App\Filament\Resources\Suppliers\Schemas\SuppliersForm;
use App\Filament\Resources\Suppliers\Tables\SuppliersTable;
use App\Filament\Resources\Suppliers\Pages\CreateSuppliers;
use App\Filament\Resources\Suppliers\Widgets\StatsSupplier;
use App\Filament\Resources\Suppliers\Schemas\SuppliersInfolist;

class SuppliersResource extends Resource
{
    
    protected static ?string $model = MedicineSupplier::class;
    
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedTruck;

    public static function form(Schema $schema): Schema
    {
        return SuppliersForm::configure($schema);
    }
    
    public static function infolist(Schema $schema): Schema
    {
        return SuppliersInfolist::configure($schema);
    }
    
    public static function table(Table $table): Table
    {
        return SuppliersTable::configure($table);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getWidgets(): array
    {
        return [
            StatsSupplier::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => ListSuppliers::route('/'),
            // 'create' => CreateSuppliers::route('/create'),
            // 'view' => ViewSuppliers::route('/{record}'),
            // 'edit' => EditSuppliers::route('/{record}/edit'),
        ];
    }
}