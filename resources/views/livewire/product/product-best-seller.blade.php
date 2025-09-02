<div>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="flex justify-center items-center mb-10">
                <div class="w-16 h-px bg-gray-300"></div>
                <h2 class="mx-4 text-2xl md:text-3xl font-serif text-center">PRODUK TERLARIS</h2>
                <div class="w-16 h-px bg-gray-300"></div>
            </div>
            <a href="{{ route('shop') }}" wire:navigate>
                <p class="text-center text-gray-500 -mt-8 mb-12 hover:text-pink-500 transition">Lihat Semua</p>
            </a>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-sm p-4 text-center relative group overflow-hidden">
                        {{-- Gambar Produk --}}
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <img src="[https://placehold.co/300x300/FADADD/DB7093?text=](https://placehold.co/300x300/FADADD/DB7093?text=){{ urlencode($product->name) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-56 object-cover rounded-md mb-4 transform group-hover:scale-105 transition-transform duration-300">

                            {{-- Nama Produk --}}
                            <h3 class="font-semibold text-md truncate">{{ $product->name }}</h3>
                        </a>

                        {{-- Deskripsi Singkat --}}
                        <p class="text-xs text-gray-500 my-2 truncate">
                            {{ Str::limit($product->description, 40) }}
                        </p>

                        {{-- Harga Produk --}}
                        <p class="font-bold my-2 text-pink-500">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        {{-- Tombol Add to Bag --}}
                        @if ($product->stock > 0)
                            <button type="button" wire:click.stop="addToCart({{ $product->id }})"
                                class="w-full mt-2 py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-900 hover:text-white transition-colors duration-300">
                                Add to bag
                            </button>
                        @else
                            <button type="button" disabled
                                class="w-full mt-2 py-2 border border-gray-200 bg-gray-100 text-gray-400 rounded-md text-sm font-semibold cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-10">
                        <p>Belum ada produk best seller saat ini.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
</div>
