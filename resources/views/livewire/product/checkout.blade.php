<div>
    <div class="max-w-7xl mx-auto p-4 font-sans">
        <h1 class="text-3xl font-serif text-slate-900 text-center my-8">Checkout</h1>

        {{-- STEP INDICATOR --}}
        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center">
                <div
                    class="w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold {{ $currentStep >= 1 ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                    1</div>
                {{-- Tambahkan class hidden dan sm:block di sini --}}
                <p
                    class="ml-3 font-semibold hidden sm:block {{ $currentStep >= 1 ? 'text-pink-500' : 'text-gray-500' }}">
                    Pengiriman</p>
            </div>
            <div class="flex-auto border-t-2 mx-4 {{ $currentStep > 1 ? 'border-pink-500' : 'border-gray-200' }}"></div>
            <div class="flex items-center">
                <div
                    class="w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold {{ $currentStep >= 2 ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                    2</div>
                {{-- Tambahkan class hidden dan sm:block di sini --}}
                <p
                    class="ml-3 font-semibold hidden sm:block {{ $currentStep >= 2 ? 'text-pink-500' : 'text-gray-500' }}">
                    Pembayaran</p>
            </div>
            <div class="flex-auto border-t-2 mx-4 {{ $currentStep > 2 ? 'border-pink-500' : 'border-gray-200' }}"></div>
            <div class="flex items-center">
                <div
                    class="w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold {{ $currentStep >= 3 ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                    3</div>
                {{-- Tambahkan class hidden dan sm:block di sini --}}
                <p
                    class="ml-3 font-semibold hidden sm:block {{ $currentStep >= 3 ? 'text-pink-500' : 'text-gray-500' }}">
                    Selesai</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-12">
            {{-- KOLOM KIRI: Form Steps --}}
            <div class="lg:col-span-2 bg-white p-8 rounded-lg shadow-md border">

                {{-- STEP 1: PENGIRIMAN --}}
                <div @if ($currentStep != 1) style="display: none;" @endif>
                    <h2 class="text-xl font-semibold text-slate-800 border-b pb-4">Detail Pengiriman</h2>
                    <div class="space-y-6 mt-6">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-slate-700 mb-1">Nama
                                Lengkap</label>
                            <input type="text" id="customer_name" wire:model="customer_name"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none">
                            @error('customer_name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-slate-700 mb-1">No.
                                Telepon / WA</label>
                            <input type="tel" id="customer_phone" wire:model="customer_phone"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none">
                            @error('customer_phone')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-slate-700 mb-1">Alamat
                                Lengkap</label>
                            <textarea id="shipping_address" wire:model="shipping_address" rows="4"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none"></textarea>
                            @error('shipping_address')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-8 text-right">
                        <button type="button" wire:click="goToNextStep"
                            class="px-6 py-2.5 bg-pink-500 text-white font-semibold rounded-md hover:bg-pink-600 transition">Lanjut
                            ke Pembayaran</button>
                    </div>
                </div>

                {{-- STEP 2: PEMBAYARAN --}}
                <div @if ($currentStep != 2) style="display: none;" @endif>
                    <h2 class="text-xl font-semibold text-slate-800 border-b pb-4">Metode Pengiriman & Pembayaran</h2>
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-slate-800">Metode Pengiriman</h3>
                        <div class="space-y-4 mt-4">
                            <label
                                class="flex items-center p-4 border rounded-lg cursor-pointer has-[:checked]:border-pink-500 has-[:checked]:ring-2 has-[:checked]:ring-pink-200">
                                <input type="radio" wire:model="delivery_method" value="pickup"
                                    class="w-5 h-5 text-pink-500 focus:ring-pink-500">
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Ambil di Tempat</p>
                                    <p class="text-sm text-slate-600">Gratis, ambil langsung di lokasi kami.</p>
                                </div>
                            </label>
                            <label
                                class="flex items-center p-4 border rounded-lg cursor-pointer has-[:checked]:border-pink-500 has-[:checked]:ring-2 has-[:checked]:ring-pink-200">
                                <input type="radio" wire:model="delivery_method" value="delivery"
                                    class="w-5 h-5 text-pink-500 focus:ring-pink-500">
                                <div class="ml-4">
                                    <p class="font-semibold text-slate-900">Diantar</p>
                                    <p class="text-sm text-slate-600">Akan ada biaya tambahan, dihubungi terpisah.</p>
                                </div>
                            </label>
                        </div>
                        @error('delivery_method')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror

                        <h3 class="text-lg font-semibold text-slate-800 mt-8">Metode Pembayaran</h3>
                        <div class="space-y-4 mt-4">
                            @forelse ($bankAccounts as $bank)
                                <label
                                    class="flex items-center p-4 border rounded-lg cursor-pointer has-[:checked]:border-pink-500 has-[:checked]:ring-2 has-[:checked]:ring-pink-200">
                                    <input type="radio" wire:model="payment_method" value="{{ $bank->bank_name }}"
                                        class="w-5 h-5 text-pink-500 focus:ring-pink-500">
                                    <div class="ml-4">
                                        <p class="font-semibold text-slate-900">Bank {{ $bank->bank_name }}</p>
                                        <p class="text-sm text-slate-600">{{ $bank->account_number }} a.n
                                            {{ $bank->account_name }}</p>
                                    </div>
                                </label>
                            @empty
                                <p class="text-sm text-slate-500">Metode pembayaran belum tersedia.</p>
                            @endforelse
                        </div>
                        @error('payment_method')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror

                        <div class="mt-6">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Upload Bukti Transfer
                                </label>
                            <input type="file" wire:model="proof_of_transaction" id="upload-proof"
                                class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">

                            <div wire:loading wire:target="proof_of_transaction" class="text-sm text-gray-500 mt-2">
                                Uploading...</div>

                             @if ($proof_of_transaction)
                                <div wire:loading.remove wire:target="proof_of_transaction" class="mt-2">
                                    <p class="text-sm text-gray-600 mb-1">Preview:</p>
                                    <img src="{{ $proof_of_transaction->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-md border">
                                </div>
                            @endif
                            @error('proof_of_transaction')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col sm:flex-row justify-between gap-4">
                        <button type="button" wire:click="goToPreviousStep"
                            class="w-full sm:w-auto px-6 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 transition">Kembali</button>
                        <button type="button" wire:click="goToNextStep"
                            class="w-full sm:w-auto px-6 py-2.5 bg-pink-500 text-white font-semibold rounded-md hover:bg-pink-600 transition">Lanjut
                            ke Konfirmasi</button>
                    </div>
                </div>

                {{-- STEP 3: SELESAI --}}
                <div @if ($currentStep != 3) style="display: none;" @endif>
                    <h2 class="text-xl font-semibold text-slate-800 border-b pb-4">Konfirmasi Pesanan</h2>
                    <p class="mt-6 text-gray-600">Silakan periksa kembali detail pesanan Anda sebelum menyelesaikan
                        transaksi. Pastikan semua data sudah benar.</p>
                    <div class="mt-8 flex justify-between">
                        <button type="button" wire:click="goToPreviousStep"
                            class="px-6 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 transition">Kembali</button>
                        <button type="button" wire:click="placeOrder"
                            class="px-6 py-2.5 bg-brand-blue text-white font-semibold rounded-md hover:bg-brand-bluew transition">Buat
                            Pesanan</button>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: Ringkasan Pesanan --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-md border h-max sticky top-24">
                    <h3 class="text-xl font-semibold text-slate-800 border-b pb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-4 mt-6">
                        @foreach ($items as $index => $item)
                            <div class="flex justify-between items-center gap-4" wire:key="item-{{ $index }}">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 shrink-0 bg-gray-100 p-1 rounded-md">
                                        <img src="{{ $item['product_image'] ? Storage::url($item['product_image']) : 'https://placehold.co/300x300/FADADD/DB7093?text=No+Image' }}"
                                            class="w-full h-full object-cover rounded-md" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $item['product_name'] }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <button type="button"
                                                wire:click="decrementQuantity({{ $index }})"
                                                class="flex items-center justify-center w-5 h-5 cursor-pointer bg-gray-300 hover:bg-gray-400 rounded-full text-white">-</button>
                                            <span class="font-semibold text-sm">{{ $item['quantity'] }}</span>
                                            <button type="button"
                                                wire:click="incrementQuantity({{ $index }})"
                                                class="flex items-center justify-center w-5 h-5 cursor-pointer bg-pink-500 hover:bg-pink-600 rounded-full text-white">+</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm font-semibold text-slate-800">Rp
                                    {{ number_format($item['product_price'] * $item['quantity'], 0, ',', '.') }}
                                </p>
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
                    {{-- <div class="mt-8">
                        <button type="submit"
                            class="w-full py-3 text-lg font-medium bg-pink-500 text-white rounded-md hover:bg-pink-600 disabled:opacity-50"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="placeOrder">Buat Pesanan</span>
                            <span wire:loading wire:target="placeOrder">Memproses...</span>
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
