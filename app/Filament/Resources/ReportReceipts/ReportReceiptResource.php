<?php

namespace App\Filament\Resources\ReportReceipts;

use App\Models\ReportReceipt;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use App\Filament\Resources\ReportReceipts\Pages\ViewReportReceipt;
use App\Filament\Resources\ReportReceipts\Pages\EditReportReceipt;
use App\Filament\Resources\ReportReceipts\Pages\ListReportReceipts;
use App\Filament\Resources\ReportReceipts\Schemas\ReportReceiptForm;
use App\Filament\Resources\ReportReceipts\Pages\CreateReportReceipt;
use App\Filament\Resources\ReportReceipts\Tables\ReportReceiptsTable;
use App\Filament\Resources\ReportReceipts\Schemas\ReportReceiptInfolist;

class ReportReceiptResource extends Resource
{
    protected static ?string $model = ReportReceipt::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Report Receipts';

    protected static string | \BackedEnum | null $navigationIcon = 'ionicon-receipt-outline';

    public static function form(Schema $schema): Schema
    {
        return ReportReceiptForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReportReceiptInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReportReceiptsTable::configure($table);
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
            'index' => ListReportReceipts::route('/'),
            // 'create' => CreateReportReceipt::route('/create'),
            // 'view' => ViewReportReceipt::route('/{record}'),
            // 'edit' => EditReportReceipt::route('/{record}/edit'),
        ];
    }
}
