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
            \Log::error($e->getMessage());    }

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

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
