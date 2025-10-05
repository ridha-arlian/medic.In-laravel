<?php

namespace App\Filament\Resources\MedicineStocks\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MedicineStocks\MedicineStocksResource;

class ListMedicineStocks extends ListRecords
{
    protected static string $resource = MedicineStocksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->label('Add New Stock'),
        ];
    }
}
