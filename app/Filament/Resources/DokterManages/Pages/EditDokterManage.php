<?php

namespace App\Filament\Resources\DokterManages\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DokterManages\DokterManageResource;

class EditDokterManage extends EditRecord
{
    protected static string $resource = DokterManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}