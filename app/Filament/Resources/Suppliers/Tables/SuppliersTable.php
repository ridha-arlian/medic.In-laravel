<?php

namespace App\Filament\Resources\Suppliers\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->label('Supplier Name'),
                TextColumn::make('contact_person')
                    ->label('Contact Person'),
                TextColumn::make('phone')
                    ->label('Phone'),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('address')
                    ->label('Address'),
                TextColumn::make('status')
                    ->label('Status')        
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'success',
                        'nonaktif' => 'danger'
                    })
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
