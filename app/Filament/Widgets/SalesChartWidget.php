<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class SalesChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafik Keuangan'; 
    public ?string $filter = 'month';
    protected static ?int $sort = 2;

    protected function getFilters(): ?array
    {
        return ['today' => 'Hari Ini', 'week' => 'Minggu Ini', 'month' => 'Bulan Ini'];
    }

    protected function getData(): array
    {
        $revenueQuery = Order::where('order_status', 'completed');
        $expenseQuery = Expense::query(); // <-- 2. Siapkan query pengeluaran
        $labels = [];
        $revenueData = [];
        $expenseData = []; // <-- 3. Siapkan array untuk data pengeluaran

        switch ($this->filter) {
            case 'today':
                for ($i = 0; $i < 24; $i++) {
                    $labels[] = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                    $revenueData[] = (clone $revenueQuery)->whereDate('created_at', today())->whereRaw('HOUR(created_at) = ?', [$i])->sum('total_amount');
                    $expenseData[] = (clone $expenseQuery)->whereDate('expense_date', today())->whereRaw('HOUR(created_at) = ?', [$i])->sum('amount'); // Asumsi pengeluaran punya timestamp
                }
                break;
            case 'week':
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::today()->subDays($i);
                    $labels[] = $date->format('D');
                    $revenueData[] = (clone $revenueQuery)->whereDate('created_at', $date)->sum('total_amount');
                    $expenseData[] = (clone $expenseQuery)->whereDate('expense_date', $date)->sum('amount');
                }
                break;
            case 'month':
                for ($i = 1; $i <= Carbon::today()->daysInMonth; $i++) {
                    $date = Carbon::today()->startOfMonth()->addDays($i - 1);
                    $labels[] = $date->format('d M');
                    $revenueData[] = (clone $revenueQuery)->whereDate('created_at', $date)->sum('total_amount');
                    $expenseData[] = (clone $expenseQuery)->whereDate('expense_date', $date)->sum('amount');
                }
                break;
            case 'year':
                // for ($i = 1; $i <= 12; $i++) {
                //     $labels[] = Carbon::create()->month($i)->format('M');
                //     $revenueData[] = (clone $revenueQuery)->whereYear('created_at', today()->year)->whereMonth('created_at', $i)->sum('total_amount');
                //     $expenseData[] = (clone $expenseQuery)->whereYear('expense_date', today()->year)->whereMonth('expense_date', $i)->sum('amount');
                // }
                // break;
        }

        // <-- 4. Tambahkan dataset baru untuk pengeluaran -->
        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan', 
                    'data' => $revenueData, 
                    'backgroundColor' => '#E9A8B5', 
                    'borderColor' => '#DB7093'
                ],
                [
                    'label' => 'Pengeluaran', 
                    'data' => $expenseData, 
                    'backgroundColor' => '#A9A9A9', 
                    'borderColor' => '#696969'
                ]
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string { return 'bar'; }
}
