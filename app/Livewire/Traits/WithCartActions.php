<?php

namespace App\Livewire\Traits;


use App\Models\Cart_item;
use App\Models\Product;
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

        // cek stok
        $product = Product::find($productId);
        if (!$product || $product->stock <= 0) {
            session()->flash('error', 'Produk tidak tersedia atau stok habis.');
            $this->dispatch('show-toast', message: session('error'));
            return;
        }

        // 2. Cek apakah produk sudah ada di keranjang user.
        $existingItem = Cart_item::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($existingItem) {
            // Jika sudah ada, tambah quantity-nya saja.
            // Cek apakah nambah 1 lagi masih cukup stoknya
            if ($product->stock > $existingItem->quantity) {
                $existingItem->increment('quantity');
                $this->dispatch('show-toast', message: 'Jumlah produk di keranjang ditambah!');
            } else {
                $this->dispatch('show-toast', message: 'Stok tidak mencukupi.', type: 'error');
                return;
            }
        } else {
            // Jika belum ada, buat item baru di keranjang.
            Cart_item::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        // 3. Kirim event internal untuk update komponen lain (misal: ikon cart di navbar).
        // $this->dispatch('cart-updated');
        session()->flash('message', 'Produk berhasil ditambahkan ke keranjang!');

        // 4. Kirim event ke browser untuk menampilkan notifikasi (toast).
        $this->dispatch('cart-updated');

        $this->dispatch('show-toast', message: session('message'));

        // $this->redirect(route('cart'), navigate: true);
    }
}
