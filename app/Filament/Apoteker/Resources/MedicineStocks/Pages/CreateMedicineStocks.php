<?php

namespace App\Filament\Apoteker\Resources\MedicineStocks\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Apoteker\Resources\MedicineStocks\MedicineStocksResource;

class CreateMedicineStocks extends CreateRecord
{
    protected static string $resource = MedicineStocksResource::class;
    
    protected static bool $canCreateAnother = true;
}
