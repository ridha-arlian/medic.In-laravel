<?php

namespace App\Filament\Resources\DrugForms\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DrugForms\DrugFormsResource;

class EditDrugForms extends EditRecord
{
    protected static string $resource = DrugFormsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
