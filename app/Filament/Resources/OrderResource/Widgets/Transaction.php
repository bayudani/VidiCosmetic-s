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

        $revenue = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('order_status', 'completed')
            ->sum('total_amount');

        // pendapatan minggu ni
        $weeklyRevenue = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('order_status', 'completed')
            ->sum('total_amount');

        // hari ini
        $todayRevenue = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'completed')
            ->sum('total_amount');

        return [
            Stat::make('Transaksi Bulan Ini', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count())
                ->description('Jumlah transaksi yang masuk di bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),
            // total transaksi berasil
            Stat::make('Transaksi Berhasil', Order::where('order_status', 'completed')->count())
                ->description('Jumlah transaksi yang berhasil')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            // total transaksi dibatalkan
            Stat::make('Transaksi Dibatalkan', Order::where('order_status', 'failed')->count())
                ->description('Jumlah transaksi yang dibatalkan')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($revenue, 0, ',', '.'))
                ->description('Total pendapatan')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
            // pendapatan minggu ini
            Stat::make('Pendapatan Minggu Ini', 'Rp ' . number_format($weeklyRevenue, 0, ',', '.'))
                ->description('Total pendapatan')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
            // pendapatan hari ini
            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($todayRevenue, 0, ',', '.'))
                ->description('Total pendapatan')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

        ];
    }
}
