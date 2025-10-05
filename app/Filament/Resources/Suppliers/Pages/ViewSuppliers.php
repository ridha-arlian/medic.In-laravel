<?php

namespace App\Filament\Resources\Suppliers\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Suppliers\SuppliersResource;

class ViewSuppliers extends ViewRecord
{
    protected static string $resource = SuppliersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}