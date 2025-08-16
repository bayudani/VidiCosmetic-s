<div x-data> {{-- Inisialisasi Alpine.js di root elemen --}}
    <div class="max-w-5xl max-lg:max-w-2xl mx-auto p-4">
        <h1 class="text-xl font-semibold text-slate-900">Shopping Cart</h1>
        <div class="grid lg:grid-cols-3 lg:gap-x-8 gap-y-8 mt-6">
            <div class="lg:col-span-2 space-y-6">

                @forelse ($cartItems as $item)
                    <div class="flex gap-4 bg-white px-4 py-6 rounded-md shadow-sm border border-gray-200"
                        wire:key="{{ $item->id }}">
                        <div class="flex gap-6 sm:gap-4 max-sm:flex-col">
                            <div class="w-24 h-24 shrink-0">
                                <img src="{{ $item->product->images->first()?->image ? Storage::url($item->product->images->first()->image) : '[https://placehold.co/300x300/FADADD/DB7093?text=No+Image](https://placehold.co/300x300/FADADD/DB7093?text=No+Image)' }}" alt=""
                                    class="w-full h-full object-cover rounded-md" />
                            </div>
                            <div class="flex flex-col gap-4">
                                <div>
                                    <h3 class="text-sm sm:text-base font-semibold text-slate-900">
                                        {{ $item->product->name }}</h3>
                                </div>
                                <div class="mt-auto">
                                    <h3 class="text-sm font-semibold text-slate-900">Rp
                                        {{ number_format($item->product->price, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="ml-auto flex flex-col">
                            <div class="flex items-start gap-4 justify-end">
                                <button type="button" wire:click="confirmItemRemoval({{ $item->id }})">
                                    <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"
                                        class="w-4 h-4 cursor-pointer fill-slate-400 hover:fill-red-600"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" />
                                        <path
                                            d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center gap-3 mt-auto">
                                <button type="button" wire:click="decrementQuantity({{ $item->id }})"
                                    class="flex items-center justify-center w-5 h-5 cursor-pointer bg-gray-300 hover:bg-gray-400 outline-none rounded-full">
                                    <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"
                                        class="w-2.5 fill-white" viewBox="0 0 124 124">
                                        <path
                                            d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" />
                                    </svg>
                                </button>
                                <span class="font-semibold text-base">{{ $item->quantity }}</span>
                                <button type="button" wire:click="incrementQuantity({{ $item->id }})"
                                    class="flex items-center justify-center w-5 h-5 cursor-pointer bg-pink-500 hover:bg-pink-600 outline-none rounded-full">
                                    <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"
                                        class="w-2.5 fill-white" viewBox="0 0 42 42">
                                        <path
                                            d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white px-4 py-12 text-center rounded-md shadow-sm border border-gray-200">
                        <p class="text-lg font-semibold text-slate-700">Keranjang belanja Anda kosong.</p>
                        <a href="{{ route('shop') }}" wire:navigate
                            class="mt-4 inline-block text-sm px-6 py-2.5 font-medium tracking-wide bg-pink-500 hover:bg-pink-600 text-white rounded-md">
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse
            </div>

            @if (count($cartItems) > 0)
                <div class="bg-white rounded-md px-4 py-6 h-max shadow-sm border border-gray-200 mt-8 lg:mt-0">
                    <ul class="text-slate-500 font-medium space-y-4">
                        <li class="flex flex-wrap gap-4 text-sm">Subtotal <span
                                class="ml-auto font-semibold text-slate-900">Rp
                                {{ number_format($subtotal, 0, ',', '.') }}</span></li>
                        <hr class="border-slate-300" />
                        <li class="flex flex-wrap gap-4 text-lg font-semibold text-slate-900">Total <span
                                class="ml-auto">Rp {{ number_format($total, 0, ',', '.') }}</span></li>
                    </ul>
                    <div class="mt-8">
                        <a href="{{ route('checkout') }}" wire:navigate
                            class=" block text-center text-sm px-4 py-2.5 w-full font-medium tracking-wide bg-brand-blue hover:bg-brand-blue2 text-white rounded-md">
                            Checkout
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL KONFIRMASI (BAGIAN BARU) --}}
    <div x-show="$wire.confirmingItemId" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4" style="display: none;">

        <div @click.away="$wire.set('confirmingItemId', null)" x-show="$wire.confirmingItemId"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-center">

            <svg class="w-16 h-16 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
            </svg>

            <h3 class="text-xl font-semibold text-gray-800 mt-4">Anda Yakin?</h3>
            <p class="text-gray-500 mt-2">Anda tidak akan bisa mengembalikan produk ini dari keranjang.</p>

            <div class="flex justify-center gap-4 mt-6">
                <button @click="$wire.set('confirmingItemId', null)"
                    class="px-6 py-2 rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 transition">
                    Batal
                </button>
                <button wire:click="removeItem"
                    class="px-6 py-2 rounded-md text-white bg-red-600 hover:bg-red-700 transition">
                    Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>
