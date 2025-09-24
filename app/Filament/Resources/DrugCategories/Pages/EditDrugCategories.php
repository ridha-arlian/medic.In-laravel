<?php

namespace App\Filament\Resources\DrugCategories\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DrugCategories\DrugCategoriesResource;

class EditDrugCategories extends EditRecord
{
    protected static string $resource = DrugCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
