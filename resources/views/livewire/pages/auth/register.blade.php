<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail; // <-- 1. Import Mail
use App\Mail\SendOtpMail; // <-- 2. Import Mailable yang akan kita buat

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Buat user baru
        $user = User::create($validated);

        // Kasih role 'pembeli'
        $user->assignRole('pembeli');

        // --- LOGIKA OTP DIMULAI DI SINI ---

        // 1. Buat kode OTP 6 digit
        $otpCode = rand(100000, 999999);

        // 2. Simpan OTP dan waktu kedaluwarsa ke database
        $user->otp_code = $otpCode;
        $user->otp_expires_at = now()->addMinutes(10); // OTP berlaku 10 menit
        $user->save();

        // 3. Kirim email berisi OTP ke user
        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        // 4. Simpan email di session untuk halaman verifikasi
        session(['email_for_verification' => $user->email]);

        // 5. Arahkan ke halaman verifikasi OTP (bukan langsung login)
        $this->redirect(route('verfiy-otp'), navigate: true);

        try {
            Mail::to($user->email)->send(new SendOtpMail($otpCode));
        } catch (\Exception $e) {
            // Paksa Laravel buat nampilin errornya
            dd($e->getMessage());
        }
    }
}; ?>

<div class="bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-[480px] w-full">
            <a href="/" wire:navigate>
                <img src="{{ asset('assets/img/iconVD.png') }}" alt="VD Cosmetic's Logo" class="w-40 mb-8 mx-auto block" />
            </a>

            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                <h1 class="text-slate-900 text-center text-3xl font-semibold">Create an Account</h1>
                
                <form wire:submit="register" class="mt-12 space-y-6">
                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Full Name</label>
                        <div class="relative flex items-center">
                            <input wire:model="name" type="text" required class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 rounded-md outline-pink-500" placeholder="Enter full name" autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input wire:model="email" type="email" required class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 rounded-md outline-pink-500" placeholder="Enter email" autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input wire:model="password" type="password" required class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 rounded-md outline-pink-500" placeholder="Enter password" autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Confirm Password</label>
                        <div class="relative flex items-center">
                            <input wire:model="password_confirmation" type="password" required class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 rounded-md outline-pink-500" placeholder="Confirm password" autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="!mt-12">
                        <button type="submit" class="w-full py-2.5 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-pink-500 hover:bg-pink-600 focus:outline-none">
                            Register
                        </button>
                    </div>
                    <p class="text-slate-900 text-sm !mt-6 text-center">Already have an account? <a href="{{ route('login') }}" wire:navigate class="text-pink-600 hover:underline ml-1 whitespace-nowrap font-semibold">Sign in here</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
