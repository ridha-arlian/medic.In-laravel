<?php

namespace App\Filament\Resources\ApotekerManages\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ApotekerManages\ApotekerManageResource;

class CreateApotekerManage extends CreateRecord
{
    protected static string $resource = ApotekerManageResource::class;

    protected function afterCreate(): void
    {
        $this->record->assignRole('apoteker');
    }
}
