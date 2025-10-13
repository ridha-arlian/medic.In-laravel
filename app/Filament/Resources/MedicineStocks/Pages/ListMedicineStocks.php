<?php

namespace App\Filament\Resources\MedicineStocks\Pages;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\MedicineStocks\MedicineStocksResource;

class ListMedicineStocks extends ListRecords
{
    protected static string $resource = MedicineStocksResource::class;

    protected $listeners = ['link-allergies-to-stock' => 'linkAllergiesToStock'];

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add')
                ->icon(Heroicon::OutlinedPlus)
                ->modalHeading('Add New Medicine Stock')
                ->createAnother(false)
                ->schema([
                    Section::make('Medicine Information')
                        ->description('Enter the basic medicine information')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Medicine Name')
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('Enter medicine name')
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function ($state) {
                                            if (! $state) return;

                                            $relatedAllergies = \App\Models\PatientDrugAllergy::whereNull('medicine_stock_id')
                                                ->where('custom_medicine_name', 'LIKE', "%{$state}%")
                                                ->with('patient')
                                                ->get();

                                            if ($relatedAllergies->isNotEmpty()) {
                                                $count = $relatedAllergies->count();
                                                $sample = $relatedAllergies->pluck('patient.full_name')->take(3)->join(', ');
                                                Notification::make()
                                                    ->title("{$count} allergy record(s) found matching this medicine name.")
                                                    ->body("Linked to patients: {$sample}" . ($count > 3 ? ', ...' : ''))
                                                    ->success()
                                                    ->send();
                                            }
                                        }),
                                    TextInput::make('batch_id')
                                        ->label('Batch ID')
                                        ->required()
                                        ->placeholder('Enter batch ID'),
                                    TextInput::make('medicine_stocks_id')
                                        ->label('Medicine Stock ID')
                                        ->placeholder('Will be automatically generated')
                                        ->disabled()
                                        ->dehydrated(false),
                                ]),
                        ]),

                    Section::make('Stock & Pricing')
                        ->description('Manage stock quantity and pricing details')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('quantity')
                                        ->label('Stock Quantity')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->placeholder('Enter stock quantity'),
                                    TextInput::make('price')
                                        ->label('Price')
                                        ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('Rp')
                                        ->placeholder('Enter price'),
                                    DatePicker::make('expired_date')
                                        ->label('Expired Date')
                                        ->required()
                                        ->placeholder('Select expired date'),
                                ]),
                        ]),

                    Section::make('Classification')
                        ->description('Select medicine type, category, and supplier')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    Select::make('medicine_types_id')
                                        ->label('Medicine Type')
                                        ->options(\App\Models\MedicineType::where('status', 'aktif')
                                            ->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->placeholder('Select Medicine Type'),
                                    Select::make('medicine_categories_id')
                                        ->label('Medicine Category')
                                        ->options(\App\Models\MedicineCategory::where('status', 'aktif')
                                            ->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->placeholder('Select Medicine Category'),
                                    Select::make('medicine_suppliers_id')
                                        ->label('Supplier')
                                        ->options(\App\Models\MedicineSupplier::where('status', 'aktif')
                                            ->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->placeholder('Select Supplier'),
                                ]),
                        ]),
                ])
                ->after(function ($record) {
                    $relatedAllergies = \App\Models\PatientDrugAllergy::whereNull('medicine_stock_id')
                        ->where('custom_medicine_name', 'LIKE', "%{$record->name}%")
                        ->with('patient')
                        ->get();

                    if ($relatedAllergies->isNotEmpty()) {
                        $count = $relatedAllergies->count();
                        $sample = $relatedAllergies->pluck('patient.full_name')->take(3)->join(', ');

                        Notification::make()
                            ->title("{$count} allergy record(s) found matching this {$record->name}.")
                            ->body("Linked to patients: {$sample}" . ($count > 3 ? ', ...' : ''))
                            ->success()
                            ->actions([
                                Action::make('linkNow')
                                    ->label('Link Now')
                                    ->button()
                                    ->color('success')
                                    ->dispatch('link-allergies-to-stock', [$record->id, $record->name]),
                            ])
                            ->send();
                    }
                })
        ];
    }

    public function linkAllergiesToStock($stockId, $stockName)
    {
        $updated = \App\Models\PatientDrugAllergy::whereNull('medicine_stock_id')
            ->where('custom_medicine_name', 'LIKE', "%{$stockName}%")
            ->update(['medicine_stock_id' => $stockId]);

        if ($updated > 0) {
            Notification::make()
                ->title("Successfully linked {$updated} allergy record(s) to '{$stockName}'")
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title("No allergy record(s) found matching '{$stockName}'")
                ->warning()
                ->send();
        }
    }
}