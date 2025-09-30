<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class UsersForm
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
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
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
