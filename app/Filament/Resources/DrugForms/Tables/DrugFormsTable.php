<?php

namespace App\Filament\Resources\DrugForms\Tables;

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

class DrugFormsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Drug Form Type'),
                TextColumn::make('code')
                    ->label('Code'),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->wrap(),
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
                            ->modalDescription(fn ($record) => 'Update detailed information about the ' . $record->name)
                            ->schema([
                                Section::make()
                                    ->columnSpanFull()
                                    ->schema([
                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Drug Form Name')
                                                    ->required()
                                                    ->maxLength(255),
                                                TextInput::make('code')
                                                    ->label('Code')
                                                    ->required()
                                                    ->maxLength(50),
                                                Select::make('status')
                                                    ->label('Status')
                                                    ->options([
                                                        'aktif' => 'Active',
                                                        'nonaktif' => 'Inactive',
                                                    ])
                                                    ->required()
                                                    ->placeholder('Select status'),
                                    
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
                            ->modalHeading(fn ($record) => 'Drug Form Details: ' . $record->name)
                            ->modalDescription(fn ($record) => 'Detailed information about the ' . $record->name)
                            ->schema([
                                Section::make('Drug Form Information')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextEntry::make('name')
                                                    ->label('Drug Form Name'),
                                                TextEntry::make('code')
                                                    ->label('Code'),
                                            ]),
                                        TextEntry::make('description')
                                            ->label('Description')
                                            ->columnSpanFull(),
                                    ]),
                                
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
                                ->title('Drug Form Deleted')
                                ->body('The Drug Form has been successfully deleted.')
                        )
                        ->requiresConfirmation()
                        ->modalHeading('Delete Drug Form')
                        ->modalDescription('Are you sure you want to delete this drug form? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Drug Forms Deleted')
                            ->body('The selected drug forms have been successfully deleted.')
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Drug Forms')
                    ->modalDescription('Are you sure you want to delete the selected drug forms? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ]);
    }
}