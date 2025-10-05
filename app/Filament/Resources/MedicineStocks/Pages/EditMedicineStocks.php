<?php

namespace App\Filament\Resources\MedicineStocks\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\MedicineStocks\MedicineStocksResource;

class EditMedicineStocks extends EditRecord
{
    protected static string $resource = MedicineStocksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
