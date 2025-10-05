<?php

namespace App\Filament\Resources\DokterManages\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\DokterManages\DokterManageResource;

class ViewDokterManage extends ViewRecord
{
    protected static string $resource = DokterManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}