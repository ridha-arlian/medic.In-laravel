<?php

namespace App\Filament\Resources\PatientLists;

use Filament\Tables\Table;
use App\Models\PatientList;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PatientLists\Pages\ViewPatientList;
use App\Filament\Resources\PatientLists\Pages\EditPatientList;
use App\Filament\Resources\PatientLists\Pages\ListPatientLists;
use App\Filament\Resources\PatientLists\Pages\CreatePatientList;
use App\Filament\Resources\PatientLists\Schemas\PatientListForm;
use App\Filament\Resources\PatientLists\Tables\PatientListsTable;
use App\Filament\Resources\PatientLists\Schemas\PatientListInfolist;

class PatientListResource extends Resource
{
    protected static ?string $model = PatientList::class;

    protected static ?string $modelLabel = 'Patient';

    protected static ?string $pluralModelLabel = 'Patients';

    protected static string | \UnitEnum | null $navigationGroup = 'Patient Data';

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return PatientListForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PatientListInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PatientListsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('drugAllergies.medicineStock');
    }

    public static function getRecordSlug(): string
    {
        return 'medical_record_number';
    }

    public static function getRecordRouteKeyName(): ?string
    {
        return 'medical_record_number';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPatientLists::route('/'),
            'create' => CreatePatientList::route('/create'),
            'view' => ViewPatientList::route('/{record:medical_record_number}'),
            'edit' => EditPatientList::route('/{record:medical_record_number}/edit'),
        ];
    }
}