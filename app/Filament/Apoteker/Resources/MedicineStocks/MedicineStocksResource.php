<?php

namespace App\Filament\Apoteker\Resources\MedicineStocks;

use BackedEnum;
use App\Models\MedicineStock;
use App\Filament\Apoteker\Resources\MedicineStocks\Pages\CreateMedicineStocks;
use App\Filament\Apoteker\Resources\MedicineStocks\Pages\EditMedicineStocks;
use App\Filament\Apoteker\Resources\MedicineStocks\Pages\ListMedicineStocks;
use App\Filament\Apoteker\Resources\MedicineStocks\Pages\ViewMedicineStocks;
use App\Filament\Apoteker\Resources\MedicineStocks\Schemas\MedicineStocksForm;
use App\Filament\Apoteker\Resources\MedicineStocks\Schemas\MedicineStocksInfolist;
use App\Filament\Apoteker\Resources\MedicineStocks\Tables\MedicineStocksTable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MedicineStocksResource extends Resource
{
    protected static ?string $model = MedicineStock::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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

    public static function getPages(): array
    {
        return [
            'index' => ListMedicineStocks::route('/'),
            // 'create' => CreateMedicineStocks::route('/create'),
            // 'view' => ViewMedicineStocks::route('/{record}'),
            // 'edit' => EditMedicineStocks::route('/{record}/edit'),
        ];
    }
}
