<?php

namespace App\Filament\Apoteker\Resources\MedicineStocks\Pages;

use App\Filament\Apoteker\Resources\MedicineStocks\MedicineStocksResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

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
