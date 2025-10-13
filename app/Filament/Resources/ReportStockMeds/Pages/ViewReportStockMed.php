<?php

namespace App\Filament\Resources\ReportStockMeds\Pages;

use App\Filament\Resources\ReportStockMeds\ReportStockMedResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReportStockMed extends ViewRecord
{
    protected static string $resource = ReportStockMedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
