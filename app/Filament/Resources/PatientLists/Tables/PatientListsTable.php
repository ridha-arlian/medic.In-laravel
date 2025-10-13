<?php

namespace App\Filament\Resources\PatientLists\Tables;

use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class PatientListsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('medical_record_number')
                    ->label('Medical Record Number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('full_name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('gender')
                    ->label('Gender')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'male' => 'Male',
                        'female' => 'Female',
                        default => $state,
                    }),
                TextColumn::make('date_of_birth')
                    ->label('Date of Birth')
                    ->date('d M, Y'),
                TextColumn::make('phone_number')
                    ->label('Phone Number'),
                TextColumn::make('address')
                    ->label('Address')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('age')
                    ->label('Age'),
                TextColumn::make('blood_type')
                    ->label('Blood Type')
                    ->badge(),
                TextColumn::make('allergy_medicines')
                    ->label('Drug Allergies')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('allergy_reactions')
                    ->label('Reactions')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('medical_history')
                    ->label('Medical History')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make(),
                        ViewAction::make()
                    ])->dropdown(false),
                    DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}