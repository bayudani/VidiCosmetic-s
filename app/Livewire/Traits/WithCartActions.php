<?php
namespace App\Livewire\Traits;


use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;

trait WithCartActions
{
    /**
     * Fungsi ini akan menangani semua logika penambahan produk ke keranjang.
     * Cukup panggil `$this->addToCart($productId)` dari komponen manapun.
     */
    public function addToCart(int $productId)
    {
        // 1. Cek apakah user sudah login, jika belum, lempar ke halaman login.
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        // 2. Cek apakah produk sudah ada di keranjang user.
        $existingItem = Cart_item::where('user_id', Auth::id())
                                ->where('product_id', $productId)
                                ->first();
        
        if ($existingItem) {
            // Jika sudah ada, tambah quantity-nya saja.
            $existingItem->increment('quantity');
        } else {
            // Jika belum ada, buat item baru di keranjang.
            Cart_item::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        // 3. Kirim event internal untuk update komponen lain (misal: ikon cart di navbar).
        $this->dispatch('cart-updated');

        // 4. Kirim event ke browser untuk menampilkan notifikasi (toast).
        $this->dispatch('show-toast', message: 'Produk berhasil ditambahkan ke keranjang!');
        // 5. redirect ke halaman keranjang
        $this->redirect(route('cart'), navigate: true);
    }
}