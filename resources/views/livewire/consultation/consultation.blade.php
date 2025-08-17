<div>
    {{-- Hanya tampilkan section ini jika ada data profil --}}
    @if ($profile)
        <section class="py-16 md:py-24">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

                    <div class="relative w-full max-w-md mx-auto md:max-w-full">
                        {{-- Gambar dinamis dari database --}}
                        <img src="{{ $profile->photo ? Storage::url($profile->photo) : '[https://placehold.co/688x800/FADADD/DB7093?text=Owner+Photo](https://placehold.co/688x800/FADADD/DB7093?text=Owner+Photo)' }}"
                             alt="Foto {{ $profile->name }}" class="w-full h-auto object-cover rounded-lg shadow-lg aspect-[3/4]">
                    </div>

                    <div class="text-center md:text-left">
                        <svg class="w-12 h-12 text-gray-300 mb-2 mx-auto md:mx-0" xmlns="[http://www.w3.org/2000/svg](http://www.w3.org/2000/svg)" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9.983 3v7.391c0 2.908-2.352 5.261-5.261 5.261h-.722v-3.322c1.151 0 2.081-.93 2.081-2.081v-7.25h3.902zm10.017 0v7.391c0 2.908-2.352 5.261-5.261 5.261h-.722v-3.322c1.151 0 2.081-.93 2.081-2.081v-7.25h3.902z" />
                        </svg>

                        <p class="text-sm uppercase tracking-[0.2em] text-gray-500 mb-2">KONSULTASI KECANTIKAN</p>

                        <h2 class="font-serif text-4xl md:text-5xl font-bold tracking-tight text-[#333]">
                            TEMUKAN SOLUSI IDEALMU
                        </h2>

                        <p class="mt-4 text-gray-600 leading-relaxed max-w-lg mx-auto md:mx-0">
                            Setiap individu itu unik. Tim ahli kecantikan kami siap membantu menemukan perawatan dan produk yang paling sesuai dengan kebutuhan kulitmu. Dapatkan rekomendasi personal untuk hasil yang maksimal.
                        </p>

                        <a href="{{ route('consultation') }}" wire:navigate
                           class="mt-8 inline-block bg-pink-500 text-white font-semibold py-3 px-10 rounded-full hover:bg-pink-600 transition-colors shadow-md hover:shadow-lg">
                            Daftar Konsultasi Sekarang
                        </a>
                    </div>

                </div>
            </div>
        </section>
    @endif
</div>