<div>
    <div class="relative flex min-h-screen">
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-30 lg:hidden hidden"></div>

        <div id="sidebar"
            class="fixed top-0 left-0 w-full max-w-[300px] shrink-0 bg-white shadow-md px-6 sm:px-8 h-screen py-6 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 lg:h-auto overflow-y-auto">

            <div class="flex items-center border-b border-gray-300 pb-2 mb-6">
                <h3 class="text-slate-900 text-lg font-semibold">Filter</h3>

                <button id="close-sidebar-btn" type="button" class="lg:hidden text-slate-700 ml-auto cursor-pointer p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18 6l-12 12"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </button>
                <button type="button"
                    class="text-sm text-red-500 font-semibold ml-auto cursor-pointer hidden lg:block">Clear all</button>
            </div>

            <div>
                <h6 class="text-slate-900 text-sm font-semibold">Brand</h6>
                <div class="flex px-3 py-1.5 rounded-md border border-gray-300 bg-gray-100 overflow-hidden mt-2">
                    <input type="email" placeholder="Search brand"
                        class="w-full bg-transparent outline-none text-gray-900 text-sm" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" class="w-3 fill-gray-600">
                        <path
                            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                        </path>
                    </svg>
                </div>
                <ul class="mt-6 space-y-4">
                    <li class="flex items-center gap-3"><input id="zara" type="checkbox"
                            class="w-4 h-4 cursor-pointer" /><label for="zara"
                            class="text-slate-600 font-medium text-sm cursor-pointer">Zara</label></li>
                    <li class="flex items-center gap-3"><input id="hm" type="checkbox"
                            class="w-4 h-4 cursor-pointer" /><label for="hm"
                            class="text-slate-600 font-medium text-sm cursor-pointer">H&M</label></li>
                    <li class="flex items-center gap-3"><input id="uniqlo" type="checkbox"
                            class="w-4 h-4 cursor-pointer" /><label for="uniqlo"
                            class="text-slate-600 font-medium text-sm cursor-pointer">Uniqlo</label></li>
                </ul>
            </div>
            <hr class="my-6 border-gray-300" />
            <div>
                <h6 class="text-slate-900 text-sm font-semibold">Size</h6>
                <div class="flex flex-wrap gap-3 mt-4">
                    <button type="button"
                        class="cursor-pointer border border-gray-300 hover:border-pink-500 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">XS</button>
                    <button type="button"
                        class="cursor-pointer border border-gray-300 hover:border-pink-500 rounded-md text-[13px] text-slate-600 font-medium py-1 px-1 min-w-14">S</button>
                </div>
            </div>
            <hr class="my-6 border-gray-300" />
        </div>

        <div class="w-full p-6">
            <button id="open-sidebar-btn"
                class="lg:hidden mb-6 flex items-center gap-2 bg-pink-500 text-white font-semibold py-2 px-4 rounded-md shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L13 10.414V15a1 1 0 01-.293.707l-2 2A1 1 0 019 17v-6.586L4.293 6.707A1 1 0 014 6V3z"
                        clip-rule="evenodd" />
                </svg>
                Show Filters
            </button>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm animate-pulse">
                    <div class="bg-gray-200 w-full h-48"></div>
                    <div class="p-4">
                        <div class="bg-gray-200 h-5 w-3/4 rounded-md"></div>
                        <div class="bg-gray-200 h-4 w-1/2 rounded-md mt-3"></div>
                        <div class="bg-gray-200 h-6 w-1/3 rounded-md mt-4"></div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm animate-pulse">
                    <div class="bg-gray-200 w-full h-48"></div>
                    <div class="p-4">
                        <div class="bg-gray-200 h-5 w-3/4 rounded-md"></div>
                        <div class="bg-gray-200 h-4 w-1/2 rounded-md mt-3"></div>
                        <div class="bg-gray-200 h-6 w-1/3 rounded-md mt-4"></div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm animate-pulse">
                    <div class="bg-gray-200 w-full h-48"></div>
                    <div class="p-4">
                        <div class="bg-gray-200 h-5 w-3/4 rounded-md"></div>
                        <div class="bg-gray-200 h-4 w-1/2 rounded-md mt-3"></div>
                        <div class="bg-gray-200 h-6 w-1/3 rounded-md mt-4"></div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm animate-pulse">
                    <div class="bg-gray-200 w-full h-48"></div>
                    <div class="p-4">
                        <div class="bg-gray-200 h-5 w-3/4 rounded-md"></div>
                        <div class="bg-gray-200 h-4 w-1/2 rounded-md mt-3"></div>
                        <div class="bg-gray-200 h-6 w-1/3 rounded-md mt-4"></div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm animate-pulse">
                    <div class="bg-gray-200 w-full h-48"></div>
                    <div class="p-4">
                        <div class="bg-gray-200 h-5 w-3/4 rounded-md"></div>
                        <div class="bg-gray-200 h-4 w-1/2 rounded-md mt-3"></div>
                        <div class="bg-gray-200 h-6 w-1/3 rounded-md mt-4"></div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm animate-pulse">
                    <div class="bg-gray-200 w-full h-48"></div>
                    <div class="p-4">
                        <div class="bg-gray-200 h-5 w-3/4 rounded-md"></div>
                        <div class="bg-gray-200 h-4 w-1/2 rounded-md mt-3"></div>
                        <div class="bg-gray-200 h-6 w-1/3 rounded-md mt-4"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('open-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        openBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);
    </script>
</div>
