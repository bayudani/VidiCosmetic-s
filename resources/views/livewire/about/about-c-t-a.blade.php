<div>
    <section class="bg-gradient-to-r from-pink-500 to-pink-600 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('...')] opacity-20"></div>
        <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-6 font-serif">Siap Menemukan Produk Pilihanmu?</h2>
            <p class="text-lg md:text-xl text-pink-100 mb-8 leading-relaxed">
                Jelajahi koleksi pilihan kami yang telah terbukti kualitasnya dan dicintai ribuan beauty enthusiast di
                seluruh Indonesia.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('shop') }}"
                    class="bg-white text-pink-500 font-bold py-4 px-8 rounded-xl text-lg hover:bg-pink-50 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    Jelajahi Produk Pilihan
                </a>
                <a href="{{ route('consultation') }}"
                    class="border-2 border-white text-white font-bold py-4 px-8 rounded-xl text-lg hover:bg-white hover:text-pink-500 transition-all duration-300">
                    Konsultasi dengan Beauty Consultant
                </a>
            </div>

            {{-- Trust indicators dengan data dinamis --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 pt-8 border-t border-pink-400">
                <div class="text-center">
                    <div class="text-2xl font-bold mb-1">{{ $totalCustomers }}+</div>
                    <div class="text-pink-200 text-sm">Happy Customers</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold mb-1">{{ $totalProducts }}+</div>
                    <div class="text-pink-200 text-sm">Produk Pilihan</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold mb-1">{{ $totalCategories }}+</div>
                    <div class="text-pink-200 text-sm">Kategori Produk</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold mb-1">{{ $totalSuccessfulTransactions }}+</div>
                    <div class="text-pink-200 text-sm">Transaksi Berhasil</div>
                </div>
            </div>
        </div>
    </section>
</div>
