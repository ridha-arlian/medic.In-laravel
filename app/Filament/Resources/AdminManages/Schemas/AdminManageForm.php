<?php

namespace App\Filament\Resources\AdminManages\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class AdminManageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('email address')
                    ->email()
                    ->required(),
                Select::make('role_display')
                    ->label('Role')
                    ->options(['super_admin' => 'Super Admin'])
                    ->default('super_admin')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(callback: fn(string $state): string => Hash::make($state))
                    ->dehydrated(condition: fn(?string $state): bool => filled(value: $state))
                    ->required(condition: fn(string $operation): bool => $operation === 'create')
                    ->maxLength(255)
                    ->revealable(),
            ]);
    }
}