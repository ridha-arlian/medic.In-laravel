<?php

namespace App\Filament\Resources\Specializations\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Specializations\SpecializationsResource;

class ListSpecializations extends ListRecords
{
    protected static string $resource = SpecializationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add')
                ->icon(Heroicon::OutlinedPlus)
                ->modalHeading('Add New Specialization')
                ->createAnother(false)
                ->schema([
                    Section::make()
                        ->columnSpanFull()
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Specialization Name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('code')
                                        ->label('Specialization Code')
                                        ->placeholder('Will be automatically generated upon creation')
                                        ->disabled()
                                        ->dehydrated(false),
                                ]),
                            Textarea::make('description')
                                ->label('Description')
                                ->maxLength(65535)
                                ->placeholder('Enter description')
                                ->rows(3)
                                ->columnSpanFull(),
                        ]),
                ]),
        ];
    }
}
