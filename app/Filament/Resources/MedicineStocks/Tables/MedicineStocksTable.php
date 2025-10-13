<?php

namespace App\Filament\Resources\MedicineStocks\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class MedicineStocksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->searchable()
            ->emptyStateHeading('Stocks not avalailable')
            ->columns([
                TextColumn::make('medicine_stocks_id')
                    ->label('Stock ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('batch_id')
                    ->label('Batch ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Medicine Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Stock Quantity')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR', decimalPlaces: 0),
                TextColumn::make('expired_date')
                    ->label('Expired Date')
                    ->date('d M, Y'),
                TextColumn::make('medicine_types.name')
                    ->label('Medicine Type'),
                TextColumn::make('medicine_categories.name')
                    ->label('Medicine Category'),
                TextColumn::make('medicine_suppliers.name')
                    ->label('Supplier Name'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make()
                            ->modalHeading(fn ($record) => 'Edit ' . $record->name . ' Stock Details')
                            ->modalDescription(fn ($record) => 'Update detailed information about the ' . $record->name . ' stock')
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
                                                    ->placeholder('Enter medicine name'),
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
                            ]),
                        ViewAction::make()
                            
                    ])
                    ->dropdown(false),
                    DeleteAction::make()
                        ->label('Delete')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Medicine Stock Deleted')
                                ->body('The Medicine Stock has been successfully deleted.')
                        )
                        ->requiresConfirmation()
                        ->modalHeading('Delete Medicine Stock')
                        ->modalDescription('Are you sure you want to delete this medicine stock? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Medicine Stocks Deleted')
                            ->body('The selected medicine stocks have been successfully deleted.')
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Medicine Stocks')
                    ->modalDescription('Are you sure you want to delete the selected medicine stocks? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ]);
    }
}