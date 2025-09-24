<?php

namespace App\Filament\Resources\DrugCategories\Widgets;

use App\Models\MedicineStock;
use App\Models\MedicineCategory;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DrugCategoriesStat extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Hitung total medicine categories aktif dan non-aktif
        $activeDrugCategories = MedicineCategory::where('status', 'aktif')->count();
        $inactiveDrugCategories = MedicineCategory::where('status', 'nonaktif')->count();

        // Medicine category dengan stock obat terbanyak
        $categoryWithMostStock = MedicineCategory::withCount('medicineStocks')
            ->orderBy('medicine_stocks_count', 'desc')
            ->first();
            
        $mostStockCount = $categoryWithMostStock ? $categoryWithMostStock->medicine_stocks_count : 0;
        $categoryName = $categoryWithMostStock ? $categoryWithMostStock->name : 'Tidak ada';
        
        // Total variasi kategori obat yang tersedia di stock
        $totalCategoryVariants = MedicineStock::distinct('medicine_categories_id')->count('medicine_categories_id');

        return [
            Stat::make('Kategori Obat Aktif', $activeDrugCategories)
                ->description($inactiveDrugCategories . ' kategori non-aktif')
                ->descriptionIcon('heroicon-m-no-symbol')
                ->color('danger'),
                
            Stat::make('Kategori Terpopuler', $categoryName)
                ->description($mostStockCount . ' item stock')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
                
            Stat::make('Variasi Kategori Obat', $totalCategoryVariants)
                ->description('Yang tersedia di stock')
                ->descriptionIcon('heroicon-m-rectangle-group')
                ->color('info'),
        ];
    }
}
