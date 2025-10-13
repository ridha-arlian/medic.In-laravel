<?php

namespace App\Filament\Resources\MedicineStocks;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\MedicineStock;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\MedicineStocks\Widgets\StockDetailStat;
use App\Filament\Resources\MedicineStocks\Pages\ListMedicineStocks;
use App\Filament\Resources\MedicineStocks\Pages\ViewMedicineStocks;
use App\Filament\Resources\MedicineStocks\Schemas\MedicineStocksForm;
use App\Filament\Resources\MedicineStocks\Tables\MedicineStocksTable;
use App\Filament\Resources\MedicineStocks\Schemas\MedicineStocksInfolist;

class MedicineStocksResource extends Resource
{
    protected static ?string $model = MedicineStock::class;

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MedicineStocksForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MedicineStocksInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MedicineStocksTable::configure($table);
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
            StockDetailStat::class,
        ];
    }

    public static function getRecordSlug(): string
    {
        return 'name';
    }

    public static function getRecordRouteKeyName(): ?string
    {
        return 'name';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMedicineStocks::route('/'),
            'view' => ViewMedicineStocks::route('/{record:name}'),
        ];
    }
}