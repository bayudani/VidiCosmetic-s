<div>
    <section class="py-16">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="flex justify-center items-center mb-10">
                <div class="w-16 h-px bg-gray-300"></div>
                <h2 class="mx-4 text-2xl md:text-3xl font-serif text-center">PRODUK BARU</h2>
                <div class="w-16 h-px bg-gray-300"></div>
            </div>
            <a href="{{ route('shop') }}" wire:navigate>
                <p class="text-center text-gray-500 -mt-8 mb-12 hover:text-pink-500 transition">Lihat Semua</p>
            </a>

            <!-- Product Grid -->
            {{-- Kita ganti carousel dengan grid yang lebih simpel dan responsif --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                {{-- Lakukan looping untuk setiap produk --}}
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-sm p-4 text-center relative group overflow-hidden">
                        {{-- Gambar Produk --}}

                        <img src="https://placehold.co/300x300/FADADD/DB7093?text=Product+3" alt="{{ $product->name }}"
                            class="w-full h-56 object-cover rounded-md mb-4 transform group-hover:scale-105 transition-transform duration-300">


                        {{-- Nama Produk --}}
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <h3 class="font-semibold text-md truncate">{{ $product->name }}</h3>
                        </a>
                        {{-- Deskripsi Singkat --}}
                        <p class="text-xs text-gray-500 my-2 truncate">
                            {{-- Gunakan Str::limit untuk memotong deskripsi jika terlalu panjang --}}
                            {{ Str::limit($product->description, 40) }}
                        </p>

                        {{-- Harga Produk --}}
                        <p class="font-bold my-2 text-pink-500">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        {{-- Tombol Add to Bag --}}
                        <button
                            class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-brand-blue hover:text-white transition-colors duration-300"
                            wire:click="addToCart({{ $product->id }})">
                            Tambah ke Keranjang
                        </button>
                    </div>
                @empty
                    {{-- Tampilkan pesan ini jika tidak ada produk sama sekali --}}
                    <div class="col-span-full text-center text-gray-500 py-10">
                        <p>Belum ada produk baru saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
        {{-- Global Toast Notification --}}
        <div x-data="{ show: false, message: '' }"
            @show-toast.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
            x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            class="fixed top-24 right-5 bg-green-500 text-white py-2 px-4 rounded-xl text-sm shadow-lg z-50"
            style="display: none;">
            <span x-text="message"></span>
        </div>
    </section>
</div>
