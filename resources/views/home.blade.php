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
                    <button class="mt-8 px-8 py-3 bg-brand-pink text-white font-semibold rounded-md hover:bg-opacity-90 transition shadow-lg">
                        Shop Now
                    </button>
                </div>
                <!-- Image Content -->
                <div class="md:w-1/2">
                    <img src="https://placehold.co/600x400/FCEFF2/E9A8B5?text=Vd+Cosmetic's" alt="Skincare products" class="rounded-lg w-full">
                </div>
            </div>
        </section>

        <!-- Consultation Section -->
        
        <!-- New Arrivals Section -->
        <section class="py-16">
            <div class="container mx-auto px-6">
                <!-- Section Header -->
                <div class="flex justify-center items-center mb-10">
                    <div class="w-16 h-px bg-gray-300"></div>
                    <h2 class="mx-4 text-2xl md:text-3xl font-serif text-center">NEW ARRIVALS</h2>
                    <div class="w-16 h-px bg-gray-300"></div>
                </div>
                <p class="text-center text-gray-500 -mt-8 mb-12">See All</p>
                
                <!-- Product Carousel -->
                <div id="new-arrivals-carousel" class="carousel-container overflow-hidden">
                    <div class="carousel-track -mx-3">
                        <!-- Product Card 1 -->
                        <div class="carousel-slide px-3">
                            <div class="bg-white rounded-lg shadow-sm p-4 text-center relative">
                                <span class="absolute top-2 left-2 bg-pink-500 text-white text-xs font-bold px-2 py-1 rounded">-20%</span>
                                <img src="https://placehold.co/300x300/FADADD/DB7093?text=Product+1" alt="Product 1" class="w-full h-auto rounded-md mb-4">
                                <h3 class="font-semibold text-md">All-Around Safe Block Essence</h3>
                                <div class="flex justify-center my-1">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.446a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.539 1.118l-3.368-2.446a1 1 0 00-1.175 0l-3.368 2.446c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z"></path></svg>
                                </div>
                                <p class="text-xs text-gray-500">All-Around Safe Block Sun Milk SPF50+/PA+++</p>
                                <p class="font-bold my-2">$25</p>
                                <button class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-100 transition">Add to bag</button>
                            </div>
                        </div>
                        <!-- Product Card 2 -->
                        <div class="carousel-slide px-3">
                            <div class="bg-white rounded-lg shadow-sm p-4 text-center">
                                <img src="https://placehold.co/300x300/FADADD/DB7093?text=Product+2" alt="Product 2" class="w-full h-auto rounded-md mb-4">
                                <h3 class="font-semibold text-md">Super Aqua Snail Cream</h3>
                                <div class="flex justify-center my-1"></div>
                                <p class="text-xs text-gray-500">Skin-Reinforcement Gel Type Cream</p>
                                <p class="font-bold my-2">$25</p>
                                <button class="w-full py-2 border bg-brand-blue text-white rounded-md text-sm font-semibold hover:bg-gray-700 transition">Add to bag</button>
                            </div>
                        </div>
                        <!-- Product Card 3 -->
                        <div class="carousel-slide px-3">
                            <div class="bg-white rounded-lg shadow-sm p-4 text-center">
                                <img src="https://placehold.co/300x300/FADADD/DB7093?text=Product+3" alt="Product 3" class="w-full h-auto rounded-md mb-4">
                                <h3 class="font-semibold text-md">Clarifying Emulsion</h3>
                                <div class="flex justify-center my-1"></div>
                                <p class="text-xs text-gray-500">With Bija Seed Oil</p>
                                <p class="font-bold my-2">$25</p>
                                <button class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-100 transition">Add to bag</button>
                            </div>
                        </div>
                        <!-- Product Card 4 -->
                        <div class="carousel-slide px-3">
                            <div class="bg-white rounded-lg shadow-sm p-4 text-center">
                                <img src="https://placehold.co/300x300/FADADD/DB7093?text=Product+4" alt="Product 4" class="w-full h-auto rounded-md mb-4">
                                <h3 class="font-semibold text-md">Dewy Glow Jelly Cream</h3>
                                <div class="flex justify-center my-1"></div>
                                <p class="text-xs text-gray-500">With Jeju Cherry Blossom</p>
                                <p class="font-bold my-2">$25</p>
                                <button class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-100 transition">Add to bag</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <livewire:consultation.consultation />

        <!-- Best Sellers Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <!-- Section Header -->
                <div class="flex justify-center items-center mb-10">
                    <div class="w-16 h-px bg-gray-300"></div>
                    <h2 class="mx-4 text-2xl md:text-3xl font-serif text-center">BEST SELLERS</h2>
                    <div class="w-16 h-px bg-gray-300"></div>
                </div>
                <p class="text-center text-gray-500 -mt-8 mb-12">See All</p>

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Product Card 1 -->
                    <div class="bg-white rounded-lg p-4 text-center border">
                        <img src="https://placehold.co/300x300/EAEAEA/333333?text=Product+A" alt="Product A" class="w-full h-auto rounded-md mb-4">
                        <h3 class="font-semibold text-md">All-Around Safe Block Essence</h3>
                        <p class="text-xs text-gray-500">All-Around Safe Block Sun Milk SPF50+/PA+++</p>
                        <p class="font-bold my-2">$25</p>
                        <button class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-100 transition">Add to bag</button>
                    </div>
                    <!-- Product Card 2 -->
                    <div class="bg-white rounded-lg p-4 text-center border">
                        <a href="{{ route('detail') }}">
                        <img src="https://placehold.co/300x300/EAEAEA/333333?text=Product+B" alt="Product B" class="w-full h-auto rounded-md mb-4">
                        <h3 class="font-semibold text-md">Super Aqua Snail Cream</h3>
                        <p class="text-xs text-gray-500">Skin-Reinforcement Gel Type Cream</p>
                        <p class="font-bold my-2">$25</p>
                        <button class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-100 transition">Add to bag</button>
                        </a>
                    </div>
                    <!-- Product Card 3 -->
                    <div class="bg-white rounded-lg p-4 text-center border relative">
                        <span class="absolute top-2 left-2 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Top Rated</span>
                        <img src="https://placehold.co/300x300/EAEAEA/333333?text=Product+C" alt="Product C" class="w-full h-auto rounded-md mb-4">
                        <h3 class="font-semibold text-md">Clarifying Emulsion</h3>
                        <p class="text-xs text-gray-500">With Bija Seed Oil</p>
                        <p class="font-bold my-2">$25</p>
                        <button class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-100 transition">Add to bag</button>
                    </div>
                    <!-- Product Card 4 -->
                    <div class="bg-white rounded-lg p-4 text-center border">
                        <img src="https://placehold.co/300x300/EAEAEA/333333?text=Product+D" alt="Product D" class="w-full h-auto rounded-md mb-4">
                        <h3 class="font-semibold text-md">Dewy Glow Jelly Cream</h3>
                        <p class="text-xs text-gray-500">With Jeju Cherry Blossom</p>
                        <p class="font-bold my-2">$25</p>
                        <button class="w-full py-2 border border-gray-300 rounded-md text-sm font-semibold hover:bg-gray-100 transition">Add to bag</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Memanggil komponen footer --}}
    {{-- @include('livewire.layout.footer') --}}
</div>
</x-app-layout>