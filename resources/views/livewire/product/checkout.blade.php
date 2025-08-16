<div>
    <div class="max-w-7xl mx-auto p-4 font-sans">
        <h1 class="text-3xl font-serif text-slate-900 text-center my-8">Checkout</h1>

        <form wire:submit="placeOrder">
            <div class="grid lg:grid-cols-3 gap-12">

                {{-- KOLOM KIRI: Form Pengiriman & Pembayaran --}}
                <div class="lg:col-span-2 bg-white p-8 rounded-lg shadow-md border">
                    <h2 class="text-xl font-semibold text-slate-800 border-b pb-4">Detail Pengiriman</h2>
                    <div class="space-y-6 mt-6">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="customer_name" wire:model="customer_name" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none">
                            @error('customer_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-slate-700 mb-1">No. Telepon / WA</label>
                            <input type="tel" id="customer_phone" wire:model="customer_phone" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none">
                            @error('customer_phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                            <textarea id="shipping_address" wire:model="shipping_address" rows="4" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none"></textarea>
                            @error('shipping_address') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <h2 class="text-xl font-semibold text-slate-800 border-b pb-4 mt-10">Metode Pembayaran</h2>
                    <div class="space-y-4 mt-6">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer has-[:checked]:border-pink-500 has-[:checked]:ring-2 has-[:checked]:ring-pink-200">
                            <input type="radio" wire:model="payment_method" value="bank_transfer" class="w-5 h-5 text-pink-500 focus:ring-pink-500">
                            <div class="ml-4">
                                <p class="font-semibold text-slate-900">Bank Transfer</p>
                                <p class="text-sm text-slate-600">Transfer manual ke rekening kami.</p>
                            </div>
                        </label>
                        {{-- Tambahkan metode pembayaran lain di sini jika ada --}}
                    </div>
                     @error('payment_method') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- KOLOM KANAN: Ringkasan Pesanan --}}
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-lg shadow-md border h-max sticky top-24">
                        <h3 class="text-xl font-semibold text-slate-800 border-b pb-4">Ringkasan Pesanan</h3>
                        <div class="space-y-4 mt-6">
                            @foreach ($cartItems as $item)
                                <div class="flex justify-between items-center gap-4" wire:key="{{ $item->id }}">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 shrink-0 bg-gray-100 p-1 rounded-md">
                                            <img src="{{ $item->product->images->first()?->image ? Storage::url($item->product->images->first()->image) : '[https://placehold.co/300x300/FADADD/DB7093?text=No+Image](https://placehold.co/300x300/FADADD/DB7093?text=No+Image)' }}" class="w-full h-full object-cover rounded-md" />
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800">{{ $item->product->name }}</p>
                                            <p class="text-xs text-slate-500">Qty: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-slate-800">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                        <ul class="text-slate-600 mt-6 space-y-3 border-t pt-4">
                            <li class="flex justify-between text-sm">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </li>
                            <li class="flex justify-between text-lg font-bold text-slate-900 border-t pt-3 mt-3">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <button type="submit" class="w-full py-3 text-lg font-medium bg-pink-500 text-white rounded-md hover:bg-pink-600 disabled:opacity-50" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="placeOrder">Buat Pesanan</span>
                                <span wire:loading wire:target="placeOrder">Memproses...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>