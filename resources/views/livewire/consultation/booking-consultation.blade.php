<div>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 font-sans">
        <h1 class="text-3xl font-serif text-slate-900 text-center my-8">Booking Jadwal Konsultasi</h1>

        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md border">
            {{-- Pemilih Tanggal (UI BARU) --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-slate-800 border-b pb-4">Pilih Tanggal Tersedia</h2>
                <div class="flex flex-wrap gap-3 mt-6">
                    @forelse ($availableDates as $date)
                        <button 
                            type="button"
                            wire:click="selectDate('{{ $date->toDateString() }}')"
                            class="px-4 py-2 rounded-lg text-center font-semibold transition border-2
                                {{ $selectedDate == $date->toDateString() 
                                    ? 'bg-pink-500 text-white border-pink-500' 
                                    : 'bg-white text-gray-700 border-gray-200 hover:border-pink-300' }}">
                            {{-- Ganti format jadi translatedFormat --}}
                            <span class="block text-sm">{{ $date->translatedFormat('l') }}</span>
                            <span class="block text-lg">{{ $date->translatedFormat('d M') }}</span>
                        </button>
                    @empty
                        <div class="w-full text-center text-gray-500 bg-yellow-50 p-4 rounded-md">
                            <p>Maaf, tidak ada jadwal konsultasi yang tersedia dalam waktu dekat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Daftar Slot Waktu (Hanya muncul jika tanggal dipilih) --}}
            @if ($selectedDate)
                <div class="border-t pt-6">
                    {{-- Ganti format jadi translatedFormat --}}
                    <h2 class="text-xl font-semibold text-slate-800 border-b pb-4">Pilih Slot Waktu untuk {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d M Y') }}</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6">
                        @if ($scheduleInfo)
                            <div class="col-span-full text-center text-gray-500 bg-yellow-50 p-4 rounded-md">
                                <p>{{ $scheduleInfo }}</p>
                            </div>
                        @else
                            @forelse ($availableSlots as $slot)
                                @php
                                    $slotString = $slot->format('Y-m-d H:i:s');
                                    $isBooked = in_array($slotString, $bookedSlots);
                                    $isPast = $slot->isPast();
                                @endphp
                                
                                <button 
                                    type="button"
                                    wire:click="selectSlot('{{ $slotString }}')"
                                    @if($isBooked || $isPast) disabled @endif
                                    class="p-4 rounded-md text-center font-semibold transition
                                        @if($isBooked || $isPast) bg-gray-200 text-gray-400 cursor-not-allowed
                                        @elseif($selectedSlot == $slotString) bg-pink-500 text-white ring-2 ring-offset-2 ring-pink-500
                                        @else bg-pink-100 text-pink-700 hover:bg-pink-200 border border-pink-200 @endif">
                                    {{ $slot->format('H:i') }}
                                </button>
                            @empty
                                <p class="col-span-full text-center text-gray-500">Tidak ada slot tersedia untuk tanggal ini.</p>
                            @endforelse
                        @endif
                    </div>
                </div>

                {{-- Form Catatan & Tombol Submit (Hanya muncul jika slot dipilih) --}}
                @if ($selectedSlot)
                    <div class="mt-8 border-t pt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea id="notes" wire:model="notes" rows="3" placeholder="Contoh: Mau tanya soal skincare untuk kulit kering..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-md focus:border-pink-500 focus:ring-pink-500 outline-none"></textarea>

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
                @endif
            @endif
        </div>
    </div>
</div>