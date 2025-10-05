<?php

namespace App\Filament\Resources\Specializations\Tables;

use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class SpecializationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Spesialisasi'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),
                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->afterStateUpdated(function ($record, $state) {
                        \Filament\Notifications\Notification::make()
                            ->title('Status Akun Diperbarui')
                            ->body("Spesialisasi {$record->name} berhasil " . ($state ? 'diaktifkan' : 'dinonaktifkan'))
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