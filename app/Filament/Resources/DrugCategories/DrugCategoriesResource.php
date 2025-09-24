<?php

namespace App\Filament\Resources\DrugCategories;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\MedicineCategory;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\DrugCategories\Pages\EditDrugCategories;
use App\Filament\Resources\DrugCategories\Pages\ListDrugCategories;
use App\Filament\Resources\DrugCategories\Pages\ViewDrugCategories;
use App\Filament\Resources\DrugCategories\Widgets\DrugCategoriesStat;
use App\Filament\Resources\DrugCategories\Pages\CreateDrugCategories;
use App\Filament\Resources\DrugCategories\Schemas\DrugCategoriesForm;
use App\Filament\Resources\DrugCategories\Tables\DrugCategoriesTable;
use App\Filament\Resources\DrugCategories\Schemas\DrugCategoriesInfolist;

class DrugCategoriesResource extends Resource
{
    protected static ?string $model = MedicineCategory::class;

    protected static string | UnitEnum | null $navigationGroup = 'Catalogues';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DrugCategoriesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DrugCategoriesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DrugCategoriesTable::configure($table);
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
            DrugCategoriesStat::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDrugCategories::route('/'),
            // 'create' => CreateDrugCategories::route('/create'),
            // 'view' => ViewDrugCategories::route('/{record}'),
            // 'edit' => EditDrugCategories::route('/{record}/edit'),
        ];
    }
}
