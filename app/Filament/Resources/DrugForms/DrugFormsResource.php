<?php

namespace App\Filament\Resources\DrugForms;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\MedicineType;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\DrugForms\Pages\ViewDrugForms;
use App\Filament\Resources\DrugForms\Pages\EditDrugForms;
use App\Filament\Resources\DrugForms\Pages\ListDrugForms;
use App\Filament\Resources\DrugForms\Widgets\DrugFormsStat;
use App\Filament\Resources\DrugForms\Pages\CreateDrugForms;
use App\Filament\Resources\DrugForms\Schemas\DrugFormsForm;
use App\Filament\Resources\DrugForms\Tables\DrugFormsTable;
use App\Filament\Resources\DrugForms\Schemas\DrugFormsInfolist;

class DrugFormsResource extends Resource
{
    protected static ?string $model = MedicineType::class;

    protected static string | UnitEnum | null $navigationGroup = 'Catalogues';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    public static function form(Schema $schema): Schema
    {
        return DrugFormsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DrugFormsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DrugFormsTable::configure($table);
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
            DrugFormsStat::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDrugForms::route('/'),
            // 'create' => CreateDrugForms::route('/create'),
            // 'view' => ViewDrugForms::route('/{record}'),
            // 'edit' => EditDrugForms::route('/{record}/edit'),
        ];
    }
}
