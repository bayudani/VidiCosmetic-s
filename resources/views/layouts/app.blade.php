<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vd Cosmetics') }}</title>

    <!-- Google Fonts: Playfair Display for headings, Inter for body -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide-react@latest/dist/lucide-react.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/iconVD.png') }}">

    <script src="https://unpkg.com/lucide-react@latest/dist/lucide-react.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        /* Custom styles to extend Tailwind */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FEFBFB;
        }

        h1,
        h2,
        h3,
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .text-brand-pink {
            color: #E9A8B5;
        }

        .bg-brand-pink {
            background-color: #E9A8B5;
        }

        .bg-brand-pink-light {
            background-color: #FCEFF2;
        }

        .border-brand-pink {
            border-color: #E9A8B5;
        }

        .carousel-container {
            position: relative;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        @media (min-width: 768px) {
            .carousel-slide {
                min-width: 50%;
            }
        }

        @media (min-width: 1024px) {
            .carousel-slide {
                min-width: 25%;
            }
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <livewire:layout.navigation />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>



        <!-- Footer -->
        <livewire:layout.footer />
        {{-- notif tanpa redirect --}}

        @php
            // 1. Ambil data profil owner dari database
            $ownerProfile = \App\Models\OwnerProfile::first();

            // 2. Siapkan nomor fallback jika data tidak ada
            $ownerPhoneNumber = '6281234567890'; // Nomor default jika di database kosong

            // 3. Jika profil ada dan punya nomor telepon, gunakan nomor itu
            if ($ownerProfile && $ownerProfile->phone) {
                // Pastikan formatnya benar (misal: ganti 08 jadi 628)
                $phone = $ownerProfile->phone;
                if (substr($phone, 0, 1) === '0') {
                    $phone = '62' . substr($phone, 1);
                }
                // Hapus semua karakter selain angka
                $ownerPhoneNumber = preg_replace('/[^0-9]/', '', $phone);
            }

            $whatsappMessage = urlencode("Halo, saya tertarik dengan produk VD Cosmetic's.");
            $whatsappUrl = "https://wa.me/{$ownerPhoneNumber}?text={$whatsappMessage}";
        @endphp

        <!-- Tombol Chat WhatsApp -->
        <a href="{{ $whatsappUrl }}" target="_blank"
            class="fixed bottom-20 right-5 z-[999] bg-pink-500 text-white p-4 rounded-full shadow-lg hover:bg-pink-600 transition-transform transform hover:scale-110 flex justify-center items-center"
            title="Chat Admin">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 3C6.48 3 2 6.76 2 11c0 2.43 1.44 4.64 3.73 6.13-.12.88-.46 2.6-1.08 3.92 1.43-.35 3.07-1.01 4.15-1.6 1.08.3 2.27.45 3.5.45 5.52 0 10-3.76 10-8 0-4.24-4.48-8-10-8z" />
            </svg>
        </a>

        <!-- Tombol Back to Top -->
        <div id="backToTop" class="fixed bottom-5 right-5 hidden z-[999]">
            <button onclick="scrollToTop()"
                class="bg-pink-500 text-white p-3 rounded-full shadow-lg hover:bg-pink-600 transition-transform transform hover:scale-110"
                title="Back to Top">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>
        </div>

    </div>
    <div x-data="{ show: false, message: '' }"
        x-on:show-toast.window="
            message = $event.detail.message;
            show = true;
            setTimeout(() => show = false, 3000)
        "
        x-show="show" x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" style="display: none;"
        class="fixed top-24 right-5 z-50 rounded-xl bg-green-500 px-4 py-2 text-sm text-white shadow-lg">
        <p x-text="message"></p>
    </div>

    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" {{-- Durasinya bisa diatur --}}
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" style="display: none;"
            class="fixed top-24 right-5 z-50 rounded-xl bg-green-500 px-4 py-2 text-sm text-white shadow-lg">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    {{-- 👇 KODE BARU DITAMBAHKAN DI SINI 👇

    <a href="https://wa.me/6281234567890?text=Halo%20Vd%20Cosmetics,%20saya%20mau%20tanya-tanya%20produknya%20dong."
        target="_blank"
        class="fixed bottom-20 right-5 z-50 rounded-full bg-green-500 p-3 text-white shadow-lg transition-transform duration-300 ease-out hover:scale-110 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
        aria-label="Chat di WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.371-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01s-.521.074-.792.371c-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413z"/>
        </svg>
    </a>

    <button x-show="showBackToTop"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            style="display: none;"
            class="fixed bottom-5 right-5 z-50 rounded-full bg-brand-pink p-3 text-white shadow-lg transition-transform duration-300 ease-out hover:scale-110 hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-brand-pink focus:ring-offset-2"
            aria-label="Kembali ke atas">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
            <path d="m5 12 7-7 7 7"/><path d="M12 19V5"/>
        </svg>
    </button> --}}



    @livewireScripts

    <script>
        // Tombol Back to Top muncul setelah scroll
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) { // Muncul setelah scroll 300px
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        // Fungsi Scroll ke Atas
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

</body>

</html>
