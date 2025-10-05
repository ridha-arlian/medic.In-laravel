<?php

namespace App\Filament\Resources\AdminManages\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AdminManages\AdminManageResource;

class ListAdminManages extends ListRecords
{
    protected static string $resource = AdminManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->after(function ($record) {
                    $record->syncRoles(['super_admin']);
                }),
        ];
    }
}