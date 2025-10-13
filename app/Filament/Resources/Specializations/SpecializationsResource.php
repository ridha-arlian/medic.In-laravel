<?php

namespace App\Filament\Resources\Specializations;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\Specialization;
use Filament\Resources\Resource;
use App\Filament\Resources\Specializations\Pages\ViewSpecializations;
use App\Filament\Resources\Specializations\Pages\ListSpecializations;
use App\Filament\Resources\Specializations\Pages\EditSpecializations;
use App\Filament\Resources\Specializations\Tables\SpecializationsTable;
use App\Filament\Resources\Specializations\Schemas\SpecializationsForm;
use App\Filament\Resources\Specializations\Pages\CreateSpecializations;
use App\Filament\Resources\Specializations\Schemas\SpecializationsInfolist;

class SpecializationsResource extends Resource
{
    protected static ?string $model = Specialization::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';

    protected static string | \BackedEnum | null $navigationIcon = 'hugeicons-doctor-02';

    public static function form(Schema $schema): Schema
    {
        return SpecializationsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SpecializationsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpecializationsTable::configure($table);
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
            'index' => ListSpecializations::route('/'),
            // 'create' => CreateSpecializations::route('/create'),
            // 'view' => ViewSpecializations::route('/{record}'),
            // 'edit' => EditSpecializations::route('/{record}/edit'),
        ];
    }
}
