<?php

namespace App\Livewire\About;

use App\Models\Store_galery;
use Livewire\Component;

class Galeri extends Component
{
    public $mediaTypes = []; // Untuk menyimpan jenis-jenis media (kategori)
    public $activeType = 'all'; // Kategori yang aktif, default-nya 'all'

    public function mount()
    {
        // Ambil semua nama media_type yang unik dari database untuk tombol filter
        $this->mediaTypes = Store_galery::distinct()->pluck('media_type')->filter()->all();
    }

    public function setType(string $type)
    {
        // Method untuk mengganti filter yang aktif
        $this->activeType = $type;
    }

    public function render()
    {
        // Query akan dijalankan setiap kali render, jadi filternya reaktif
        $galleryItems = Store_galery::query()
            ->when($this->activeType !== 'all', function ($query) {
                $query->where('media_type', $this->activeType);
            })
            ->latest()
            ->get();

        return view('livewire.about.galeri', [
            'galleryItems' => $galleryItems
        ]);
    }
}