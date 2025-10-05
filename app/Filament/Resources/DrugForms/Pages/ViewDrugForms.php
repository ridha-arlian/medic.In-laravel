<?php

namespace App\Filament\Resources\DrugForms\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\DrugForms\DrugFormsResource;

class ViewDrugForms extends ViewRecord
{
    protected static string $resource = DrugFormsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}