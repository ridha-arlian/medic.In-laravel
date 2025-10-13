<?php

namespace App\Filament\Resources\PatientLists\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientLists\PatientListResource;

class CreatePatientList extends CreateRecord
{
    protected static string $resource = PatientListResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
