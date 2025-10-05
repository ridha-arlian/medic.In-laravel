<?php

namespace App\Filament\Resources\AdminManages\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AdminManages\AdminManageResource;

class CreateAdminManage extends CreateRecord
{
    protected static string $resource = AdminManageResource::class;

    protected function afterCreate(): void
    {
        $this->record->assignRole('super_admin');
    }
}