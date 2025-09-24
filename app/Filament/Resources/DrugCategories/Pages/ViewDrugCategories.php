<?php

namespace App\Filament\Resources\DrugCategories\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\DrugCategories\DrugCategoriesResource;

class ViewDrugCategories extends ViewRecord
{
    protected static string $resource = DrugCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
