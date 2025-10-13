<?php

namespace App\Filament\Resources\ApotekerManages;

use App\Models\User;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ApotekerManages\Pages\ListApotekerManages;
use App\Filament\Resources\ApotekerManages\Schemas\ApotekerManageForm;
use App\Filament\Resources\ApotekerManages\Tables\ApotekerManagesTable;
use App\Filament\Resources\ApotekerManages\Schemas\ApotekerManageInfolist;

class ApotekerManageResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Pharmacist';

    protected static ?string $pluralModelLabel = 'Pharmacists';

    protected static string | \UnitEnum | null $navigationGroup = 'Management Users';

    protected static string | \BackedEnum | null $navigationIcon = 'hugeicons-doctor-03';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('roles', function ($query) {
            $query->whereIn('name', ['apoteker']);
        });
    }

    public static function getPolicy(): ?string
    {
        return \App\Policies\ApotekerManagePolicy::class;
    }

    public static function form(Schema $schema): Schema
    { 
        return ApotekerManageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApotekerManageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApotekerManagesTable::configure($table);
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
            'index' => ListApotekerManages::route('/')
        ];
    }
}