<?php

namespace App\Filament\Resources\AdminManages\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Infolists\Components\TextEntry;

class AdminManagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->label('Full Name'),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'super_admin' => 'Super Admin',
                        default => $state,
                    }),
                TextColumn::make('email')
                    ->label('Email Address'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'cuti' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'cuti' => 'Leave',
                        default => $state,
                    }),
                ToggleColumn::make('is_active')
                    ->label('Status Account')
                    ->onColor('success')
                    ->offColor('danger')
                    ->afterStateUpdated(function ($record, $state) {
                        Notification::make()
                            ->title('Status Account Updated')
                            ->body("Account {$record->name} has been " . ($state ? 'activated' : 'deactivated'))
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
                            ->modalHeading(fn ($record) => 'Edit ' . $record->name . ' Details')
                            ->modalDescription(fn ($record) => 'Update detailed information about the ' . $record->name . ' account.')
                            ->schema([
                                Section::make('Account Information')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Full Name')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('email')
                                            ->label('Email Address')
                                            ->email()
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('password')
                                            ->label('New Password')
                                            ->password()
                                            ->dehydrateStateUsing(fn(?string $state): ?string => filled($state) ? Hash::make($state) : null)
                                            ->dehydrated(fn(?string $state): bool => filled($state))
                                            ->helperText('Leave blank if you don\'t want to change the password')
                                            ->revealable()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Status Information')
                                    ->schema([
                                        Select::make('status')
                                            ->label('Administrator Status')
                                            ->options([
                                                'active' => 'Active',
                                                'inactive' => 'Inactive',
                                                'cuti' => 'Leave',
                                            ])
                                            ->required()
                                            ->native(false),
                                    ])
                                    ->columns(1),
                            ])
                            ->using(function ($record, array $data): mixed {
                                $userData = [
                                    'name' => $data['name'],
                                    'email' => $data['email'],
                                    'status' => $data['status'],
                                ];
                                
                                if (!empty($data['password'])) {
                                    $userData['password'] = $data['password'];
                                }
                                
                                $record->update($userData);

                                return $record;
                            })
                            ->successNotification(
                                Notification::make()
                                    ->success()
                                    ->title('Administrator Data Successfully Updated')
                                    ->body('The Administrator information has been successfully updated.')
                            ),
                        ViewAction::make()
                            ->modalHeading(fn ($record) => 'Administrator Details: ' . $record->name)
                            ->modalDescription(fn ($record) => 'Detailed information about the ' . $record->name . ' account.')
                            ->schema([
                                Section::make('Account Information')
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Full Name'),
                                        TextEntry::make('email')
                                            ->label('Email Address'),
                                        TextEntry::make('roles.name')
                                            ->label('Role')
                                            ->badge()
                                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                                'super_admin' => 'Super Admin',
                                                default => $state,
                                            }),
                                        TextEntry::make('is_active')
                                            ->label('Account Status')
                                            ->badge()
                                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                                            ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Inactive'),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Status Information')
                                    ->schema([
                                        TextEntry::make('status')
                                            ->label('Status Administrator')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'active' => 'success',
                                                'inactive' => 'danger',
                                                'cuti' => 'warning',
                                            })
                                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                                'active' => 'Active',
                                                'inactive' => 'Inactive',
                                                'cuti' => 'Leave',
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
                                ->title('Administrator Deleted')
                                ->body('The Administrator has been successfully deleted.')
                        )
                        ->requiresConfirmation()
                        ->modalHeading('Delete Administrator')
                        ->modalDescription('Are you sure you want to delete this administrator? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ])
            ])
            ->toolbarActions([
                    DeleteBulkAction::make()
                    ->label('Delete Selected All')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Administrators Deleted')
                            ->body('The selected administrators have been successfully deleted.')
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Administrators')
                    ->modalDescription('Are you sure you want to delete the selected administrators? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ]);
    }
}