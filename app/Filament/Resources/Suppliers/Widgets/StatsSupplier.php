<?php

namespace App\Filament\Resources\Suppliers\Widgets;

use App\Models\MedicineStock;
use App\Models\MedicineSupplier;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsSupplier extends StatsOverviewWidget
{

    protected function getStats(): array
    {
        $activeSuppliers = MedicineSupplier::where('status', 'aktif')
            ->count();
        $inactiveSuppliers = MedicineSupplier::where('status', 'nonaktif')
            ->count();

        $supplierWithMostMedicines = MedicineSupplier::withCount('medicineStocks')
            ->orderBy('medicine_stocks_count', 'desc')
            ->first();
            
        $mostMedicinesCount = $supplierWithMostMedicines ? $supplierWithMostMedicines->medicine_stocks_count : 0;
        $supplierName = $supplierWithMostMedicines ? $supplierWithMostMedicines->name : 'Tidak ada';
        
        $totalMedicineStock = MedicineStock::sum('quantity');

        return [
            Stat::make('Supplier Aktif', $activeSuppliers)
                ->description($inactiveSuppliers . ' supplier non-aktif')
                ->descriptionIcon('heroicon-m-no-symbol')
                ->color('danger'),
                
            Stat::make('Supplier Obat Terbanyak', $supplierName)
                ->description($mostMedicinesCount . ' jenis obat')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
                
            Stat::make('Total Stock Obat', number_format($totalMedicineStock))
                ->description('Dari semua supplier')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),
        ];
    }
}