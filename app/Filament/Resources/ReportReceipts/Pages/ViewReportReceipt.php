<?php

namespace App\Filament\Resources\ReportReceipts\Pages;

use App\Filament\Resources\ReportReceipts\ReportReceiptResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReportReceipt extends ViewRecord
{
    protected static string $resource = ReportReceiptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
