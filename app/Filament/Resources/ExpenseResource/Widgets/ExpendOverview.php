<?php

namespace App\Filament\Resources\ExpenseResource\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExpendOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $ExpenseQuery = Expense::all()->sum('amount');
        return [
            Stat::make('Pengeluaran', 'Rp ' . number_format($ExpenseQuery, 0, ',', '.'))
            ->color('primary')
            ->description('Total pengeluaran')
            ->descriptionIcon('heroicon-m-arrow-trending-down'),
        ];
    }
}
