<?php

namespace App\Livewire\About;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Number; 

class AboutCTA extends Component
{
    // Properti untuk menyimpan data statistik
    public string $totalCustomers;
    public string $totalProducts;
    public string $totalCategories;
    public string $totalSuccessfulTransactions;

    public function mount()
    {
        
        $customers = User::role('pembeli')->count();
        $products = Product::count();
        // Ganti 'brand' dengan 'category_id' jika kamu tidak punya kolom brand
        $categories = Category::count();
        $transactions = Order::where('order_status', 'completed')->count();

        // Format angka agar lebih keren (misal: 10000 jadi 10K)
        $this->totalCustomers = Number::abbreviate($customers);
        $this->totalProducts = Number::abbreviate($products);
        $this->totalCategories = Number::abbreviate($categories);
        $this->totalSuccessfulTransactions = Number::abbreviate($transactions);
    }

    public function render()
    {
        return view('livewire.about.about-c-t-a');
    }
}