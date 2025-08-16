<?php

namespace App\Livewire\Product;

use App\Models\Cart_item;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection; 
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Checkout extends Component
{
    public Collection $cartItems;
    public float $subtotal = 0;
    public float $total = 0;

    // Properti untuk form
    public string $customer_name = '';
    public string $customer_phone = '';
    public string $shipping_address = '';
    public string $payment_method = '';

    public function mount()
    {
        $this->cartItems = Cart_item::with('product')->where('user_id', Auth::id())->get();

        // Jika keranjang kosong, lempar ke halaman shop
        if ($this->cartItems->isEmpty()) {
            return $this->redirect(route('shop'));
        }

        // Isi data otomatis
        $this->customer_name = Auth::user()->name;
        // Ganti ini jika punya kolom phone/address di tabel user
        // $this->customer_phone = Auth::user()->phone; 
        // $this->shipping_address = Auth::user()->address;

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $this->total = $this->subtotal; // Bisa ditambah ongkir nanti
    }

    public function placeOrder()
    {
        $this->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // 1. Buat Order baru
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'INV-' . time() . '-' . Auth::id(),
            'total_amount' => $this->total,
            'order_status' => 'pending',
            'payment_status' => 'unpaid', // User harus bayar dulu
            'payment_method' => $this->payment_method,
            'shipping_address' => $this->shipping_address,
        ]);

        // 2. Pindahkan item dari keranjang ke order_items
        foreach ($this->cartItems as $item) {
            Order_item::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
            // Kurangi stok produk
            $item->product->decrement('stock', $item->quantity);
        }

        // 3. Kosongkan keranjang
        Cart_item::where('user_id', Auth::id())->delete();

        // 4. Kirim event untuk update ikon cart & kasih notifikasi
        $this->dispatch('cart-updated');
        session()->flash('message', 'Pesanan Anda berhasil dibuat!');

        // 5. Redirect ke halaman histori pesanan (atau halaman sukses)
        return $this->redirect(route('home')); // Ganti ke route histori pesanan jika ada
    }

    public function render()
    {
        return view('livewire.product.checkout');
    }
}
