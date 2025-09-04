<div>
    <section class="py-20 bg-gradient-to-br from-pink-50 to-white">
        <div class="max-w-6xl mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-serif">Galeri Kami</h2>
                <div class="w-24 h-1 bg-pink-500 mx-auto rounded-full"></div>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">Jelajahi dunia Vd Cosmetics melalui koleksi visual kami, dari produk pilihan hingga momen spesial bersama pelanggan.</p>
            </div>

            <div class="flex justify-center flex-wrap gap-2 mb-12">
                <button wire:click="setType('all')"
                        class="{{ $activeType === 'all' ? 'bg-pink-500 text-white' : 'bg-white text-gray-700' }} px-4 py-2 rounded-full font-semibold text-sm shadow-sm hover:bg-pink-500 hover:text-white transition-colors duration-300">
                    Semua
                </button>
                @foreach ($mediaTypes as $type)
                    <button wire:click="setType('{{ $type }}')"
                            class="{{ $activeType === $type ? 'bg-pink-500 text-white' : 'bg-white text-gray-700' }} px-4 py-2 rounded-full font-semibold text-sm shadow-sm hover:bg-pink-500 hover:text-white transition-colors duration-300 capitalize">
                        {{ $type }}
                    </button>
                @endforeach
            </div>

            {{-- Cek jika ada item di galeri --}}
            @if($galleryItems->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($galleryItems as $item)
                        <div class="relative group overflow-hidden rounded-2xl shadow-lg">
                            <img src="{{ Storage::url($item->media_path) }}"
                                 alt="Galeri Vd Cosmetics - {{ $item->media_type }}"
                                 class="w-full h-80 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            
                            {{-- Overlay saat hover --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 py-10">
                    <p>Belum ada gambar di galeri untuk kategori ini.</p>
                </div>
            @endif
        </div>
    </section>
</div>