<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Category;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kategori', Category::count())
                ->description('Jumlah kategori produk yang ada')
                ->descriptionIcon('heroicon-m-tag')
                ->color('success'),

            Stat::make('Total Stok Semua Produk', Product::sum('stock'))
                ->description('Jumlah stok dari semua produk')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('info'),

            Stat::make('Produk Stok Menipis', Product::where('stock', '<=', 5)->count())
                ->description('Produk dengan stok 5 atau kurang')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
