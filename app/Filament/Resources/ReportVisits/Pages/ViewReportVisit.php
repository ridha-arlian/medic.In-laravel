<?php

namespace App\Filament\Resources\ReportVisits\Pages;

use App\Filament\Resources\ReportVisits\ReportVisitResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReportVisit extends ViewRecord
{
    protected static string $resource = ReportVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
