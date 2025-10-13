<?php

namespace App\Filament\Resources\ReportVisits;

use Filament\Tables\Table;
use App\Models\ReportVisit;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use App\Filament\Resources\ReportVisits\Pages\EditReportVisit;
use App\Filament\Resources\ReportVisits\Pages\ViewReportVisit;
use App\Filament\Resources\ReportVisits\Pages\ListReportVisits;
use App\Filament\Resources\ReportVisits\Pages\CreateReportVisit;
use App\Filament\Resources\ReportVisits\Schemas\ReportVisitForm;
use App\Filament\Resources\ReportVisits\Tables\ReportVisitsTable;
use App\Filament\Resources\ReportVisits\Schemas\ReportVisitInfolist;

class ReportVisitResource extends Resource
{
    protected static ?string $model = ReportVisit::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Report Visitors';

    protected static string | \BackedEnum | null $navigationIcon = 'fluentui-people-audience-20-o';

    public static function form(Schema $schema): Schema
    {
        return ReportVisitForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReportVisitInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReportVisitsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReportVisits::route('/'),
            // 'create' => CreateReportVisit::route('/create'),
            // 'view' => ViewReportVisit::route('/{record}'),
            // 'edit' => EditReportVisit::route('/{record}/edit'),
        ];
    }
}
