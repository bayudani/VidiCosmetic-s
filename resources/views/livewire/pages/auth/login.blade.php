<?php

// File: resources/views/livewire/pages/auth/login.blade.php (PHP Part)

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}; ?>

<!-- File: resources/views/livewire/pages/auth/login.blade.php (HTML Part) -->
<div class="bg-gray-50 font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-[480px] w-full">
            <a href="/" wire:navigate>
                {{-- Ganti H1 dengan tag img ini --}}
                <img src="{{ asset('assets/img/iconVD.png') }}" alt="VD Cosmetic's Logo" class="w-40 mb-8 mx-auto block" />
            </a>

            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                <h1 class="text-slate-900 text-center text-3xl font-semibold">Sign in</h1>
                
                <!-- Session Status -->
                <x-auth-session-status class="mt-4" :status="session('status')" />

                <form wire:submit="login" class="mt-12 space-y-6">
                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input wire:model="form.email" type="email" required class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 pr-8 rounded-md outline-pink-500" placeholder="Enter email" autofocus autocomplete="username" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24"><circle cx="10" cy="7" r="6"></circle><path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"></path></svg>
                        </div>
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                    </div>

                    <div>
                        <label class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input wire:model="form.password" type="password" required class="w-full text-slate-900 text-sm border border-slate-300 px-4 py-3 pr-8 rounded-md outline-pink-500" placeholder="Enter password" autocomplete="current-password" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128"><path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"></path></svg>
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                    </div>
                    
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center">
                            <input wire:model="form.remember" id="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-pink-600 focus:ring-pink-500 border-slate-300 rounded" />
                            <label for="remember-me" class="ml-3 block text-sm text-slate-900">
                                Remember me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" wire:navigate class="text-pink-600 hover:underline font-semibold">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="!mt-12">
                        <button type="submit" class="w-full py-2.5 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-pink-500 hover:bg-pink-600 focus:outline-none">
                            Sign in
                        </button>
                    </div>
                    <p class="text-slate-900 text-sm !mt-6 text-center">Don't have an account? <a href="{{ route('register') }}" wire:navigate class="text-pink-600 hover:underline ml-1 whitespace-nowrap font-semibold">Register here</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
