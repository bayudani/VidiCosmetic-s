<div>
    {{-- Kita pakai Alpine.js untuk handle galeri gambar biar smooth --}}
    <div x-data="{ mainImage: '{{ $product->images->first()?->image ? Storage::url($product->images->first()->image) : '[https://placehold.co/600x800/FADADD/DB7093?text=No+Image](https://placehold.co/600x800/FADADD/DB7093?text=No+Image)' }}' }" class="font-sans">
        <div class="p-4 lg:max-w-7xl max-w-4xl mx-auto">
            <div class="grid items-start grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- KOLOM KIRI: GALERI GAMBAR INTERAKTIF --}}
                <div class="w-full lg:sticky top-0 text-center">
                    {{-- Tampilan Gambar Utama --}}
                    <div class="bg-gray-100 rounded-xl">
                        <img :src="mainImage" alt="{{ $product->name }}"
                            class="w-full max-w-md mx-auto rounded-xl object-cover aspect-[3/4] shadow-lg" />
                    </div>
                    {{-- Daftar Thumbnail Gambar --}}
                    <div class="mt-4 flex flex-wrap justify-center gap-4 mx-auto">
                        @forelse ($product->images as $image)
                            <div @click="mainImage = '{{ Storage::url($image->image) }}'"
                                class="w-24 h-24 rounded-xl p-1.5 flex-shrink-0 cursor-pointer transition-all duration-300"
                                :class="{ 'ring-2 ring-pink-500': mainImage === '{{ Storage::url($image->image_path) }}' }">
                                <img src="{{ Storage::url($image->image) }}" alt="Thumbnail {{ $loop->iteration }}"
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>
                        @empty
                            {{-- Tampilan jika tidak ada gambar sama sekali --}}
                            <div
                                class="w-24 h-24 rounded-xl p-1.5 flex-shrink-0 bg-gray-100 flex items-center justify-center">
                                <span class="text-xs text-gray-400">No Images</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- KOLOM KANAN: DETAIL INFO PRODUK --}}
                <div class="py-6 px-4 sm:px-0">
                    <div>
                        <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                        <h2 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $product->name }}</h2>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center flex-wrap gap-4">
                            <p class="text-slate-900 text-4xl font-bold">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <p class="text-sm text-gray-600">Stok Tersedia: <span
                                class="font-semibold">{{ $product->stock }}</span></p>
                    </div>

                    {{-- Notifikasi akan muncul di sini --}}
                    @if (session()->has('message'))
                        <div class="fixed top-24 right-5 bg-green-500 text-white py-2 px-4 rounded-xl text-sm shadow-lg z-50 animate-fade-in-down"
                            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="flex gap-4 mt-8">
                        <button type="button" wire:click="addToCart({{ $product->id }})"
                            class="w-full px-4 py-3 bg-pink-500 hover:bg-pink-600 text-white text-sm font-bold rounded-md transition-colors">
                            Add to bag
                        </button>
                        <button type="button" wire:click="buyNow"
                            class="w-full px-4 py-3 bg-pink-500 hover:bg-pink-600 text-white text-sm font-bold rounded-md transition-colors">
                            Beli Sekarang
                        </button>
                    </div>

                    <div class="mt-10">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Deskripsi Produk</h3>
                            <div class="text-sm text-slate-600 mt-4 space-y-3">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
