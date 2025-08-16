<?php

namespace App\Livewire\Consultation;

use App\Models\Consultation;
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

    public function mount()
    {
        // Set tanggal default ke hari ini
        $this->selectedDate = Carbon::today()->toDateString();
        $this->loadSlots();
    }

    // Fungsi ini dijalankan setiap kali $selectedDate berubah
    public function updatedSelectedDate()
    {
        $this->selectedSlot = null; // Reset pilihan slot jika ganti tanggal
        $this->loadSlots();
    }

    public function loadSlots()
    {
        // 1. Tentukan slot waktu yang tersedia (misal: jam 9 pagi - 5 sore)
        $this->availableSlots = [];
        $startTime = Carbon::parse($this->selectedDate)->setHour(9);
        $endTime = Carbon::parse($this->selectedDate)->setHour(17);

        while ($startTime <= $endTime) {
            $this->availableSlots[] = $startTime->copy();
            $startTime->addHour();
        }

        // 2. Ambil semua slot yang sudah dibooking pada tanggal yang dipilih
        $this->bookedSlots = Consultation::whereDate('scheduled_at', $this->selectedDate)
            ->pluck('scheduled_at')
            ->map(function ($datetime) {
                return $datetime->format('Y-m-d H:i:s');
            })
            ->toArray();
    }

    public function selectSlot(string $datetime)
    {
        $this->selectedSlot = $datetime;
    }

    public function bookNow()
    {
        if (!Auth::check()) {
            return $this->redirect(route('login'));
        }

        if (!$this->selectedSlot) {
            $this->dispatch('show-toast', message: 'Silakan pilih slot waktu terlebih dahulu.', type: 'error');
            return;
        }

        $this->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        
        $isBooked = Consultation::where('scheduled_at', $this->selectedSlot)->exists();
        if ($isBooked) {
            $this->dispatch('show-toast', message: 'Oops! Slot ini barusan saja dipesan.', type: 'error');
            $this->loadSlots(); 
            $this->selectedSlot = null; 
            return;
        }

        
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
