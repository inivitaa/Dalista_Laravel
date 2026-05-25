<div class="w-72 min-h-screen h-screen sticky top-0 bg-white border-r border-gray-100 shadow-sm p-5 flex flex-col">

    <!-- LOGO -->
    <div class="flex items-center gap-3 border-b border-gray-100 pb-5 mb-6">

        <img src="{{ asset('images/logo-dalista.jpg') }}"
            class="w-12 h-12 rounded-2xl object-cover shadow-sm">

        <div>

            <img src="{{ asset('images/logo-dalista-text.jpg') }}"
                class="h-7 object-contain">

            <p class="text-sm text-gray-400">
                Portal Pengunjung
            </p>

        </div>

    </div>

    <!-- MENU -->
    <div class="space-y-2">

        <!-- FORM -->
        <a href="/form"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300

            {{ request()->is('form') 
                ? 'bg-green-50 text-green-600 font-semibold shadow-sm' 
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-lg">
                👤
            </span>

            <span>
                Pendaftaran Tamu
            </span>

        </a>

        <!-- STATUS -->
        <a href="/status"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300

            {{ request()->is('status') 
                ? 'bg-green-50 text-green-600 font-semibold shadow-sm' 
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-lg">
                🔔
            </span>

            <span>
                Status Pengajuan
            </span>

        </a>

        <!-- SURVEY -->
        <a href="/survey"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300

            {{ request()->is('survey') 
                ? 'bg-green-50 text-green-600 font-semibold shadow-sm' 
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-lg">
                📋
            </span>

            <span>
                Survei
            </span>

        </a>

    </div>

    <!-- FOOTER -->
    <div class="mt-auto pt-5 border-t border-gray-100">

        <p class="text-xs text-gray-400 text-center">

            © {{ date('Y') }} DALISTA <br>
            Digitalisasi Layanan Registrasi Tamu

        </p>

    </div>

</div>