<?php

namespace App\Filament\Resources\PatientLists\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PatientLists\PatientListResource;

class ListPatientLists extends ListRecords
{
    protected static string $resource = PatientListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add')
                ->icon(Heroicon::OutlinedPlus),
        ];
    }
}
