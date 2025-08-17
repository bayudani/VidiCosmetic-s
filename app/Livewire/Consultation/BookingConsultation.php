<?php

namespace App\Livewire\Consultation;

use App\Models\Consultation;
use App\Models\schedules;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class BookingConsultation extends Component
{
    public $availableSlots = [];
    public $bookedSlots = [];
    public $selectedDate;
    public $notes = '';
    // Properti baru untuk menyimpan slot yang dipilih user
    public ?string $selectedSlot = null;
    public ?string $scheduleInfo = null;
    public $availableDates = []; // Menyimpan tanggal-tanggal yang tersedia
    // public ?string $selectedDate = null;

    public function mount()
    {
        $this->loadAvailableDates();
    }

    public function loadAvailableDates()
    {
        $this->availableDates = [];
        $activeDays = schedules::where('is_active', true)->pluck('day_of_week')->toArray();
        
        if (empty($activeDays)) return;

        $date = Carbon::today();
        $endDate = Carbon::today()->addDays(14); // Cari untuk 14 hari ke depan

        while ($date <= $endDate && count($this->availableDates) < 7) { // Ambil maksimal 7 hari tersedia
            if (in_array($date->dayOfWeek, $activeDays)) {
                $this->availableDates[] = $date->copy();
            }
            $date->addDay();
        }
    }

    // Fungsi ini dijalankan setiap kali $selectedDate berubah
    public function selectDate(string $dateString)
    {
        $this->selectedDate = $dateString;
        $this->selectedSlot = null; // Reset pilihan slot
        $this->loadSlots();
    }

    public function loadSlots()
    {
        $this->availableSlots = [];
        $this->scheduleInfo = null;
        $selectedCarbonDate = Carbon::parse($this->selectedDate);

        $schedule = schedules::where('day_of_week', $selectedCarbonDate->dayOfWeek)
                            ->where('is_active', true)
                            ->first();

        if ($schedule) {
            $startTime = $selectedCarbonDate->copy()->setTimeFromTimeString($schedule->start_time);
            $endTime = $selectedCarbonDate->copy()->setTimeFromTimeString($schedule->end_time);

            while ($startTime < $endTime) {
                $this->availableSlots[] = $startTime->copy();
                $startTime->addHour();
            }
        } else {
            $this->scheduleInfo = 'Jadwal tidak ditemukan untuk hari ini.';
        }

        $this->bookedSlots = Consultation::whereDate('scheduled_at', $this->selectedDate)
                                        ->pluck('scheduled_at')
                                        ->map(fn ($datetime) => $datetime->format('Y-m-d H:i:s'))
                                        ->toArray();
    }

    // Fungsi ini sekarang hanya untuk memilih slot
    public function selectSlot(string $datetime)
    {
        $this->selectedSlot = $datetime;
    }

    // Fungsi ini dipanggil oleh tombol "Book Now"
    public function bookNow()
    {
        // Cek login
        if (!Auth::check()) {
            return $this->redirect(route('login'));
        }

        // Pastikan slot sudah dipilih
        if (!$this->selectedSlot) {
            $this->dispatch('show-toast', message: 'Silakan pilih slot waktu terlebih dahulu.', type: 'error');
            return;
        }

        $this->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        // Cek ulang untuk mencegah double book
        $isBooked = Consultation::where('scheduled_at', $this->selectedSlot)->exists();
        if ($isBooked) {
            $this->dispatch('show-toast', message: 'Oops! Slot ini barusan saja dipesan.', type: 'error');
            $this->loadSlots(); // Refresh slot
            $this->selectedSlot = null; // Reset pilihan
            return;
        }

        // Simpan booking ke database
        Consultation::create([
            'user_id' => Auth::id(),
            'scheduled_at' => $this->selectedSlot,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        // Kirim notifikasi sukses
        $this->dispatch('show-toast', message: 'Jadwal konsultasi berhasil dibooking!');
        $this->loadSlots(); // Refresh slot setelah booking
        $this->selectedSlot = null; // Reset pilihan
        $this->notes = ''; // Kosongkan catatan
    }

    public function render()
    {
        return view('livewire.consultation.booking-consultation');
    }
}
