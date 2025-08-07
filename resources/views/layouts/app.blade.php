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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide-react@latest/dist/lucide-react.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/iconVD.png') }}">

     <script src="https://unpkg.com/lucide-react@latest/dist/lucide-react.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>


    <style>
        /* Custom styles to extend Tailwind */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FEFBFB;
        }
        h1, h2, h3, .font-serif {
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
    </div>
</body>

</html>
