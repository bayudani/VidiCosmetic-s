<div>
    <section id="story" class="py-20 px-4 md:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-serif">Cerita Kami</h2>
                <div class="w-24 h-1 bg-pink-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Foto di kiri -->
                <div class="relative order-1 lg:order-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-pink-200 to-pink-300 rounded-2xl transform rotate-3">
                    </div>
                    <img src="{{ asset('assets/img/iconVD.png') }}" 
                        alt="Etalase Produk Pilihan Vd Cosmetics"
                        class="relative rounded-2xl shadow-2xl w-full h-auto transform -rotate-1 hover:rotate-0 transition-transform duration-500">
                </div>

                <!-- Teks di kanan -->
                <div class="space-y-6 order-2 lg:order-2">
                    <h3 class="text-2xl font-bold text-pink-500 mb-4 font-serif">Kenapa Vd Cosmetics?</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pernah merasa bingung memilih produk yang tepat? Atau khawatir dengan keaslian produk yang
                        beredar online? Kami juga pernah merasakan hal yang sama. Vd Cosmetics lahir dari keresahan itu.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Kami bukan sekadar toko, kami adalah <strong class="text-pink-500">teman terpercayamu</strong>
                        dalam perjalanan kecantikan. Setiap produk yang kami pilih telah melalui proses kurasi ketat
                        untuk memastikan kualitas dan keasliannya.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Misi kami sederhana: menyediakan satu tempat di mana kamu bisa menemukan produk-produk kosmetik
                        pilihan dari brand ternama hingga brand lokal potensial yang sudah kami pastikan 100% original.
                    </p>

                    <!-- Achievement Stats -->
                    <div class="grid grid-cols-2 gap-6 mt-8 pt-8 border-t border-pink-100">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-pink-500 mb-2">{{$totalUsers}}</div>
                            <div class="text-gray-600 text-sm">Pelanggan Setia</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-pink-500 mb-2">{{$totalProducts}}</div>
                            <div class="text-gray-600 text-sm">Produk Pilihan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
