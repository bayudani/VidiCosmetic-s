<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // 1. DATA PENDAPATAN
        $allTimeCompletedOrders = Order::where('order_status', 'completed');
        $allTimeTotalRevenue = (clone $allTimeCompletedOrders)->sum('total_amount');

        // 2. MEMISAHKAN JENIS PENGELUARAN BERDASARKAN KATEGORI
        $allTimeCogs = Expense::whereHas('category', function ($query) {
            $query->where('name', 'Modal Produk');
        })->sum('amount');

        $allTimeOperationalExpenses = Expense::whereHas('category', function ($query) {
            $query->where('name', '!=', 'Modal Produk');
        })->sum('amount');

        // 3. KALKULASI LABA YANG DETAIL
        // Laba Kotor = Total Pendapatan - Modal (COGS)
        $grossProfit = $allTimeTotalRevenue - $allTimeCogs;

        // Laba Bersih = Laba Kotor - Biaya Operasional
        $netProfit = $grossProfit - $allTimeOperationalExpenses;

        $stats = [];
        if (auth()->user()->hasRole('owner')) {
            $ownerStats = [
                Stat::make('Laba Bersih', 'Rp ' . Number::format($netProfit, locale: 'id'))
                    ->description('Keuntungan final setelah semua biaya')
                    ->color('success'),

                Stat::make('Laba Kotor', 'Rp ' . Number::format($grossProfit, locale: 'id'))
                    ->description('Pendapatan dikurangi modal produk (COGS)')
                    ->color('warning'),

                Stat::make('Pengeluaran Operasional', 'Rp ' . Number::format($allTimeOperationalExpenses, locale: 'id'))
                    ->description('Biaya bisnis di luar modal (gaji,sewa,dll)')
                    ->color('danger'),
                
                    Stat::make('Total Modal (COGS)', 'Rp ' . Number::format($allTimeCogs, locale: 'id'))
                    ->description('Total pengeluaran untuk produk/stok')
                    ->color('primary'),
            ];
            $stats = array_merge($stats, $ownerStats);
        }

        // STATS UMUM
        $generalStats = [
            Stat::make('Total Pendapatan', 'Rp ' . Number::format($allTimeTotalRevenue, locale: 'id'))
                ->description('Total pendapatan')
                ->color('info'),

            Stat::make('Total Transaksi', Order::where('order_status', 'completed')->count())
                ->description('Total transaksi')
                ->color('gray'),
        ];
        $stats = array_merge($stats, $generalStats);

        // stats produk khusus admin
        if (auth()->user()->hasRole('admin')) {
            $adminStats = [
                Stat::make('Total Produk', Product::count())
                    ->description('Jumlah produk yang terdaftar')
                    ->color('primary'),

                Stat::make('Produk Stok Menipis', Product::where('stock', '<=', 5)->count())
                    ->description('Produk dengan stok 5 atau kurang')
                    ->color('danger'),
            ];
            $stats = array_merge($stats, $adminStats);
        }
        return $stats;
    }
}
