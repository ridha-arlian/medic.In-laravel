<?php

namespace App\Filament\Resources\ApotekerManages\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ApotekerManages\ApotekerManageResource;

class ViewApotekerManage extends ViewRecord
{
    protected static string $resource = ApotekerManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}