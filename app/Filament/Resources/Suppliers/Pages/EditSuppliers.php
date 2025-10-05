<?php

namespace App\Filament\Resources\Suppliers\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Suppliers\SuppliersResource;

class EditSuppliers extends EditRecord
{
    protected static string $resource = SuppliersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}