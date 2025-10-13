<?php

namespace App\Filament\Resources\PatientLists\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Utilities\Get;

class PatientListForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->columnSpanFull()
                    ->description('Basic patient information and identification')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('medical_record_number')
                                    ->label('Medical Record Number')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->placeholder('Will be automatically generated upon creation')
                                    ->visible(fn ($context) => $context === 'edit'),
                                TextInput::make('nik')
                                    ->label('NIK (National Identity Number)')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->minLength(16)
                                    ->maxLength(16)
                                    ->extraInputAttributes([
                                        'inputmode' => 'numeric',
                                        'pattern' => '[0-9]*',
                                    ])
                                    ->placeholder('16-digit National Identity Number'),
                                
                                TextInput::make('full_name')
                                    ->label('Full Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter patient full name'),
                                DatePicker::make('date_of_birth')
                                    ->label('Date of Birth')
                                    ->required()
                                    ->native(false)
                                    ->maxDate(now())
                                    ->displayFormat('d M, Y')
                                    ->placeholder('Select patient date of birth'),
                                Select::make('gender')
                                    ->label('Gender')
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ])
                                    ->required()
                                    ->native(false),
                                TextInput::make('phone_number')
                                    ->label('Phone Number')
                                    ->placeholder('Enter contact number patient or guardian')
                                    ->tel()
                                    ->telRegex('/^(?:\+62|62|0)[0-9]{8,13}$/')
                                    ->required()
                                    ->maxLength(20),
                            ]),
                        Textarea::make('address')
                            ->label('Full Address')
                            ->required()
                            ->rows(3)
                            ->placeholder('Enter complete residential address')
                            ->columnSpanFull(),
                    ]),
                Section::make('Medical Information')
                    ->description('Important medical data - please fill carefully')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('blood_type')
                                    ->label('Blood Type')
                                    ->options([
                                        'A+' => 'A+',
                                        'A-' => 'A-',
                                        'B+' => 'B+',
                                        'B-' => 'B-',
                                        'AB+' => 'AB+',
                                        'AB-' => 'AB-',
                                        'O+' => 'O+',
                                        'O-' => 'O-',
                                    ])
                                    ->searchable()
                                    ->placeholder('Select blood type')
                                    ->native(false)
                                    ->columnSpan(1),
                                Textarea::make('medical_history')
                                    ->label('Medical History')
                                    ->placeholder('Previous medical conditions, surgeries, chronic diseases, etc.')
                                    ->helperText('Include previous diseases, surgeries, chronic conditions')
                                    ->rows(3)
                                    ->columnSpan(2),
                            ])
                    ]),
                Section::make('Medication Allergies')
                    ->columnSpanFull()
                    ->description('List any known medication allergies')
                    ->schema([
                        Repeater::make('medicationAllergies')
                            ->relationship('drugAllergies')
                            ->label('')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        Select::make('medicine_stock_id')
                                            ->label('Medicine from Stock')
                                            ->relationship('medicineStock', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->placeholder('Select from medicine stock')
                                            ->live()
                                            ->helperText('Select if medicine exists in stock')
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                if ($state) {
                                                    $set('custom_medicine_name', null);
                                                }
                                            }),
                                        TextInput::make('custom_medicine_name')
                                            ->label('Custom Medicine Name')
                                            ->placeholder('Or enter custom medicine name')
                                            ->maxLength(255)
                                            ->hidden(fn (Get $get): bool => filled($get('medicine_stock_id')))
                                            ->helperText('Use if medicine not in stock')
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                if ($state) {
                                                    $set('medicine_stock_id', null);
                                                }
                                            }),
                                        Textarea::make('reaction')
                                            ->label('Allergic Reaction')
                                            ->placeholder('Describe the allergic reaction (e.g., rash, swelling, difficulty breathing)')
                                            ->rows(2)
                                            ->columnSpan(1),
                                    ]),
                            ])
                            ->defaultItems(0)
                            ->addActionLabel('Add Medication Allergy')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['custom_medicine_name'] ?? ($state['medicine_stock_id'] ? 'Medicine from Stock' : 'New Allergy'))
                            ->columnSpanFull()
                            ->minItems(0),
                    ]),
            ]);
    }
}