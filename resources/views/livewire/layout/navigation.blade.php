<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

{{-- 
    Kita pakai Alpine.js untuk handle state buka/tutup menu.
    - mobileMenuOpen: untuk menu hamburger di mobile.
    - profileDropdownOpen: untuk dropdown profil di desktop.
--}}
<header x-data="{ mobileMenuOpen: false, profileDropdownOpen: false }" @keydown.escape.window="mobileMenuOpen = false; profileDropdownOpen = false"
    class="bg-white py-4 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-serif font-bold text-gray-900" wire:navigate>VD Cosmetic's</a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8 text-sm font-medium tracking-wider uppercase">
            <a href="{{ route('shop') }}" class="text-gray-600 hover:text-pink-500 transition" wire:navigate>Shop All</a>
            <a href="#" class="text-gray-600 hover:text-pink-500 transition">Bestsellers</a>
            <a href="#" class="text-gray-600 hover:text-pink-500 transition">Collection</a>
            <a href="{{ route('profile') }}" class="text-gray-600 hover:text-pink-500 transition">About Us</a>
            <a href="#" class="text-gray-600 hover:text-pink-500 transition">Blog</a>
        </nav>

        <!-- Header Icons & Mobile Menu Button -->
        <div class="flex items-center space-x-4">
            <!-- Desktop Icons -->
            <div class="hidden md:flex items-center space-x-5">
                <a href="#" class="text-gray-600 hover:text-pink-500 transition">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                </a>

                <!-- Auth Check untuk Ikon User (Desktop) -->
                @auth
                    <div class="relative">
                        <!-- Tombol untuk buka dropdown -->
                        <button @click="profileDropdownOpen = !profileDropdownOpen"
                            class="text-gray-600 hover:text-pink-500 transition focus:outline-none">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </button>
                        <!-- Panel Dropdown -->
                        <div x-show="profileDropdownOpen" @click.away="profileDropdownOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5"
                            style="display: none;">
                            <div class="px-4 py-2 text-sm text-gray-700">Hi, {{ Auth::user()->name }}</div>
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                wire:navigate>Profil Saya</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Histori
                                Pesanan</a>
                            <button wire:click="logout"
                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('cart') }}" class="text-gray-600 hover:text-pink-500 transition" wire:navigate>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="8" cy="21" r="1" />
                            <circle cx="19" cy="21" r="1" />
                            <path
                                d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm rounded-full font-medium cursor-pointer tracking-wide text-slate-900 border border-brand-pink bg-transparent hover:bg-brand-pink hover:text-white transition-all"
                        wire:navigate>
                        Login
                    </a>
                @endauth


            </div>

            <!-- Tombol Hamburger (Mobile) -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="text-gray-600 hover:text-pink-500 focus:outline-none">
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Panel Mobile Menu -->
    <div x-show="mobileMenuOpen" class="md:hidden" style="display: none;">
        <nav class="px-2 pt-2 pb-4 space-y-1 sm:px-3 border-t">
            <a href="{{ route('shop') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500"
                wire:navigate>Shop All</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500">Bestsellers</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500">Collection</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500">About
                Us</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500">Blog</a>

            <!-- Auth Check untuk Mobile Menu -->
            <div class="border-t border-gray-200 pt-4 mt-4">
                @auth
                    <div class="flex items-center px-3">
                        <div>
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500"
                            wire:navigate>Profil Saya</a>
                        <a href="{{ route('cart') }}"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500"
                            wire:navigate>Keranjang</a>
                        <a href="#"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500">Histori
                            Pesanan</a>
                        <button wire:click="logout"
                            class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500">
                            Logout
                        </button>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500"
                        wire:navigate>Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-pink-500"
                        wire:navigate>Register</a>
                @endauth
            </div>
        </nav>
    </div>
</header>
