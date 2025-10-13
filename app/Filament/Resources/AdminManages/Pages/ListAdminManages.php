<?php

namespace App\Filament\Resources\AdminManages\Pages;

use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Hash;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AdminManages\AdminManageResource;

class ListAdminManages extends ListRecords
{
    protected static string $resource = AdminManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add')
                ->icon(Heroicon::OutlinedPlus)
                ->modalHeading('Add New Administrator Account')
                ->createAnother(false)
                ->schema([
                    Section::make('Account Information')
                        ->description('Setup the account details.')
                        ->schema([
                            TextInput::make('name')
                                ->label('Full Name')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Enter Full Name'),
                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255)
                                ->placeholder('example@example.com'),
                            TextInput::make('role_display')
                                ->default('Super Admin')
                                ->label('Role')
                                ->disabled()
                                ->dehydrated(false),
                            TextInput::make('password')
                                ->label('Password')
                                ->password()
                                ->dehydrateStateUsing(callback: fn(string $state): string => Hash::make($state))
                                ->dehydrated(condition: fn(?string $state): bool => filled(value: $state))
                                ->required(condition: fn(string $operation): bool => $operation === 'create')
                                ->minLength(8)
                                ->maxLength(255)
                                ->revealable(),
                        ])
                        ->columns(2),
                    Section::make('Status Information')
                        ->description('Set the account status.')
                        ->schema([
                            Select::make('status')
                                ->label('Administrator Status')
                                ->options([
                                    'active' => 'Active',
                                    'inactive' => 'Inactive',
                                    'cuti' => 'Leave',
                                ])
                                ->default('active')
                                ->required()
                                ->native(false),
                        ])
                        ->columnSpanFull(),
                ])
                ->after(function ($record) {
                    $record->syncRoles(['super_admin']);
                }),
        ];
    }
}