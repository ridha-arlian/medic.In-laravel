<?php

namespace App\Filament\Resources\ReportVisits\Pages;

use App\Filament\Resources\ReportVisits\ReportVisitResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReportVisit extends EditRecord
{
    protected static string $resource = ReportVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
