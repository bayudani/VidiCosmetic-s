{{-- Menggunakan layout utama dari aplikasimu --}}
<x-app-layout>

    {{-- SEO & Judul Halaman --}}
    <x-slot name="title">
        Tentang Kami - Vd Cosmetics
    </x-slot>


    <div class="bg-white text-gray-800">

        {{-- Hero Section --}}
        <section class="bg-gradient-to-br from-pink-50 via-white to-pink-100 py-20 md:py-32 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
                xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23f8bbd9"
                fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]
                opacity-30"></div>

            <div class="max-w-7xl mx-auto px-4 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

                    <div class="text-center md:text-left">
                        <div
                            class="inline-flex items-center bg-pink-100 text-pink-600 px-4 py-2 rounded-full text-sm font-medium mb-6">
                            ✨ Dipercaya lebih dari 100+ beauty enthusiast
                        </div>
                        <h1 class="text-4xl md:text-6xl font-serif font-bold text-gray-900 leading-tight mb-6">
                            Panduan Kecantikan <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-pink-600">Terpercaya</span>
                            Kamu
                        </h1>
                        <p class="text-lg md:text-xl text-gray-600 max-w-xl mx-auto md:mx-0 leading-relaxed mb-8">
                            Di tengah lautan produk kosmetik, kami hadir untuk membantu anda memilih yang terbaik dan
                            100% original. Karena kecantikan sejati dimulai dari kepercayaan.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-star md:justify-start">
                            <a href="{{ route('shop') }}"
                                class="bg-pink-500 text-white px-8 py-4 rounded-xl font-semibold hover:bg-pink-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Jelajahi Produk
                            </a>
                            <a href="{{ route('consultation') }}"
                                class="border-2 border-pink-500 text-pink-500 px-8 py-4 rounded-xl font-semibold hover:bg-pink-500 hover:text-white transition-all duration-300">
                                Konsultasi
                            </a>
                        </div>
                    </div>

                    <div class="hidden md:flex justify-center items-center h-full" style="perspective: 1000px;"
                        x-data="{ rotateX: 0, rotateY: 0 }"
                        @mousemove="
                    const rect = $el.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;
                    const { width, height } = rect;
                    const rotateY = -1 * ((x - width / 2) / width * 20); // max rotasi 10 deg
                    const rotateX = (y - height / 2) / height * 20; // max rotasi 10 deg
                    $data.rotateY = rotateY.toFixed(2);
                    $data.rotateX = rotateX.toFixed(2);
                "
                        @mouseleave="
                    rotateX = 0;
                    rotateY = 0;
                ">
                        <img src="https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?q=80&w=1000"
                            alt="Produk Vd Cosmetics"
                            class="w-full max-w-md rounded-2xl shadow-2xl transition-transform duration-200 ease-out"
                            :style="`transform: rotateY(${rotateY}deg) rotateX(${rotateX}deg)`">
                    </div>
                </div>
            </div>
        </section>

        {{-- Story Section  --}}
        <livewire:about.aboutus />

        {{-- Enhanced Promise Section --}}
        {{-- <section class="bg-gradient-to-br from-pink-50 to-white py-20 px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-serif">Janji Kami Untukmu</h2>
                    <div class="w-24 h-1 bg-pink-500 mx-auto rounded-full mb-4"></div>
                    <p class="text-gray-600 max-w-2xl mx-auto">Tiga komitmen yang selalu kami pegang untuk memberikanmu pengalaman berbelanja terbaik dan kepercayaan penuh.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 border border-pink-100">
                        <div class="flex items-center justify-center h-20 w-20 bg-gradient-to-br from-pink-100 to-pink-200 rounded-2xl mx-auto mb-6 group-hover:from-pink-200 group-hover:to-pink-300 transition-all duration-300">
                            <svg class="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4M14 3v4m-2-2h4M17 17v4m-2-2h4M5 14h4m-2 2v-4m10 0h4m-2 2v-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Kurasi Terbaik</h3>
                        <p class="text-gray-600 leading-relaxed">Tim ahli kami secara ketat menyeleksi setiap item berdasarkan kualitas, review pengguna, dan standar keamanan internasional.</p>
                    </div>
                    
                    <div class="group p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 border border-pink-100">
                        <div class="flex items-center justify-center h-20 w-20 bg-gradient-to-br from-pink-100 to-pink-200 rounded-2xl mx-auto mb-6 group-hover:from-pink-200 group-hover:to-pink-300 transition-all duration-300">
                            <svg class="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">100% Original</h3>
                        <p class="text-gray-600 leading-relaxed">Kami menjamin semua produk yang kamu beli adalah asli dan berasal dari distributor resmi. Garansi uang kembali jika terbukti palsu.</p>
                    </div>
                    
                    <div class="group p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 border border-pink-100">
                        <div class="flex items-center justify-center h-20 w-20 bg-gradient-to-br from-pink-100 to-pink-200 rounded-2xl mx-auto mb-6 group-hover:from-pink-200 group-hover:to-pink-300 transition-all duration-300">
                            <svg class="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Layanan Sepenuh Hati</h3>
                        <p class="text-gray-600 leading-relaxed">Butuh rekomendasi? Tim beauty consultant kami siap membantu menemukan produk yang paling tepat sesuai jenis kulit dan kebutuhanmu.</p>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- New Section: Why Choose Us --}}
        <section class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4 md:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-serif">Mengapa Memilih Kami?</h2>
                    <div class="w-24 h-1 bg-pink-500 mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Pengiriman Cepat</h4>
                        <p class="text-gray-600 text-sm">Same day delivery untuk area Pasaman</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Harga Terjangkau</h4>
                        <p class="text-gray-600 text-sm">Harga kompetitif dengan kualitas premium</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Konsultasi</h4>
                        <p class="text-gray-600 text-sm">Beauty consultant siap membantu anda</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-pink-200 transition-colors duration-300">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Skin Analysis</h4>
                        <p class="text-gray-600 text-sm">Analisis kulit gratis untuk rekomendasi tepat</p>
                    </div>
                </div>
            </div>
        </section>


        {{-- Enhanced Founder Section --}}
        <livewire:about.owner />

        {{-- New Section: Customer Testimonials --}}
        {{-- <section class="py-20 bg-gradient-to-br from-pink-50 to-white">
            <div class="max-w-6xl mx-auto px-4 md:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-serif">Kata Mereka</h2>
                    <div class="w-24 h-1 bg-pink-500 mx-auto rounded-full mb-4"></div>
                    <p class="text-gray-600 max-w-2xl mx-auto">Kepercayaan pelanggan adalah prioritas utama kami</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150" alt="Customer" class="w-12 h-12 rounded-full object-cover mr-4">
                            <div>
                                <h4 class="font-semibold text-gray-900">Sarah M.</h4>
                                <div class="flex text-pink-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm italic">"Produknya selalu original dan packaging-nya rapi banget. Udah langganan di sini hampir 2 tahun!"</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150" alt="Customer" class="w-12 h-12 rounded-full object-cover mr-4">
                            <div>
                                <h4 class="font-semibold text-gray-900">Dina K.</h4>
                                <div class="flex text-pink-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm italic">"Tim konsultannya helpful banget! Direkomendasiin produk yang bener-bener cocok sama kulit aku."</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150" alt="Customer" class="w-12 h-12 rounded-full object-cover mr-4">
                            <div>
                                <h4 class="font-semibold text-gray-900">Maya R.</h4>
                                <div class="flex text-pink-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm italic">"Pengiriman cepat, packaging aman, dan yang paling penting produknya authentic. Recommended!"</p>
                    </div>
                </div>
            </div>
        </section> --}}



        {{-- New Section: Our Commitment --}}
        {{-- <section class="py-20 bg-pink-50">
            <div class="max-w-6xl mx-auto px-4 md:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-serif">Komitmen Kami</h2>
                    <div class="w-24 h-1 bg-pink-500 mx-auto rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Keamanan Produk</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Semua produk telah melewati uji keamanan dan terdaftar resmi di BPOM. Kami tidak pernah berkompromi dengan keamanan kulitmu.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Kepuasan Pelanggan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Kepuasan dan kepercayaanmu adalah prioritas utama. Tim customer service kami siap membantu 24/7 untuk memastikan pengalaman terbaikmu.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Sustainability</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Kami mendukung brand-brand yang peduli lingkungan dan menggunakan packaging ramah lingkungan untuk setiap pengiriman.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Inovasi Berkelanjutan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Kami terus berinovasi dalam pelayanan, mulai dari virtual try-on hingga AI skin analysis untuk memberikan rekomendasi yang lebih personal.
                        </p>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- Enhanced CTA Section --}}
        <livewire:about.about-c-t-a>

            <!-- Gallery Section -->
            <livewire:about.galeri />

            {{-- Contact Section --}}
            <livewire:about.contact />

    </div>

    {{-- Custom JavaScript untuk smooth scrolling --}}
    <script>
        // Smooth scrolling untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer untuk animasi saat scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe semua section
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>

    {{-- Custom CSS untuk animasi --}}
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Hover effect untuk cards */
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }
    </style>

</x-app-layout>
