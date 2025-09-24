<?php

namespace App\Filament\Apoteker\Resources\MedicineStocks\Pages;

use App\Filament\Apoteker\Resources\MedicineStocks\MedicineStocksResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMedicineStocks extends ListRecords
{
    protected static string $resource = MedicineStocksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->disableCreateAnother()
                ->label('Add New Stock'),
        ];
    }
}
