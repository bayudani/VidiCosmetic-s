<?php

namespace App\Livewire\Product;

use App\Models\Order_item;
// use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Livewire\Traits\WithCartActions; // <-- 1. Import Trait untuk aksi keranjang


class ProductBestSeller extends Component
{
    use WithCartActions; // <-- 2. Gunakan Trait untuk aksi keranjang
    public function render()
    {
        // 1. Ambil ID produk yang paling banyak terjual
        $bestSellerIds = Order_item::query()
            // Pilih kolom product_id dan hitung total quantity-nya
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            // Kelompokkan berdasarkan product_id
            ->groupBy('product_id')
            // Urutkan dari yang paling banyak terjual
            ->orderByDesc('total_sold')
            // Ambil 4 teratas
            ->take(4)
            // Ambil hanya kolom product_id nya saja
            ->pluck('product_id');

        // 2. Ambil data produk berdasarkan ID yang didapat
        // Kita pakai whereIn untuk mengambil beberapa produk sekaligus
        $bestSellers = Product::whereIn('id', $bestSellerIds)->get();

        // 3. Kirim data ke view
        return view('livewire.product.product-best-seller', [
            'products' => $bestSellers
        ]);
    }
}
