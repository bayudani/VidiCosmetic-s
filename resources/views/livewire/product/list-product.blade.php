<div>
    <div class="relative flex min-h-screen">
        {{-- Overlay untuk mobile --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-30 lg:hidden hidden"></div>

        {{-- Sidebar Filter --}}
        <div id="sidebar"
            class="fixed top-0 left-0 w-full max-w-[300px] shrink-0 bg-white shadow-md px-6 sm:px-8 h-screen py-6 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:h-auto overflow-y-auto">

            <div class="flex items-center border-b border-gray-300 pb-2 mb-6">
                <h3 class="text-slate-900 text-lg font-semibold">Filter</h3>
                <button id="close-sidebar-btn" type="button" class="lg:hidden text-slate-700 ml-auto cursor-pointer p-1">
                    <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" class="w-5 h-5"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18 6l-12 12"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </button>
                {{-- Tombol Clear Filter --}}
                <button type="button" wire:click="clearFilters"
                    class="text-sm text-red-500 font-semibold ml-auto cursor-pointer">Clear all</button>
            </div>

            {{-- Filter Kategori (Dinamis) --}}
            <div>
                <h6 class="text-slate-900 text-sm font-semibold">Kategori</h6>
                <ul class="mt-6 space-y-4">
                    @foreach ($categories as $category)
                        <li class="flex items-center gap-3">
                            <input id="cat-{{ $category->id }}" type="checkbox" wire:model.live="selectedCategories"
                                value="{{ $category->id }}"
                                class="w-4 h-4 cursor-pointer text-pink-500 focus:ring-pink-500" />
                            <label for="cat-{{ $category->id }}"
                                class="text-slate-600 font-medium text-sm cursor-pointer">
                                {{ $category->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <hr class="my-6 border-gray-300" />

            {{-- Filter Harga (BARU) --}}
            <div>
                <h6 class="text-slate-900 text-sm font-semibold">Rentang Harga</h6>
                <ul class="mt-6 space-y-4">
                    <li class="flex items-center gap-3">
                        <input id="price-1" type="radio" name="price_range" wire:model.live="priceRange"
                            value="under-100k" class="w-4 h-4 cursor-pointer text-pink-500 focus:ring-pink-500" />
                        <label for="price-1" class="text-slate-600 font-medium text-sm cursor-pointer">Di bawah Rp
                            100.000</label>
                    </li>
                    <li class="flex items-center gap-3">
                        <input id="price-2" type="radio" name="price_range" wire:model.live="priceRange"
                            value="100k-200k" class="w-4 h-4 cursor-pointer text-pink-500 focus:ring-pink-500" />
                        <label for="price-2" class="text-slate-600 font-medium text-sm cursor-pointer">Rp 100.000 - Rp
                            200.000</label>
                    </li>
                    <li class="flex items-center gap-3">
                        <input id="price-3" type="radio" name="price_range" wire:model.live="priceRange"
                            value="over-200k" class="w-4 h-4 cursor-pointer text-pink-500 focus:ring-pink-500" />
                        <label for="price-3" class="text-slate-600 font-medium text-sm cursor-pointer">Di atas Rp
                            200.000</label>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-300" />
        </div>

        {{-- Konten Produk --}}
        <div class="w-full p-4 sm:p-6">
            <button id="open-sidebar-btn"
                class="lg:hidden mb-6 flex items-center gap-2 bg-pink-500 text-white font-semibold py-2 px-4 rounded-md shadow-md">
                <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" class="h-5 w-5"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L13 10.414V15a1 1 0 01-.293.707l-2 2A1 1 0 019 17v-6.586L4.293 6.707A1 1 0 014 6V3z"
                        clip-rule="evenodd" />
                </svg>
                Show Filters
            </button>

            <div wire:loading.class="opacity-50" class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-lg shadow-sm p-4 text-center relative group overflow-hidden border">
                        @php
                                // Cek apakah ada gambar di relasi 'images', jika ada, ambil yang pertama.
                                // Jika tidak ada, pakai gambar utama dari tabel 'products' sebagai fallback.
                                $displayImage = $product->images->first()->image ?? $product->image;
                            @endphp
                        <img src="{{ asset('storage/' . $displayImage) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-56 object-cover rounded-md mb-4 transform group-hover:scale-105 transition-transform duration-300">
                        <a href="{{ route('product.detail', $product->slug) }}">
                            <h3 class="font-semibold text-md truncate">{{ $product->name }}</h3>
                        </a>
                        <p class="text-xs text-gray-500 my-2 truncate">{{ Str::limit($product->description, 40) }}</p>
                        <p class="font-bold my-2 text-pink-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <button
                            class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-brand-blue hover:text-white transition-colors duration-300"
                            wire:click="addToCart({{ $product->id }})">
                            Tambah ke Keranjang
                        </button>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-20">
                        <p class="text-lg">Oops! Produk tidak ditemukan.</p>
                        <p class="text-sm">Coba ubah filter atau kembali lagi nanti.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>


        {{-- JavaScript untuk sidebar mobile, biarkan saja --}}
        <script>
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('open-sidebar-btn');
            const closeBtn = document.getElementById('close-sidebar-btn');
            const overlay = document.getElementById('sidebar-overlay');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            openBtn.addEventListener('click', openSidebar);
            closeBtn.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);
        </script>
    </div>
