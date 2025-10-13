<?php

namespace App\Filament\Resources\ReportStockMeds;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\ReportStockMed;
use Filament\Resources\Resource;
use App\Filament\Resources\ReportStockMeds\Pages\EditReportStockMed;
use App\Filament\Resources\ReportStockMeds\Pages\ViewReportStockMed;
use App\Filament\Resources\ReportStockMeds\Pages\ListReportStockMeds;
use App\Filament\Resources\ReportStockMeds\Pages\CreateReportStockMed;
use App\Filament\Resources\ReportStockMeds\Schemas\ReportStockMedForm;
use App\Filament\Resources\ReportStockMeds\Tables\ReportStockMedsTable;
use App\Filament\Resources\ReportStockMeds\Schemas\ReportStockMedInfolist;

class ReportStockMedResource extends Resource
{
    protected static ?string $model = ReportStockMed::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Report Stock Medicines';

    protected static string | \BackedEnum | null $navigationIcon = 'uni-file-medical-o';

    public static function form(Schema $schema): Schema
    {
        return ReportStockMedForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReportStockMedInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReportStockMedsTable::configure($table);
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
            'index' => ListReportStockMeds::route('/'),
            // 'create' => CreateReportStockMed::route('/create'),
            // 'view' => ViewReportStockMed::route('/{record}'),
            // 'edit' => EditReportStockMed::route('/{record}/edit'),
        ];
    }
}
