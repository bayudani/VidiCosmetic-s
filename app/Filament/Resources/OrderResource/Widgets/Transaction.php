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
                ->color('primary'),
            // total transaksi berasil
            Stat::make('Transaksi Berhasil', Order::where('payment_status', 'paid')->count())
                ->description('Jumlah transaksi yang berhasil')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            // total transaksi dibatalkan
            Stat::make('Transaksi Dibatalkan', Order::where('payment_status', 'unpaid')->count())
                ->description('Jumlah transaksi yang dibatalkan')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            
            // total pendapatan (transaksi berhasil)
            Stat::make('Pendapatan Bulan Ini', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('payment_status', 'paid')
                ->sum('total_amount'))
                ->description('Total pendapatan')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
        ];
    }
}
