<?php

namespace App\Filament\Resources\PatientLists\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;

class PatientListInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Group::make([
                        Section::make('Personal Information')
                            ->description('Basic patient information and identification')
                            ->schema([
                                TextEntry::make('medical_record_number')
                                    ->label('Medical Record Number')
                                    ->size(TextSize::Large)
                                    ->weight('bold')
                                    ->icon('heroicon-o-hashtag')
                                    ->copyable()
                                    ->copyMessage('Copied!')
                                    ->copyMessageDuration(1500),
                                TextEntry::make('nik')
                                    ->label('NIK (National Identity Number)')
                                    ->size(TextSize::Large)
                                    ->icon('heroicon-o-hashtag')
                                    ->weight('bold')
                                    ->copyable()
                                    ->copyMessage('Copied!')
                                    ->copyMessageDuration(1500),
                                TextEntry::make('full_name')
                                    ->label('Full Name')
                                    ->weight('bold')
                                    ->size(TextSize::Large)
                                    ->weight('bold')
                                    ->copyable()
                                    ->copyMessage('Copied!')
                                    ->copyMessageDuration(1500),
                                TextEntry::make('date_of_birth')
                                    ->label('Date of Birth')
                                    ->size(TextSize::Large)
                                    ->weight('bold')
                                    ->date('d M, Y'),
                                TextEntry::make('gender')
                                    ->label('Gender')
                                    ->size(TextSize::Large)
                                    ->weight('bold')
                                    ->badge()
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'male' => 'Male',
                                        'female' => 'Female',
                                        default => $state,
                                    }),
                                TextEntry::make('phone_number')
                                    ->label('Phone Number')
                                    ->size(TextSize::Large)
                                    ->weight('bold'),
                                TextEntry::make('address')
                                    ->label('Full Address')
                                    ->size(TextSize::Large)
                                    ->weight('bold')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                            
                        Section::make('Medication Allergies')
                            ->description('List any known medication allergies')
                            ->schema([
                                TextEntry::make('allergy_details_list')
                                    ->label('Allergies & Reactions')
                                    ->bulleted()
                                    ->default('—')
                                    ->size(TextSize::Large)
                                    ->weight('bold'),
                            ]),
                    ])
                    ->grow(true),
                        
                    Group::make([
                        Section::make('Medical Information')
                            ->description('Important medical data')
                            ->schema([
                                TextEntry::make('blood_type')
                                    ->label('Blood Type')
                                    ->size(TextSize::Large)
                                    ->weight('bold'),
                                TextEntry::make('medical_history')
                                    ->label('Medical History')
                                    ->size(TextSize::Large)
                                    ->weight('bold')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1),
                            
                        Section::make('Status')
                            ->description('Registered and updated timestamps')
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Registered Since')
                                    ->dateTime()
                                    ->size(TextSize::Large)
                                    ->weight('bold'),
                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime()
                                    ->size(TextSize::Large)
                                    ->weight('bold')
                                    ->since(),
                            ]),
                    ])
                    ->grow(false),
                ])
                ->from('md')
                ->columnSpanFull(),
            ]);
    }
}