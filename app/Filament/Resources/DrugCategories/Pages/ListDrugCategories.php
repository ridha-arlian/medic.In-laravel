<?php

namespace App\Filament\Resources\DrugCategories\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DrugCategories\DrugCategoriesResource;

class ListDrugCategories extends ListRecords
{
    protected static string $resource = DrugCategoriesResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\DrugCategories\Widgets\DrugCategoriesStat::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->label('Add New Drug Category'),
        ];
    }
}