<?php

namespace App\Filament\Resources\ReportStockMeds\Pages;

use App\Filament\Resources\ReportStockMeds\ReportStockMedResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReportStockMeds extends ListRecords
{
    protected static string $resource = ReportStockMedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
