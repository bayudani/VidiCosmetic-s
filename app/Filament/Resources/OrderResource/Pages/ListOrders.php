<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\Transaction;
use App\Models\Order;
use Filament\Actions;
use Illuminate\Database\Eloquent\Builder; 
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

      protected function getHeaderWidgets(): array
    {
        return [
            Transaction::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Transaksi')
                ->badge(Order::count()), // Badge angka total

            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'unpaid'))
                ->badge(Order::where('payment_status', 'unpaid')->count()),

            'completed' => Tab::make('Selesai')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'paid'))
                ->badge(Order::where('payment_status', 'paid')->count()),

            'cancelled' => Tab::make('Dibatalkan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'failed'))
                ->badge(Order::where('payment_status', 'failed')->count()),
        ];
    }
}
