<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Traits\WithCartActions; 

class ListProduct extends Component
{
    use WithCartActions; // <-- 1. Gunakan Trait untuk aksi keranjang
    use WithPagination;

    public array $selectedCategories = [];
    public string $priceRange = ''; // Properti untuk menyimpan filter harga

    // Lifecycle hook untuk mereset halaman saat filter kategori diubah
    public function updatingSelectedCategories(): void
    {
        $this->resetPage();
    }

    // Lifecycle hook untuk mereset halaman saat filter harga diubah
    public function updatingPriceRange(): void
    {
        $this->resetPage();
    }
    
    // Fungsi untuk membersihkan semua filter
    public function clearFilters()
    {
        $this->selectedCategories = [];
        $this->priceRange = '';
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::all();
        $productsQuery = Product::query();

        // Terapkan filter kategori
        if (!empty($this->selectedCategories)) {
            $productsQuery->whereIn('category_id', $this->selectedCategories);
        }

        // Terapkan filter harga
        if ($this->priceRange) {
            $productsQuery->where(function ($query) {
                match ($this->priceRange) {
                    'under-100k' => $query->where('price', '<', 100000),
                    '100k-200k'  => $query->whereBetween('price', [100000, 200000]),
                    'over-200k'  => $query->where('price', '>', 200000),
                };
            });
        }

        $products = $productsQuery->latest()->paginate(12);

        return view('livewire.product.list-product', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
