<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Livewire\Traits\WithCartActions;

class NewProduct extends Component
{
    use WithCartActions;
    public function render()
    {
        // 1. Ambil 8 produk terbaru berdasarkan tanggal dibuat (created_at)
        $newProducts = Product::latest()->take(4)->get();

        // 2. Kirim data produk ke view
        return view('livewire.product.new-product', [
            'products' => $newProducts,
        ]);
    }
}
