<?php

namespace App\Filament\Resources\ApotekerManages\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class ApotekerManagesTable
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
                        'apoteker' => 'Apoteker',
                        default => $state,
                    }),
                TextColumn::make('email')
                    ->label('Email Address'),
                TextColumn::make('apoteker.phone_number')
                    ->label('No. Telepon'),                   
                TextColumn::make('apoteker.address')
                    ->label('Alamat')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('apoteker.stra_number')
                    ->label('No. STRA'),
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