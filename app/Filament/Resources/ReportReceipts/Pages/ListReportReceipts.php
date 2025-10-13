<?php

namespace App\Filament\Resources\ReportReceipts\Pages;

use App\Filament\Resources\ReportReceipts\ReportReceiptResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReportReceipts extends ListRecords
{
    protected static string $resource = ReportReceiptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
