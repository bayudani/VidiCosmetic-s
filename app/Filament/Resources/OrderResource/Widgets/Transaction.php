<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Transaction extends BaseWidget
{
    protected function getStats(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        return [
            Stat::make('Transaksi Bulan Ini', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count())
                ->description('Jumlah transaksi yang masuk di bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->url(route('filament.admin.resources.orders.index')),
        ];
    }
}
