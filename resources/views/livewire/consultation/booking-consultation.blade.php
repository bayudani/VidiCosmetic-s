<div>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 font-sans">
        <h1 class="text-3xl font-serif text-slate-900 text-center my-8">Booking Jadwal Konsultasi</h1>

        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md border">
            {{-- Pemilih Tanggal --}}
            <div class="mb-8">
                <label for="date-picker" class="block text-sm font-medium text-gray-700 mb-2">Pilih Tanggal:</label>
                <input type="date" id="date-picker" wire:model.live="selectedDate" 
                       min="{{ now()->toDateString() }}"
                       class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
            </div>

            {{-- Daftar Slot Waktu --}}
            <div>
                <h2 class="text-xl font-semibold text-slate-800 border-b pb-4">Slot Waktu Tersedia untuk {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6">
                    @forelse ($availableSlots as $slot)
                        @php
                            $slotString = $slot->format('Y-m-d H:i:s');
                            $isBooked = in_array($slotString, $bookedSlots);
                        @endphp
                        
                        <button 
                            type="button"
                            wire:click="selectSlot('{{ $slotString }}')"
                            @if($isBooked) disabled @endif
                            class="p-4 rounded-md text-center font-semibold transition
                                   @if($isBooked) 
                                       bg-gray-200 text-gray-400 cursor-not-allowed
                                   @elseif($selectedSlot == $slotString)
                                       bg-pink-500 text-white ring-2 ring-offset-2 ring-pink-500
                                   @else 
                                       bg-pink-100 text-pink-700 hover:bg-pink-200 border border-pink-200
                                   @endif">
                            {{ $slot->format('H:i') }}
                        </button>
                    @empty
                        <p class="col-span-full text-center text-gray-500">Tidak ada slot tersedia untuk tanggal ini.</p>
                    @endforelse
                </div>
            </div>

            {{-- Form Catatan & Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea id="notes" wire:model="notes" rows="3" placeholder="Contoh: Mau tanya soal skincare untuk kulit kering..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none"></textarea>

                {{-- TOMBOL KIRIM BARU --}}
                <div class="mt-6 text-right">
                    <button type="button" 
                            wire:click="bookNow"
                            wire:loading.attr="disabled"
                            class="px-8 py-2.5 bg-pink-500 text-white font-semibold rounded-md hover:bg-pink-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="bookNow">Book Jadwal</span>
                        <span wire:loading wire:target="bookNow">Memproses...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Global Toast Notification (DITARUH LANGSUNG DI SINI) --}}
    <div x-data="{ show: false, message: '', type: 'success' }"
        @show-toast.window="
            message = $event.detail.message; 
            type = $event.detail.type || 'success';
            show = true; 
            setTimeout(() => show = false, 3000)
        "
        x-show="show"
        x-transition
        :class="{
            'bg-green-500': type === 'success',
            'bg-red-500': type === 'error'
        }"
        class="fixed top-24 right-5 text-white py-2 px-4 rounded-xl text-sm shadow-lg z-50"
        style="display: none;">
        <span x-text="message"></span>
    </div>

    {{-- Script Alpine.js (DITARUH LANGSUNG DI SINI) --}}
    <script src="[https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js](https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js)"></script>
</div>