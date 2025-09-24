<?php

namespace App\Filament\Resources\RolePermissions;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\RolePermissions;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\RolePermissions\Pages\EditRolePermissions;
use App\Filament\Resources\RolePermissions\Pages\ListRolePermissions;
use App\Filament\Resources\RolePermissions\Pages\ViewRolePermissions;
use App\Filament\Resources\RolePermissions\Tables\RolePermissionsTable;
use App\Filament\Resources\RolePermissions\Pages\CreateRolePermissions;
use App\Filament\Resources\RolePermissions\Schemas\RolePermissionsForm;
use App\Filament\Resources\RolePermissions\Schemas\RolePermissionsInfolist;

class RolePermissionsResource extends Resource
{
    protected static ?string $model = RolePermissions::class;

    protected static string | UnitEnum | null $navigationGroup = 'Management Users';

    protected static ?string $navigationLabel = 'Role';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    public static function form(Schema $schema): Schema
    {
        return RolePermissionsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RolePermissionsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolePermissionsTable::configure($table);
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
            'index' => ListRolePermissions::route('/'),
            'create' => CreateRolePermissions::route('/create'),
            'view' => ViewRolePermissions::route('/{record}'),
            'edit' => EditRolePermissions::route('/{record}/edit'),
        ];
    }
}
