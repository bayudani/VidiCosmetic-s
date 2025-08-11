<?php
namespace App\Livewire\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class VerifyOtp extends Component
{
    public $otp;
    public $email;

    public function mount()
    {
        $this->email = session('email_for_verification');
        if (!$this->email) {
            return redirect()->route('register');
        }
    }

    public function verify()
    {
        $this->validate(['otp' => 'required|numeric|digits:6']);

        $user = User::where('email', $this->email)
                    ->where('otp_code', $this->otp)
                    ->where('otp_expires_at', '>', now())
                    ->first();

        if ($user) {
            // OTP benar dan belum kedaluwarsa
            $user->is_verified = true;
            $user->email_verified_at = now();
            $user->otp_code = null; // Hapus OTP setelah berhasil
            $user->otp_expires_at = null;
            $user->save();

            Auth::login($user);
            session()->forget('email_for_verification');

            return redirect()->route('dashboard'); // atau ke halaman utama
        } else {
            // OTP salah atau sudah kedaluwarsa
            $this->addError('otp', 'Kode OTP tidak valid atau sudah kedaluwarsa.');
        }
    }

    public function render()
    {
        return view('livewire.auth.verify-otp');
    }
}