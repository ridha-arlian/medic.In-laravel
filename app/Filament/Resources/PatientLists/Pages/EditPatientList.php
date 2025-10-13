<?php

namespace App\Filament\Resources\PatientLists\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PatientLists\PatientListResource;

class EditPatientList extends EditRecord
{
    protected static string $resource = PatientListResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
                ->label('View')
                ->icon(Heroicon::OutlinedEye),
            DeleteAction::make()
                ->label('Delete')
                ->icon(Heroicon::OutlinedTrash),
        ];
    }
}
