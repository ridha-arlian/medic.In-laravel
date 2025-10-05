<?php

namespace App\Filament\Resources\ApotekerManages\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ApotekerManages\ApotekerManageResource;

class EditApotekerManage extends EditRecord
{
    protected static string $resource = ApotekerManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
