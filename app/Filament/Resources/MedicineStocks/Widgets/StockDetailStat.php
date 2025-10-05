<?php

namespace App\Filament\Resources\MedicineStocks\Widgets;

use App\Models\MedicineStock;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StockDetailStat extends StatsOverviewWidget
{
    public ?MedicineStock $record = null;

    protected function getStats(): array
    {
        if (!$this->record) {
            return [];
        }

        $stockStatus = match (true) {
            $this->record->quantity <= 10 => 'Critical',
            $this->record->quantity <= 50 => 'Low', 
            default => 'Good'
        };

        $today = now()
            ->startOfDay();
        $expiredDate = \Carbon\Carbon::parse($this->record->expired_date)
            ->startOfDay();
        
        if ($expiredDate->lt($today)) {
            $expiryStatus = 'Expired';
            $expiryColor = 'danger';
        } elseif ($expiredDate->lte($today->copy()->addDays(30))) {
            $expiryStatus = 'Expires soon';
            $expiryColor = 'danger';
        } elseif ($expiredDate->lte($today->copy()->addDays(90))) {
            $expiryStatus = 'Near expiry';
            $expiryColor = 'warning';
        } else {
            $expiryStatus = 'Good';
            $expiryColor = 'success';
        }

        return [
            Stat::make('Stock', $this->record->quantity . ' units')
                ->description($stockStatus)
                ->descriptionIcon('heroicon-m-cube')
                ->color(match($stockStatus) {
                    'Critical' => 'danger',
                    'Low' => 'warning',
                    default => 'success'
                }),

            Stat::make('Expiry', $expiryStatus)
                ->description(\Carbon\Carbon::parse($this->record->expired_date)->format('d M Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color($expiryColor),

            Stat::make('Batch', $this->record->batch_id)
                ->description('Batch ID')
                ->descriptionIcon('heroicon-m-hashtag')
                ->color('info'),

            Stat::make('Price', 'Rp ' . number_format($this->record->price))
                ->description('Per unit')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('primary'),
        ];
    }
}