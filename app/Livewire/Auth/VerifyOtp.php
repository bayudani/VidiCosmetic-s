<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;


#[Layout('layouts.app')]

class VerifyOtp extends Component
{
    public string $otp_code = '';
    public ?string $email = '';

    public function mount(): void
    {
        $this->email = session('email_for_verification');
        if (!$this->email) {
            $this->redirect(route('register'));
        }
    }

    public function verifyOtp(): void
    {
        $this->validate([
            'otp_code' => ['required', 'numeric', 'digits:6'],
        ]);

        $user = User::where('email', $this->email)
            ->where('otp_code', $this->otp_code)
            ->where('otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            $this->addError('otp_code', 'Kode OTP tidak valid atau sudah kedaluwarsa.');
            return;
        }

        // Jika OTP benar, update user
        $user->is_verified = true;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->email_verified_at = now();
        $user->save();

        // Hapus session dan login-kan user
        session()->forget('email_for_verification');
        Auth::login($user, true);

        $this->redirect(route('home', absolute: false), navigate: true);
    }

    // Fungsi untuk kirim ulang OTP (sudah dilengkapi)
    public function resendOtp()
    {
        $user = User::where('email', $this->email)->first();

        if ($user) {
            // 1. Buat kode OTP baru
            $otpCode = rand(100000, 999999);

            // 2. Update OTP dan waktu kedaluwarsa di database
            $user->otp_code = $otpCode;
            $user->otp_expires_at = now()->addMinutes(10);
            $user->save();

            // 3. Kirim ulang email berisi OTP
            try {
                Mail::to($user->email)->send(new SendOtpMail($otpCode));
                // 4. Kirim notifikasi sukses
                $this->dispatch('show-toast', message: 'Kode OTP baru telah dikirim!');
            } catch (\Exception $e) {
                // 4. Kirim notifikasi error jika email gagal
                $this->dispatch('show-toast', message: 'Gagal mengirim ulang kode OTP.', type: 'error');
            }
        }
    }


    public function render()
    {
        return view('livewire.auth.verify-otp');
    }
}
