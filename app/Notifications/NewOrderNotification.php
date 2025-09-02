<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Notifications\Actions\Action;

class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        $order = Order::find($this->orderId);

        if (!$order) {
            return [];
        }

        
        return FilamentNotification::make()
            ->title('Pesanan Baru Diterima!')
            ->body("Pesanan dengan nomor #{$order->order_number} telah dibuat.")
            ->icon('heroicon-o-shopping-bag')
            ->iconColor('success')
            ->actions([
                Action::make('view')
                    ->label('Lihat Pesanan')
                    ->url(route('filament.admin.resources.orders.edit', ['record' => $order->id]))
                    ->markAsRead(),
            ])
            ->getDatabaseMessage();
    }
}