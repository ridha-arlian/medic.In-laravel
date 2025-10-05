<?php

namespace App\Filament\Resources\DokterManages\Tables;

use Dom\Text;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class DokterManagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Full Name'),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dokter' => 'Dokter',
                        default => $state,
                    }),
                TextColumn::make('email')
                    ->label('Email Address'),
                TextColumn::make('dokter.specialization.name')
                    ->label('Spesialisasi'),
                TextColumn::make('dokter.str_number')
                        ->label('No. STR'),
                TextColumn::make('dokter.consultation_fee')
                    ->label('Biaya Konsultasi')
                    ->money('idr', true),
                TextColumn::make('dokter.phone_number')
                    ->label('No. Telepon'),
                TextColumn::make('dokter.address')
                    ->label('Alamat')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'cuti' => 'warning',
                    }),
                ToggleColumn::make('is_active')
                    ->label('Status Akun')
                    ->onColor('success')
                    ->offColor('danger')
                    ->afterStateUpdated(function ($record, $state) {
                        \Filament\Notifications\Notification::make()
                            ->title('Status Akun Diperbarui')
                            ->body("Akun {$record->name} berhasil " . ($state ? 'diaktifkan' : 'dinonaktifkan'))
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make(),
                        ViewAction::make(),
                    ])->dropdown(false),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected All'),
            ]);
    }
}