<?php

namespace App\Filament\Resources\MedicineStocks\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MedicineStocks\MedicineStocksResource;

class CreateMedicineStocks extends CreateRecord
{
    protected static string $resource = MedicineStocksResource::class;

    protected static bool $canCreateAnother = true;
}