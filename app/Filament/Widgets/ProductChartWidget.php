<?php

namespace App\Filament\Widgets;

use App\Models\Order_item;
use App\Models\OrderItem; // <-- 1. Ganti modelnya jadi OrderItem
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class ProductChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafik Produk Terjual';
    protected static ?int $sort = 3;
    public ?string $filter = 'month';

    protected function getFilters(): ?array
    {
        return ['week' => 'Minggu Ini', 'month' => 'Bulan Ini'];
    }

    protected function getData(): array
    {
        // 2. Siapkan query dasar untuk mengambil item yang terjual
        $query = Order_item::whereHas('order', function ($query) {
            $query->where('order_status', 'completed');
        });

        $labels = [];
        $data = [];

        switch ($this->filter) {
            case 'week':
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::today()->subDays($i);
                    $labels[] = $date->format('D');
                    // 3. Hitung jumlah 'quantity' dari item yang terjual pada tanggal tersebut
                    $data[] = (clone $query)->whereHas('order', fn($q) => $q->whereDate('created_at', $date))->sum('quantity');
                }
                break;
            case 'month':
                for ($i = 1; $i <= Carbon::today()->daysInMonth; $i++) {
                    $date = Carbon::today()->startOfMonth()->addDays($i - 1);
                    $labels[] = $date->format('d M');
                    $data[] = (clone $query)->whereHas('order', fn($q) => $q->whereDate('created_at', $date))->sum('quantity');
                }
                break;
            // case 'year':
            //     for ($i = 1; $i <= 12; $i++) {
            //         $labels[] = Carbon::create()->month($i)->format('M');
            //         $data[] = (clone $query)->whereHas('order', fn($q) => $q->whereYear('created_at', today()->year)->whereMonth('created_at', $i))->sum('quantity');
            //     }
            //     break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Produk Terjual',
                    'data' => $data,
                    'backgroundColor' => '#87CEEB', // Warna biru langit
                    'borderColor' => '#4682B4',   // Warna biru baja
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Grafik garis lebih cocok untuk data ini
    }
}
