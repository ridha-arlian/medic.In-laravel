<?php

namespace App\Filament\Resources\AdminManages;

use UnitEnum;
use BackedEnum;
use App\Models\User;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AdminManages\Pages\ListAdminManages;
use App\Filament\Resources\AdminManages\Schemas\AdminManageForm;
use App\Filament\Resources\AdminManages\Tables\AdminManagesTable;
use App\Filament\Resources\AdminManages\Schemas\AdminManageInfolist;

class AdminManageResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Admin';

    protected static ?string $pluralModelLabel = 'Admin';

    protected static string | UnitEnum | null $navigationGroup = 'Management Users';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'super_admin']);
        });
    }

    public static function getPolicy(): ?string
    {
        return \App\Policies\AdminManagePolicy::class;
    }

    public static function form(Schema $schema): Schema
    {
        return AdminManageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AdminManageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdminManagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdminManages::route('/'),
            // 'create' => CreateAdminManage::route('/create'),
            // 'edit' => EditAdminManage::route('/{record}/edit'),
        ];
    }
}