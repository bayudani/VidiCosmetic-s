<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource\Widgets\Transaction;
use App\Filament\Resources\ProductResource\Widgets\ProductStatsOverview;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    
    protected function getStats(): array
    {
        // Mendapatkan tanggal awal dan akhir bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            Stat::make('Total Produk', Product::count())
                ->description('Jumlah semua jenis produk yang ada')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success')
                ->url(route('filament.admin.resources.products.index')),


            Stat::make('Transaksi Bulan Ini', Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count())
                ->description('Jumlah transaksi yang masuk di bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->url(route('filament.admin.resources.orders.index')),

            Stat::make('Total Stok', Category::count())
                ->description('Jumlah kategori produk yang tersedia')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('info')
                ->url(route('filament.admin.resources.categories.index')),

        ];
    }

    // public static function getWidgets(): array
    // {
    //     return [
    //         ProductStatsOverview::class,
    //         Transaction::class
    //     ];
    // }
}
