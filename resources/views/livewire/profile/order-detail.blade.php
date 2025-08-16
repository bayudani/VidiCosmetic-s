<div>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 font-sans">
        <a href="{{ route('history') }}" wire:navigate class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-pink-500 mb-8">
            <svg xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Kembali ke Histori Pesanan
        </a>
        
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md border">
            {{-- Header Detail --}}
            <div class="flex flex-col sm:flex-row justify-between items-start border-b pb-6">
                <div>
                    <h1 class="text-2xl font-serif text-slate-900">Detail Pesanan</h1>
                    <p class="text-sm text-gray-500 mt-1">Order ID: {{ $order->order_number }}</p>
                </div>
                <div class="mt-4 sm:mt-0 text-left sm:text-right">
                    <p class="text-xs text-gray-500">Status Pesanan</p>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        @if($order->order_status == 'completed') bg-green-100 text-green-800 
                        @elseif($order->order_status == 'cancelled') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>

            {{-- BAGIAN BARU: ORDER TRACKING --}}
            @php
                $statusLevels = ['pending' => 1, 'processing' => 2, 'completed' => 3, 'cancelled' => 0];
                $currentStatusLevel = $statusLevels[$order->order_status] ?? 0;
            @endphp
            <div class="mt-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">Lacak Pesanan</h2>
                <div class="flex items-center">
                    {{-- Step 1: Pesanan Dibuat --}}
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $currentStatusLevel >= 1 ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-xs font-semibold mt-2 {{ $currentStatusLevel >= 1 ? 'text-pink-500' : 'text-gray-500' }}">Dibuat</p>
                    </div>
                    {{-- Connector --}}
                    <div class="flex-auto border-t-2 mx-4 {{ $currentStatusLevel >= 2 ? 'border-pink-500' : 'border-gray-200' }}"></div>
                    {{-- Step 2: Diproses --}}
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $currentStatusLevel >= 2 ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                             @if($currentStatusLevel >= 2)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            @endif
                        </div>
                        <p class="text-xs font-semibold mt-2 {{ $currentStatusLevel >= 2 ? 'text-pink-500' : 'text-gray-500' }}">Diproses</p>
                    </div>
                    {{-- Connector --}}
                    <div class="flex-auto border-t-2 mx-4 {{ $currentStatusLevel >= 3 ? 'border-pink-500' : 'border-gray-200' }}"></div>
                    {{-- Step 3: Selesai --}}
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $currentStatusLevel >= 3 ? 'bg-pink-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                            @if($currentStatusLevel >= 3)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2-2h8a1 1 0 001-1zM22 9h-4a1 1 0 00-1 1v10l2-2h3a1 1 0 001-1V10a1 1 0 00-1-1z"></path></svg>
                            @endif
                        </div>
                        <p class="text-xs font-semibold mt-2 {{ $currentStatusLevel >= 3 ? 'text-pink-500' : 'text-gray-500' }}">Selesai</p>
                    </div>
                </div>
            </div>

            {{-- Detail Item --}}
            <div class="mt-8 border-t pt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Produk yang Dipesan</h2>
                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 shrink-0 bg-gray-100 p-1 rounded-md">
                                    <img src="{{ $item->product->images->first()?->image ? Storage::url($item->product->images->first()->image) : '[https://placehold.co/300x300/FADADD/DB7093?text=No+Image](https://placehold.co/300x300/FADADD/DB7093?text=No+Image)' }}" class="w-full h-full object-cover rounded-md" />
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-800">{{ $item->product->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-slate-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            
            {{-- Info Pengiriman & Pembayaran --}}
            <div class="grid md:grid-cols-2 gap-8 mt-8 border-t pt-6">
                <div>
                    <h3 class="font-semibold text-gray-800">Alamat Pengiriman</h3>
                    <p class="text-sm text-gray-600 mt-2">{{ $order->shipping_address }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Info Pembayaran</h3>
                    <ul class="text-sm text-gray-600 mt-2 space-y-1">
                        <li class="flex justify-between"><span>Metode:</span> <span class="font-medium">{{ $order->payment_method }}</span></li>
                        <li class="flex justify-between"><span>Total:</span> <span class="font-bold text-pink-500">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></li>
                    </ul>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            @if ($order->order_status === 'processing')
                <div class="mt-8 border-t pt-6 text-center">
                    <p class="text-sm text-gray-600 mb-4">Apakah Anda sudah menerima pesanan ini?</p>
                    <button wire:click="markAsCompleted" class="px-6 py-2.5 bg-brand-blue text-white font-semibold rounded-md hover:bg-brand-blue2 transition">
                        Ya, Pesanan Diterima
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>