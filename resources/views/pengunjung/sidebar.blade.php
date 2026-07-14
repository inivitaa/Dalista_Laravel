<div class="hidden lg:flex w-64 h-screen sticky top-0 bg-white border-r border-gray-100 shadow-sm p-5 flex-col flex-shrink-0">
    <!-- LOGO -->
    <div class="flex items-center gap-3 border-b border-gray-100 pb-5 mb-6">

        <img src="{{ asset('images/logo-dalista.jpg') }}"
            class="w-11 h-11 rounded-2xl object-cover shadow-sm">

        <div class="min-w-0 flex-1">

            <img src="{{ asset('images/logo-dalista-text.jpg') }}"
                class="h-6 object-contain max-w-full">

            <p class="text-xs text-gray-400 mt-0.5 truncate">
                Portal Pengunjung
            </p>

        </div>

    </div>

    <!-- MENU -->
    <div class="space-y-1.5 flex-1 overflow-y-auto">

        <!-- FORM -->
        <a href="/form"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('form') 
                ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">

            <span class="text-lg flex-shrink-0">
                👤
            </span>

            <span class="text-sm truncate">
                Pendaftaran Tamu
            </span>

        </a>

        <!-- STATUS -->
        <a href="/status"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('status') 
                ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">

            <span class="text-lg flex-shrink-0">
                🔔
            </span>

            <span class="text-sm truncate">
                Status Pengajuan
            </span>

        </a>

        <!-- SURVEY -->
        <a href="/survey"
            class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
            {{ request()->is('survey') 
                ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' 
                : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">

            <span class="text-lg flex-shrink-0">
                📋
            </span>

            <span class="text-sm truncate">
                Survei
            </span>

        </a>

    </div>

    <!-- FOOTER SIDEBAR -->
    <div class="pt-4 border-t border-gray-100 flex-shrink-0">

        <p class="text-[11px] text-gray-400 text-center leading-relaxed">
            © {{ date('Y') }} DALISTA <br>
            <span class="text-[10px] text-gray-300">Digitalisasi Layanan Registrasi Tamu</span>
        </p>

    </div>
</div>