<?php

namespace App\Filament\Resources\DrugForms\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DrugForms\DrugFormsResource;

class ListDrugForms extends ListRecords
{
    protected static string $resource = DrugFormsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\DrugForms\Widgets\DrugFormsStat::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->disableCreateAnother()
                ->label('Add New Drug Form'),
        ];
    }
}
