<?php

namespace App\Livewire\Product;

use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection; // <-- 1. Import Collection


class Cart extends Component
{

    public Collection $cartItems;
    public float $subtotal = 0;
    public float $total = 0;
    public ?int $confirmingItemId = null;


    // listener untuk cart-update agar kompnene refresh saat ada perubahan
    protected $listeners = ['cart-update' => 'mount'];


    public function mount()
    {
        if (Auth::check()) {
            $this->cartItems = Cart_item::with('product')->where('user_id', Auth::id())->get();
            $this->calculateTotals();
        }
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        // Untuk sekarang, total sama dengan subtotal. Nanti bisa ditambah ongkir, dll.
        $this->total = $this->subtotal;
    }
    public function incrementQuantity(int $cartItemId)
    {
        $item = Cart_item::find($cartItemId);
        if ($item && $item->quantity < $item->product->stock) {
            $item->increment('quantity');
            $this->mount(); // Refresh data
        }
    }

    public function decrementQuantity(int $cartItemId)
    {
        $item = Cart_item::find($cartItemId);
        if ($item && $item->quantity > 1) {
            $item->decrement('quantity');
            $this->mount(); // Refresh data
        }
    }

    /**
     * FUNGSI BARU: Dipanggil saat ikon tong sampah diklik.
     * Tugasnya cuma set ID item yang mau dikonfirmasi.
     */
    public function confirmItemRemoval(int $cartItemId)
    {
        $this->confirmingItemId = $cartItemId;
    }

    /**
     * FUNGSI BARU: Dipanggil saat tombol "Ya, Hapus" di modal diklik.
     * Tugasnya beneran ngehapus item dari database.
     */
    public function removeItem()
    {
        if ($this->confirmingItemId) {
            Cart_item::destroy($this->confirmingItemId);
            $this->mount(); // Refresh data
            $this->dispatch('cart-updated'); // Kirim event global
            $this->confirmingItemId = null; // Reset ID & tutup modal
        }
    }
    public function render()
    {
        return view('livewire.product.cart');
    }
}
