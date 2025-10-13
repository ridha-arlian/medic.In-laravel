<?php

namespace App\Filament\Resources\Suppliers\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->label('Supplier Name'),
                TextColumn::make('contact_person')
                    ->label('Contact Person'),
                TextColumn::make('phone')
                    ->label('Phone Number'),
                TextColumn::make('email')
                    ->label('Email Address'),
                TextColumn::make('address')
                    ->label('Address'),
                TextColumn::make('status')
                    ->label('Status')        
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'success',
                        'nonaktif' => 'danger'
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'aktif' => 'Active',
                        'nonaktif' => 'Inactive'
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make()
                            ->modalHeading(fn ($record) => 'Edit ' . $record->name . ' Details')
                            ->modalDescription(fn ($record) => 'Update detailed information about the supplier ' . $record->name)
                            ->schema([
                                Section::make()
                                    ->columnSpanFull()
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Supplier Name')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->placeholder('Enter supplier name'),
                                                TextInput::make('contact_person')
                                                    ->label('Contact Person')
                                                    ->maxLength(255)
                                                    ->placeholder('Enter contact person name'),
                                                TextInput::make('phone')
                                                    ->label('Phone Number')
                                                    ->tel()
                                                    ->telRegex('/^(?:\+62|62|0)[0-9]{8,13}$/')
                                                    ->required()
                                                    ->maxLength(20)
                                                    ->placeholder('Enter phone number'),
                                                TextInput::make('email')
                                                    ->label('Email Address')
                                                    ->email()
                                                    ->maxLength(255)
                                                    ->placeholder('Enter email address'),
                                                Select::make('status')
                                                    ->label('Status')
                                                    ->options([
                                                        'aktif' => 'Aktif',
                                                        'nonaktif' => 'Nonaktif',
                                                    ])
                                                    ->required()
                                                    ->placeholder('Select status'),
                                            ]),
                                        Textarea::make('address')
                                            ->label('Address')
                                            ->maxLength(500)
                                            ->placeholder('Enter address')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        ViewAction::make()
                            ->modalHeading(fn ($record) => 'Supplier Details: ' . $record->name)
                            ->modalDescription(fn ($record) => 'Detailed information about the supplier ' . $record->name)
                            ->schema([
                                Section::make('Supplier Information')
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Supplier Name'),
                                        TextEntry::make('contact_person')
                                            ->label('Contact Person'),
                                        TextEntry::make('phone')
                                            ->label('Phone Number'),
                                        TextEntry::make('email')
                                            ->label('Email Address'),
                                        TextEntry::make('address')
                                            ->label('Address'),
                                        ])
                                    ->columns(2),
                                
                                Section::make('Status Information')
                                    ->schema([
                                        TextEntry::make('status')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'aktif' => 'success',
                                                'nonaktif' => 'danger'
                                            })
                                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                                'aktif' => 'Active',
                                                'nonaktif' => 'Inactive'
                                            }),
                                        TextEntry::make('created_at')
                                            ->label('Registered Since')
                                            ->dateTime(),
                                        TextEntry::make('updated_at')
                                            ->label('Last Updated')
                                            ->dateTime(),
                                    ])
                                    ->columns(3),
                            ]),
                    ])->dropdown(false),
                    DeleteAction::make()
                        ->label('Delete')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Supplier Deleted')
                                ->body('The Supplier has been successfully deleted.')
                        )
                        ->requiresConfirmation()
                        ->modalHeading('Delete Supplier')
                        ->modalDescription('Are you sure you want to delete this supplier? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Suppliers Deleted')
                            ->body('The selected suppliers have been successfully deleted.')
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Suppliers')
                    ->modalDescription('Are you sure you want to delete the selected suppliers? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ]);
    }
}