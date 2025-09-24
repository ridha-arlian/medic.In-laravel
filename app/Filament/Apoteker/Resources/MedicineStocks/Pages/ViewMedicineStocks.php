<?php

namespace App\Filament\Apoteker\Resources\MedicineStocks\Pages;

use App\Filament\Apoteker\Resources\MedicineStocks\MedicineStocksResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMedicineStocks extends ViewRecord
{
    protected static string $resource = MedicineStocksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
