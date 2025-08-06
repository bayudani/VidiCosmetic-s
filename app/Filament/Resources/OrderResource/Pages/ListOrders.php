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
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(Order::where('status', 'pending')->count()),

            'completed' => Tab::make('Selesai')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'completed'))
                ->badge(Order::where('status', 'completed')->count()),

            'cancelled' => Tab::make('Dibatalkan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'cancelled'))
                ->badge(Order::where('status', 'cancelled')->count()),
        ];
    }
}
