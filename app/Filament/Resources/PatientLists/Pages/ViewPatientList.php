<?php

namespace App\Filament\Resources\PatientLists\Pages;

use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\PatientLists\PatientListResource;

class ViewPatientList extends ViewRecord
{
    protected static string $resource = PatientListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit')
                ->icon(Heroicon::OutlinedPencilSquare),
        ];
    }
}
