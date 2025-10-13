<?php

namespace App\Filament\Resources\ReportStockMeds\Pages;

use App\Filament\Resources\ReportStockMeds\ReportStockMedResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReportStockMed extends EditRecord
{
    protected static string $resource = ReportStockMedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
