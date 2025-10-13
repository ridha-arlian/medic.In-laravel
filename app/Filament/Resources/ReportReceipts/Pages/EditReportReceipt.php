<?php

namespace App\Filament\Resources\ReportReceipts\Pages;

use App\Filament\Resources\ReportReceipts\ReportReceiptResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReportReceipt extends EditRecord
{
    protected static string $resource = ReportReceiptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
