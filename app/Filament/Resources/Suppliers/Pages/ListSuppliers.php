<?php

namespace App\Filament\Resources\Suppliers\Pages;

use Filament\Actions\CreateAction;
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
                ->disableCreateAnother()
                ->label('Add New Supplier'),
        ];
    }
}
