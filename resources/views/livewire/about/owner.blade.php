<div>
    <section class="py-20 px-4 md:px-8 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-pink-50 to-white rounded-3xl p-8 md:p-12 shadow-xl">
                <div class="text-center">
                    <div class="relative inline-block mb-8">
                        <img src="{{ $owner->photo ? Storage::url($owner->photo) : '[https://placehold.co/688x800/FADADD/DB7093?text=Owner+Photo](https://placehold.co/688x800/FADADD/DB7093?text=Owner+Photo)' }}"
                             alt="Foto {{ $owner->name }}""
                            class="w-32 h-32 rounded-full mx-auto border-4 border-pink-300 object-cover shadow-lg">
                        <div
                            class="absolute -bottom-2 -right-2 w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 font-serif mb-2">{{$owner->name}}</h2>
                    <p class="text-pink-500 mb-6 font-medium">Owner</p>

                    <blockquote class="text-lg md:text-xl italic text-gray-600 relative px-4 md:px-8 mb-8">
                        <span class="absolute top-0 left-0 text-6xl text-pink-200 font-serif leading-none">"</span>
                        <span class="relative z-10">{{$owner->quotes}}</span>
                        <span
                            class="absolute bottom-0 right-0 text-6xl text-pink-200 font-serif leading-none transform rotate-180">"</span>
                    </blockquote>

                    {{-- <div class="grid grid-cols-3 gap-6 text-center">
                            <div>
                                <div class="text-2xl font-bold text-pink-500">5+</div>
                                <div class="text-gray-600 text-sm">Tahun Pengalaman</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-pink-500">50+</div>
                                <div class="text-gray-600 text-sm">Brand Partner</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-pink-500">98%</div>
                                <div class="text-gray-600 text-sm">Customer Satisfaction</div>
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </section>
</div>
