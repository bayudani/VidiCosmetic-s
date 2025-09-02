<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number; // Gunakan helper Number yang lebih modern

class Transaction extends BaseWidget
{
    protected function getStats(): array
    {
        // --- KUMPULKAN SEMUA PERHITUNGAN DI ATAS AGAR LEBIH RAPI ---

        // Query dasar untuk order yang sudah selesai, biar gak nulis ulang
        $completedOrders = Order::where('order_status', 'completed');

        // Pendapatan berdasarkan periode
        $monthlyRevenue = (clone $completedOrders)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('total_amount');
        $weeklyRevenue = (clone $completedOrders)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount');
        $todayRevenue = (clone $completedOrders)->whereDate('created_at', Carbon::today())->sum('total_amount');

        // Total pendapatan sepanjang masa (All Time) - PERBAIKAN DI SINI
        $allTimeRevenue = (clone $completedOrders)->sum('total_amount');
        
        // --- TAMPILKAN STATS DI BAWAH ---

        return [
            Stat::make('Transaksi Bulan Ini', Order::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count())
                ->description('Jumlah semua transaksi masuk')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),
            
            Stat::make('Transaksi Berhasil', (clone $completedOrders)->count())
                ->description('Total transaksi selesai sepanjang masa')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            // Menggunakan status 'cancelled' agar konsisten dengan resource lain
            Stat::make('Transaksi Dibatalkan', Order::where('order_status', 'cancelled')->count())
                ->description('Total transaksi batal sepanjang masa')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
            
            // --- STATS PENDAPATAN DENGAN FORMAT BARU ---
            
            Stat::make('Pendapatan Bulan Ini', 'Rp ' . Number::format($monthlyRevenue, locale: 'id'))
                ->description('Dari transaksi berhasil bulan ini')
                ->color('success'),
            
            Stat::make('Pendapatan Minggu Ini', 'Rp ' . Number::format($weeklyRevenue, locale: 'id'))
                ->description('Dari transaksi berhasil minggu ini')
                ->color('success'),
                
            Stat::make('Pendapatan Hari Ini', 'Rp ' . Number::format($todayRevenue, locale: 'id'))
                ->description('Dari transaksi berhasil hari ini')
                ->color('success'),

            // PERBAIKAN STATS TERAKHIR SESUAI PERMINTAAN
            Stat::make('Total Semua Pendapatan', 'Rp ' . Number::format($allTimeRevenue, locale: 'id'))
                ->description('Total pendapatan dari semua transaksi berhasil')
                ->color('info'),
        ];
    }
}