<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SuppliersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Medicine Name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter medicine name'),
                TextInput::make('contact_person')
                    ->label('Contact Person')
                    ->maxLength(255)
                    ->placeholder('Enter contact person name'),
                TextInput::make('phone')
                    ->label('Phone')
                    ->numeric()
                    ->placeholder('Enter phone number'),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255)
                    ->placeholder('Enter email address'),
                TextInput::make('address')
                    ->label('Address')
                    ->maxLength(500)
                    ->placeholder('Enter address'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->required()
                    ->placeholder('Select status'),
            ]);
    }
}