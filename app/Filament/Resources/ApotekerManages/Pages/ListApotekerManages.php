<?php

namespace App\Filament\Resources\ApotekerManages\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Resources\ApotekerManages\ApotekerManageResource;

class ListApotekerManages extends ListRecords
{
    protected static string $resource = ApotekerManageResource::class;
        
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon(Heroicon::OutlinedPlus)
                ->modalHeading('Add New Pharmacist Account')
                ->createAnother(false)
                ->label('Add')
                ->steps([
                    Step::make('Account Information')
                        ->description('Setup the account details.')
                        ->schema([
                            TextInput::make('name')
                                ->required(),
                            TextInput::make('email')
                                ->label('email address')
                                ->email()
                                ->required(),
                            TextInput::make('role_display')
                                ->default('Pharmacist')
                                ->label('Role')
                                ->disabled()
                                ->dehydrated(false),
                            TextInput::make('password')
                                ->password()
                                ->dehydrateStateUsing(callback: fn(string $state): string => Hash::make($state))
                                ->dehydrated(condition: fn(?string $state): bool => filled(value: $state))
                                ->required(condition: fn(string $operation): bool => $operation === 'create')
                                ->minLength(8)
                                ->maxLength(255)
                                ->revealable(),
                        ])
                        ->columns(2),
                    Step::make('Additional Information')
                        ->description('Setup the additional details for the Pharmacist.')
                        ->schema([
                            TextInput::make('stra_number')
                                ->label('STRA Number (Surat Tanda Registrasi Apoteker)')
                                ->required()
                                ->rule('unique:apotekers,stra_number')
                                ->maxLength(255),
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
                    ])
                    ->columns(2),
            ])
                ->after(function ($record, array $data) {
                    $record->syncRoles(['apoteker']);

                    $record->apoteker()->create([
                        'stra_number'  => $data['stra_number'],
                        'phone_number' => $data['phone_number'],
                        'address'      => $data['address'],
                    ]);
                }),
    
        ];
    }
}