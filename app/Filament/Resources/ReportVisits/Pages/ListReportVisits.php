<?php

namespace App\Filament\Resources\ReportVisits\Pages;

use App\Filament\Resources\ReportVisits\ReportVisitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReportVisits extends ListRecords
{
    protected static string $resource = ReportVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
