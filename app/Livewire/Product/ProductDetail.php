<?php

namespace App\Livewire\Product;

use App\Livewire\Traits\WithCartActions;

use App\Models\Cart_item;
use Livewire\Attributes\Layout;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

#[Layout('layouts.app')]
class ProductDetail extends Component
{
    use WithCartActions; // <-- 2. Gunakan Trait di sini

    public Product $product;

    /**
     * Method ini akan jalan pertama kali saat komponen di-load.
     * Dia nerima $slug dari URL dan nyari produknya di database.
     */
    public function mount(string $slug)
    {
        // Ambil produk berdasarkan slug, atau tampilkan error 404 jika tidak ditemukan
        $this->product = Product::with('images')->where('slug', $slug)->firstOrFail();
    }

    public function buyNow()
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'));
        }

        // Redirect ke halaman checkout dengan product_id
        return $this->redirect(route('checkout', [
            'product_slug' => $this->product->slug,
        ]), navigate: true);
    }

    // public function addToCart()
    // {
    //     // 1. Cek apakah user sudah login
    //     if (!Auth::check()) {
    //         return $this->redirect(route('login'), navigate: true);
    //     }

    //     // 2. Cek apakah produk sudah ada di keranjang
    //     $existingItem = Cart_item::where('user_id', Auth::id())
    //                             ->where('product_id', $this->product->id)
    //                             ->first();

    //     if ($existingItem) {
    //         // Jika sudah ada, tambah quantity-nya
    //         $existingItem->increment('quantity');
    //     } else {
    //         // Jika belum ada, buat item baru
    //         Cart_item::create([
    //             'user_id' => Auth::id(),
    //             'product_id' => $this->product->id,
    //             'quantity' => 1,
    //         ]);
    //     }

    //     // 3. Kirim event untuk memberitahu komponen lain (misal: cart icon di navbar)
    //     $this->dispatch('cart-updated');

    //     // 4. Tampilkan notifikasi sukses
    //     session()->flash('message', 'Produk berhasil ditambahkan ke keranjang!');
    // }
    public function render()
    {
        return view('livewire.product.product-detail');
    }
}
