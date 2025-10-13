<?php

namespace App\Filament\Resources\ApotekerManages\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Infolists\Components\TextEntry;

class ApotekerManagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'apoteker' => 'Pharmacist',
                        default => $state,
                    }),
                TextColumn::make('email')
                    ->label('Email Address'),
                TextColumn::make('apoteker.stra_number')
                    ->label('STRA Number'),
                TextColumn::make('apoteker.phone_number')
                    ->label('Phone Number'),
                TextColumn::make('apoteker.address')
                    ->label('Address')
                    ->limit(50)
                    ->wrap(),
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
                    }),
                ToggleColumn::make('is_active')
                    ->label('Account Status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->afterStateUpdated(function ($record, $state) {
                        Notification::make()
                            ->title('Account Status Updated')
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
                                            ->helperText('Leave blank if you do not want to change the password')
                                            ->revealable(),
                                    ])
                                    ->columns(2),
                                Section::make('Additional Information')
                                    ->schema([
                                        TextInput::make('apoteker.stra_number')
                                            ->label('STRA Number')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('apoteker.phone_number')
                                            ->label('Phone Number')
                                            ->tel()
                                            ->required()
                                            ->maxLength(20),
                                        Textarea::make('apoteker.address')
                                            ->label('Address')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                Section::make('Status Information')
                                    ->schema([
                                        Select::make('status')
                                            ->label('Pharmacist Status')
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

                                if (isset($data['apoteker'])) {
                                    $record->apoteker()->updateOrCreate(
                                        ['user_id' => $record->id],
                                        [
                                            'stra_number' => $data['apoteker']['stra_number'],
                                            'phone_number' => $data['apoteker']['phone_number'],
                                            'address' => $data['apoteker']['address'],
                                        ]
                                    );
                                }

                                return $record;
                            })
                            ->successNotification(
                                Notification::make()
                                    ->success()
                                    ->title('Pharmacist Data Successfully Updated')
                                    ->body('The Pharmacist information has been successfully updated.')
                            ),
                        ViewAction::make()
                            ->modalHeading(fn ($record) => 'Pharmacist Details: ' . $record->name)
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
                                                'apoteker' => 'Pharmacist',
                                                default => $state,
                                            }),
                                        TextEntry::make('is_active')
                                            ->label('Account Status')
                                            ->badge()
                                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                                            ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Inactive'),
                                        ])
                                    ->columns(2),

                                Section::make('Additional Information')
                                    ->schema([
                                        TextEntry::make('apoteker.stra_number')
                                            ->label('STRA Number'),
                                        TextEntry::make('apoteker.phone_number')
                                            ->label('Phone Number'),
                                        TextEntry::make('apoteker.address')
                                            ->label('Address')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Status Information')
                                    ->schema([
                                        TextEntry::make('status')
                                            ->label('Status Pharmacist')
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
                                ->title('Pharmacist Deleted')
                                ->body('The Pharmacist has been successfully deleted.')
                        )
                        ->requiresConfirmation()
                        ->modalHeading('Delete Pharmacist')
                        ->modalDescription('Are you sure you want to delete this pharmacist? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Pharmacists Deleted')
                            ->body('The selected pharmacists have been successfully deleted.')
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Pharmacists')
                    ->modalDescription('Are you sure you want to delete the selected pharmacists? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ]);
    }
}