<?php

namespace App\Livewire\Profile;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class OrderDetail extends Component
{
    public Order $order;

    public function mount(string $order_number)
    {
        // Ambil order berdasarkan order_number, pastikan order ini milik user yang login
        $this->order = Order::where('order_number', $order_number)
                            ->where('user_id', Auth::id())
                            ->with('items.product.images') // Eager load semua relasi yang dibutuhkan
                            ->firstOrFail();
    }

    /**
     * Fungsi untuk menandai pesanan sebagai 'completed'.
     */
    public function markAsCompleted()
    {
        // Hanya izinkan update jika status saat ini adalah 'processing'
        if ($this->order->order_status === 'processing') {
            $this->order->update(['order_status' => 'completed']);
            
            // Tampilkan notifikasi
            $this->dispatch('show-toast', message: 'Terima kasih telah mengkonfirmasi pesanan!');
        }
    }

    public function render()
    {
        return view('livewire.profile.order-detail');
    }
}
