<?php

namespace App\Filament\Resources\Suppliers\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Suppliers\SuppliersResource;

class ListSuppliers extends ListRecords
{
    public static string $resource = SuppliersResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\Suppliers\Widgets\StatsSupplier::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add')
                ->icon(Heroicon::OutlinedPlus)
                ->modalHeading('Add New Supplier')
                ->createAnother(false)
                ->schema([
                    Section::make()
                        ->columnSpanFull()
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Supplier Name')
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('Enter supplier name'),
                                    TextInput::make('contact_person')
                                        ->label('Contact Person')
                                        ->maxLength(255)
                                        ->placeholder('Enter contact person name'),
                                    TextInput::make('phone')
                                        ->label('Phone Number')
                                        ->tel()
                                        ->telRegex('/^(?:\+62|62|0)[0-9]{8,13}$/')
                                        ->required()
                                        ->maxLength(20)
                                        ->placeholder('Enter phone number'),
                                    TextInput::make('email')
                                        ->label('Email Address')
                                        ->email()
                                        ->maxLength(255)
                                        ->placeholder('Enter email address'),
                                    Select::make('status')
                                        ->label('Status')
                                        ->options([
                                            'aktif' => 'Active',
                                            'nonaktif' => 'Inactive',
                                        ])
                                        ->required()
                                        ->placeholder('Select status'),
                                ]),
                            Textarea::make('address')
                                ->label('Address')
                                ->maxLength(500)
                                ->placeholder('Enter address')
                                ->rows(3)
                                ->columnSpanFull(),
                        ]),
                ]),
        ];
    }
}