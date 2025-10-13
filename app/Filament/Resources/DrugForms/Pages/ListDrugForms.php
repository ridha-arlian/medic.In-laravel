<?php

namespace App\Filament\Resources\DrugForms\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DrugForms\DrugFormsResource;

class ListDrugForms extends ListRecords
{
    protected static string $resource = DrugFormsResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\DrugForms\Widgets\DrugFormsStat::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add')
                ->icon(Heroicon::OutlinedPlus)
                ->modalHeading('Add New Drug Form')
                ->createAnother(false)
                ->schema([
                    Section::make()
                        ->columnSpanFull()
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Drug Form Name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('code')
                                        ->label('Code')
                                        ->required()
                                        ->maxLength(50),
                                    Select::make('status')
                                        ->label('Status')
                                        ->options([
                                            'aktif' => 'Active',
                                            'nonaktif' => 'Inactive',
                                        ])
                                        ->required()
                                        ->placeholder('Select status'),
                                    
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