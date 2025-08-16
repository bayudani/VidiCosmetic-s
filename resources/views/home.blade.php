{{-- resources/views/livewire/home.blade.php --}}
{{-- Ini adalah file view untuk komponen Livewire 'Home' kamu --}}
<x-app-layout>
    <div>
        {{-- Memanggil komponen navigasi --}}
        {{-- @include('livewire.layout.navigation') --}}

        <!-- Main Content -->
        <main>
            <!-- Hero Section -->
            <section class="bg-brand-pink-light">
                <div class="container mx-auto px-6 py-12 md:py-24 flex flex-col md:flex-row items-center">
                    <!-- Text Content -->
                    <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            DISCOVER YOUR INNER BEAUTY WITH VD COSMETIC'S
                        </h1>
                        <p class="mt-4 text-lg text-gray-600">
                            Great gift for yourself and loved ones
                        </p>
                        <button
                            class="mt-8 px-8 py-3 bg-brand-pink text-white font-semibold rounded-md hover:bg-opacity-90 transition shadow-lg">
                            Shop Now
                        </button>
                    </div>
                    <!-- Image Content -->
                    <div class="md:w-1/2">
                        <img src="https://placehold.co/600x400/FCEFF2/E9A8B5?text=Vd+Cosmetic's" alt="Skincare products"
                            class="rounded-lg w-full">
                    </div>
                </div>
            </section>

            <!-- Consultation Section -->

            <!-- New Arrivals Section -->
            <livewire:product.new-product />
            {{-- end new arrivals --}}

            <livewire:consultation.consultation />

            <!-- Best Sellers Section -->
            <livewire:product.product-best-seller />
            {{-- end best sellers --}}
        </main>

        {{-- Memanggil komponen footer --}}
        {{-- @include('livewire.layout.footer') --}}
    </div>
</x-app-layout>
