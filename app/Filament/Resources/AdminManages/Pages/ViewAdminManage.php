<?php

namespace App\Filament\Resources\AdminManages\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\AdminManages\AdminManageResource;

class ViewAdminManage extends ViewRecord
{
    protected static string $resource = AdminManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
