<?php

namespace App\Filament\Resources\MedicineStocks\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\MedicineStocks\MedicineStocksResource;

class ViewMedicineStocks extends ViewRecord
{
    protected static string $resource = MedicineStocksResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\MedicineStocks\Widgets\StockDetailStat::class,
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
