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

<header class="bg-white py-4 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-serif font-bold text-gray-900" wire:navigate>VD Cosmetic's</a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8 text-sm font-medium tracking-wider uppercase">
            <a href="{{ route('shop') }}" class="text-gray-600 hover:text-brand-pink transition">Shop All</a>
            <a href="#" class="text-gray-600 hover:text-brand-pink transition">Bestsellers</a>
            <a href="#" class="text-gray-600 hover:text-brand-pink transition">Collection</a>
            <a href="#" class="text-gray-600 hover:text-brand-pink transition">About Us</a>
            <a href="#" class="text-gray-600 hover:text-brand-pink transition">Blog</a>
        </nav>

        <!-- Header Icons -->
        <div class="flex items-center space-x-5">
            <a href="#" class="text-gray-600 hover:text-brand-pink transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-search">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </a>
            <a href="#" class="text-gray-600 hover:text-brand-pink transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-user">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </a>
            <a href="{{ route('cart') }}" class="text-gray-600 hover:text-brand-pink transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shopping-cart">
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                </svg>
            </a>
        </div>
    </div>
</header>
