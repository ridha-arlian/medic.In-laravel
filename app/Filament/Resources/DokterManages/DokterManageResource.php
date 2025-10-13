<?php

namespace App\Filament\Resources\DokterManages;

use App\Models\User;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DokterManages\Pages\ListDokterManages;
use App\Filament\Resources\DokterManages\Schemas\DokterManageForm;
use App\Filament\Resources\DokterManages\Tables\DokterManagesTable;
use App\Filament\Resources\DokterManages\Schemas\DokterManageInfolist;

class DokterManageResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Doctor';

    protected static ?string $pluralModelLabel = 'Doctors';

    protected static string | \UnitEnum | null $navigationGroup = 'Management Users';

    protected static string | \BackedEnum | null $navigationIcon = 'fas-user-doctor';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('roles', function ($query) {
            $query->whereIn('name', ['dokter']);
        });
    }

    public static function getPolicy(): ?string
    {
        return \App\Policies\DokterManagePolicy::class;
    }

    public static function form(Schema $schema): Schema
    {
        return DokterManageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DokterManageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DokterManagesTable::configure($table);
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
            'index' => ListDokterManages::route('/')
        ];
    }
}