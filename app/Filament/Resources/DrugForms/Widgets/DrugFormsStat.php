<?php

namespace App\Filament\Resources\DrugForms\Widgets;

use App\Models\MedicineType;
use App\Models\MedicineStock;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DrugFormsStat extends StatsOverviewWidget
{

    protected function getStats(): array
    {
        $activeDrugForms = MedicineType::where('status', 'aktif')->count();
        $inactiveDrugForms = MedicineType::where('status', 'nonaktif')->count();

        // Medicine type dengan stock obat terbanyak
        $drugFormWithMostStock = MedicineType::withCount('medicineStocks')
            ->orderBy('medicine_stocks_count', 'desc')
            ->first();
            
        $mostStockCount = $drugFormWithMostStock ? $drugFormWithMostStock->medicine_stocks_count : 0;
        $drugFormName = $drugFormWithMostStock ? $drugFormWithMostStock->name : 'Tidak ada';
        
        // Total jenis obat berdasarkan form/type
        $totalDrugVariants = MedicineStock::distinct('medicine_types_id')->count('medicine_types_id');

        return [
            Stat::make('Bentuk Obat Aktif', $activeDrugForms)
                ->description($inactiveDrugForms . ' bentuk obat non-aktif')
                ->descriptionIcon('heroicon-m-no-symbol')
                ->color('danger'),
                
            Stat::make('Bentuk Obat Terpopuler', $drugFormName)
                ->description($mostStockCount . ' item stock')
                ->descriptionIcon('heroicon-m-fire')
                ->color('warning'),
                
            Stat::make('Variasi Bentuk Obat', $totalDrugVariants)
                ->description('Yang tersedia di stock')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('info'),
        ];
    }
}
