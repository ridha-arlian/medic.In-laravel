<?php

namespace App\Filament\Resources\DokterManages\Tables;

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

class DokterManagesTable
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
                        'dokter' => 'Doctor',
                        default => $state,
                    }),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Email Address'),
                TextColumn::make('dokter.specialization.name')
                    ->searchable()
                    ->label('Specialization'),
                TextColumn::make('dokter.str_number')
                        ->label('STR Number'),
                TextColumn::make('dokter.consultation_fee')
                    ->label('Consultation Fee')
                    ->money('IDR', true),
                TextColumn::make('dokter.phone_number')
                    ->label('Phone Number'),
                TextColumn::make('dokter.address')
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
                                        TextInput::make('dokter.str_number')
                                            ->label('STR Number')
                                            ->required()
                                            ->maxLength(255),
                                        Select::make('dokter.specialization_id')
                                            ->label('Specialization')
                                            ->options(\App\Models\Specialization::where('is_active', true)
                                                ->pluck('name', 'id'))
                                            ->required()
                                            ->searchable()
                                            ->preload(),
                                        TextInput::make('dokter.consultation_fee')
                                            ->label('Consultation Fee')
                                            ->numeric()
                                            ->prefix('Rp')
                                            ->required(),
                                        TextInput::make('dokter.phone_number')
                                            ->label('Phone Number')
                                            ->tel()
                                            ->required()
                                            ->maxLength(20),
                                        Textarea::make('dokter.address')
                                            ->label('Address')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                Section::make('Status Information')
                                    ->schema([
                                        Select::make('status')
                                            ->label('Doctor Status')
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

                                if (isset($data['dokter'])) {
                                    $record->dokter()->updateOrCreate(
                                        ['user_id' => $record->id],
                                        [
                                            'str_number' => $data['dokter']['str_number'],
                                            'specialization_id' => $data['dokter']['specialization_id'],
                                            'consultation_fee' => $data['dokter']['consultation_fee'],
                                            'phone_number' => $data['dokter']['phone_number'],
                                            'address' => $data['dokter']['address'],
                                        ]
                                    );
                                }

                                return $record;
                            })
                            ->successNotification(
                                Notification::make()
                                    ->success()
                                    ->title('Doctor Data Successfully Updated')
                                    ->body('The Doctor information has been successfully updated.')
                            ),
                        ViewAction::make()
                            ->modalHeading(fn ($record) => 'Doctor Details: ' . $record->name)
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
                                                'dokter' => 'Doctor',
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
                                        TextEntry::make('dokter.str_number')
                                            ->label('STR Number'),
                                        TextEntry::make('dokter.specialization.name')
                                            ->label('Specialization'),
                                        TextEntry::make('dokter.consultation_fee')
                                            ->label('Consultation Fee')
                                            ->money('IDR', divideBy: 1, decimalPlaces: 0),
                                        TextEntry::make('dokter.phone_number')
                                            ->label('Phone Number'),
                                        TextEntry::make('dokter.address')
                                            ->label('Address')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                
                                Section::make('Status Information')
                                    ->schema([
                                        TextEntry::make('status')
                                            ->label('Doctor Status')
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
                                ->title('Doctor Deleted')
                                ->body('The Doctor has been successfully deleted.')
                        )
                        ->requiresConfirmation()
                        ->modalHeading('Delete Doctor')
                        ->modalDescription('Are you sure you want to delete this doctor? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete'),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Doctors Deleted')
                            ->body('The selected doctors have been successfully deleted.')
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Doctors')
                    ->modalDescription('Are you sure you want to delete the selected doctors? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete'),
            ]);
    }
}