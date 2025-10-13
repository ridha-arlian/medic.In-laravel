<?php

namespace App\Filament\Resources\Specializations\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Components\Grid;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Infolists\Components\TextEntry;

class SpecializationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Specialization Name'),
                TextColumn::make('code')
                    ->label('Specialization Code'),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->wrap(),
                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->afterStateUpdated(function ($record, $state) {
                        Notification::make()
                            ->title('Account Status Updated')
                            ->body("Specialization {$record->name} has been " . ($state ? 'enabled' : 'disabled'))
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make()
                            ->modalHeading(fn ($record) => 'Edit Specialization ' . $record->name . ' Details')
                            ->modalDescription(fn ($record) => 'Update detailed information about the ' . $record->name . ' specialization')
                            ->schema([
                                Section::make()
                                    ->columnSpanFull()
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Specialization Name')
                                                    ->required()
                                                    ->maxLength(255),
                                                TextInput::make('code')
                                                    ->label('Specialization Code')
                                                    ->placeholder('Will be automatically generated upon creation')
                                                    ->disabled()
                                                    ->dehydrated(false),                                    
                                            ]),
                                        Textarea::make('description')
                                            ->label('Description')
                                            ->maxLength(65535)
                                            ->placeholder('Enter description')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        ViewAction::make()
                            ->modalHeading(fn ($record) => 'Specialization Details: ' . $record->name)
                            ->modalDescription(fn ($record) => 'Detailed information about the ' . $record->name . ' specialization')
                            ->schema([
                                Section::make('Specialization Information')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextEntry::make('name')
                                                    ->label('Specialization Name'),
                                                TextEntry::make('code')
                                                    ->label('Code'),
                                            ]),
                                        TextEntry::make('description')
                                            ->label('Description')
                                            ->columnSpanFull(),
                                    ]),
                                
                                Section::make('Status Information')
                                    ->schema([
                                        TextEntry::make('is_active')
                                            ->label('Status')
                                            ->badge()
                                            ->color(fn (bool $state): string => match ($state) {
                                                true => 'success',
                                                false => 'danger'
                                            })
                                            ->formatStateUsing(fn (bool $state): string => match ($state) {
                                                true => 'Active',
                                                false => 'Inactive'
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
                                ->title('Specialization Deleted')
                                ->body('The Specialization has been successfully deleted.')
                        )
                        ->requiresConfirmation()
                        ->modalHeading('Delete Specialization')
                        ->modalDescription('Are you sure you want to delete this specialization? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Specializations Deleted')
                            ->body('The selected specializations have been successfully deleted.')
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Specializations')
                    ->modalDescription('Are you sure you want to delete the selected specializations? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ]);
    }
}