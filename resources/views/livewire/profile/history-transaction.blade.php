<div>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 font-sans">
        <h1 class="text-3xl font-serif text-slate-900 text-center my-8">Riwayat Aktivitas Saya</h1>

        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md border">
            {{-- Navigasi Tab --}}
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button wire:click="setActiveTab('orders')"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
                                   {{ $activeTab === 'orders' ? 'border-pink-500 text-pink-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Riwayat Pesanan
                    </button>
                    <button wire:click="setActiveTab('consultations')"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
                                   {{ $activeTab === 'consultations' ? 'border-pink-500 text-pink-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Riwayat Konsultasi
                    </button>
                </nav>
            </div>

            <div class="mt-6">
                {{-- Tampilan untuk Tab Pesanan Produk --}}
                @if ($activeTab === 'orders')
                    <div class="space-y-6">
                        @forelse ($data as $order)
                            <div class="border-b pb-6" wire:key="order-{{ $order->id }}">
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 items-center">
                                    <div>
                                        <p class="text-xs text-gray-500">Order ID</p>
                                        <p class="font-semibold text-sm text-gray-800 truncate">
                                            {{ $order->order_number }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal</p>
                                        <p class="font-semibold text-sm text-gray-800">
                                            {{ $order->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Total</p>
                                        <p class="font-bold text-sm text-pink-500">Rp
                                            {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full {{ $order->order_status == 'completed' ? 'bg-green-100 text-green-800' : ($order->order_status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </div>
                                    <div class="col-span-2 md:col-span-1 text-right">
                                        <a href="{{ route('order.detail', $order->order_number) }}" wire:navigate
                                            class="inline-block text-sm px-4 py-2 font-medium bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-md transition">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <p class="text-lg font-semibold text-slate-700">Anda belum memiliki riwayat pesanan.</p>
                            </div>
                        @endforelse
                    </div>
                @endif

                {{-- Tampilan untuk Tab Jadwal Konsultasi --}}
                @if ($activeTab === 'consultations')
                    <div class="space-y-6">
                        @forelse ($data as $consultation)
                            <div class="border-b pb-6" wire:key="consultation-{{ $consultation->id }}">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                                    <div>
                                        <p class="text-xs text-gray-500">ID Booking</p>
                                        <p class="font-semibold text-sm text-gray-800">BOOK-{{ $consultation->id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Jadwal</p>
                                        <p class="font-semibold text-sm text-gray-800">
                                            {{ $consultation->scheduled_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div>
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full {{ $consultation->status == 'completed' ? 'bg-green-100 text-green-800' : ($consultation->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($consultation->status) }}
                                        </span>
                                    </div>
                                    <div class="col-span-2 md:col-span-1 text-right">
                                        {{-- Nanti kita buat halaman detailnya --}}
                                        <a href="#"
                                            class="inline-block text-sm px-4 py-2 font-medium bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-md transition">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <p class="text-lg font-semibold text-slate-700">Anda belum memiliki jadwal konsultasi.
                                </p>
                            </div>
                        @endforelse
                    </div>
                @endif

                {{-- Pagination Links --}}
                <div class="mt-8">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
