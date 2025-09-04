<?php

namespace App\Livewire\About;

use Livewire\Component;

class Aboutus extends Component
{

    // ambil data total produk dan total user(pembeli)
    public $totalProducts;
    public $totalUsers;
    public function mount()
    {
        $this->totalProducts = \App\Models\Product::count();
        // user filter role pembeli
        $this->totalUsers = \App\Models\User::role('pembeli')->count();
    }
    public function render()
    {
        return view('livewire.about.aboutus');
    }
}
