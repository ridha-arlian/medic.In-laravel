<?php

namespace App\Filament\Resources\DokterManages\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Resources\DokterManages\DokterManageResource;

class ListDokterManages extends ListRecords
{
    protected static string $resource = DokterManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->icon(Heroicon::OutlinedPlus)
                ->modalHeading('Add New Doctor Account')
                ->label('Add')
                ->steps([
                    Step::make('Account Information')
                        ->description('Setup the account details.')
                        ->schema([
                            TextInput::make('name')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required(),
                            TextInput::make('role_display')
                                ->default('Doctor')
                                ->label('Role')
                                ->disabled()
                                ->dehydrated(false),
                            TextInput::make('password')
                                ->password()
                                ->dehydrateStateUsing(callback: fn(string $state): string => Hash::make($state))
                                ->dehydrated(condition: fn(?string $state): bool => filled(value: $state))
                                ->required(condition: fn(string $operation): bool => $operation === 'create')
                                ->maxLength(255)
                                ->revealable(),
                        ])
                        ->columns(2),
                    Step::make('Additional Information')
                        ->description('Setup the additional details for the Doctor.')
                        ->schema([
                            TextInput::make('str_number')
                                ->label('STR Number (Surat Tanda Registrasi)')
                                ->required()
                                ->rule('unique:dokters,str_number')
                                ->maxLength(255),
                            Select::make('specialization_id')
                                ->label('Specialization')
                                ->options(\App\Models\Specialization::where('is_active', true)
                                    ->pluck('name', 'id'))
                                ->required()
                                ->searchable()
                                ->placeholder('Select Specialization'),
                            TextInput::make('consultation_fee')
                                ->label('Consultation Fee')
                                ->numeric()
                                ->minValue(0)
                                ->prefix('Rp')
                                ->required(),
                            TextInput::make('phone_number')
                                ->label('Phone Number')
                                ->tel()
                                ->telRegex('/^(?:\+62|62|0)[0-9]{8,13}$/')
                                ->required()
                                ->maxLength(20),
                            Textarea::make('address')
                                ->label('Full Address')
                                ->required()
                                ->rows(3)
                                ->columnSpanFull(),
                        ])->columns(2),
                ])
                ->after(function ($record, array $data) {
                    $record->syncRoles(['dokter']);

                    $record->dokter()->create([
                        'str_number'   => $data['str_number'],
                        'specialization_id' => $data['specialization_id'],
                        'consultation_fee' => $data['consultation_fee'],
                        'phone_number' => $data['phone_number'],
                        'address'      => $data['address'],
                    ]);
                }),
        ];
    }
}