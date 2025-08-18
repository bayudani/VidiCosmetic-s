<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    public ?string $filter = 'month';

    // Atur urutan widget di dashboard, angka lebih kecil akan tampil di atas
    protected static ?int $sort = 1;

    // protected function getFilters(): ?array
    // {
    //     return [
    //         'today' => 'Hari Ini',
    //         'week' => 'Minggu Ini',
    //         'month' => 'Bulan Ini',
    //         'year' => 'Tahun Ini',
    //     ];
    // }

    protected function getStats(): array
    {
        $start = match ($this->filter) {
            'today' => Carbon::today(),
            'week' => Carbon::now()->startOfWeek(),
            'month' => Carbon::now()->startOfMonth(),
            'year' => Carbon::now()->startOfYear(),
        };
        $end = Carbon::now();

        // --- STATISTIK UMUM (Bisa dilihat semua admin) ---
        $stats = [
            Stat::make('Total Produk', Product::count())
                ->description('Jumlah semua jenis produk')
                ->color('success')
                ->url(route('filament.admin.resources.products.index')),

            
            Stat::make('Total Transaksi', Order::whereBetween('created_at', [$start, $end])->where('order_status', 'completed')->count())
                ->description('Jumlah transaksi berhasil')
                ->color('primary')
                ->url(route('filament.admin.resources.orders.index')),
        ];

        // --- STATISTIK KHUSUS OWNER ---
        if (auth()->user()->hasRole('owner')) {
            // Data Penjualan
            $completedOrdersQuery = Order::whereBetween('created_at', [$start, $end])->where('order_status', 'completed');
            $totalRevenue = (clone $completedOrdersQuery)->sum('total_amount');
            // $totalTransactions = (clone $completedOrdersQuery)->count();

            
            // Data Modal (COGS)
            $totalCost = Order_item::whereHas('order', fn($q) => $q->whereBetween('created_at', [$start, $end])->where('order_status', 'completed'))
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->sum(DB::raw('order_items.quantity * products.cost_price'));

            // Data Pengeluaran
            $totalExpenses = Expense::whereBetween('expense_date', [$start, $end])->sum('amount');

            // Kalkulasi Laba
            $grossProfit = $totalRevenue - $totalCost;
            $netProfit = $grossProfit - $totalExpenses;

            // Gabungkan statistik owner ke array utama
            $ownerStats = [
                // Stat::make('Transaksi Selesai', $totalTransactions)
                //     ->description('Berdasarkan filter waktu')
                //     ->color('primary'),
                Stat::make('Laba Bersih', 'Rp ' . number_format($netProfit, 0, ',', '.'))
                    ->description('Laba kotor dikurangi pengeluaran')
                    ->color('success'),
                Stat::make('Laba Kotor', 'Rp ' . number_format($grossProfit, 0, ',', '.'))
                    ->description('Pendapatan total dikurangi COGS')
                    ->color('warning'),
                Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                    ->description('Total pendapatan dari penjualan')
                    ->color('info'),
                Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalExpenses, 0, ',', '.'))
                    ->description('Total pengeluaran bisnis')
                    ->color('danger')
                    ->url(route('filament.admin.resources.expenses.index')),
                // Stat::make('Total Produk Terjual', Order_item::whereHas('order', fn
            ];

            $stats = array_merge($stats, $ownerStats);
        }

        return $stats;
    }
}
