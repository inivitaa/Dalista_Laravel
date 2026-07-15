<!-- NAVBAR MOBILE (TERANG) -->
<div class="lg:hidden bg-white text-slate-800 p-4 flex items-center justify-between sticky top-0 z-40 shadow-sm border-b border-slate-200">
    <div class="flex items-center gap-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Dalista" class="w-8 h-8 object-contain">
        <span class="font-bold text-lg text-slate-900">Portal Pengunjung</span>
    </div>
    <button onclick="toggleSidebar()" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 focus:outline-none transition text-slate-600">
        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path id="hamburgerPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>

<!-- BACKDROP MOBILE -->
<div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/30 z-40 hidden lg:hidden transition-opacity duration-300 backdrop-blur-sm"></div>

<!-- CONTAINER SIDEBAR -->
<aside id="sidebarContainer" class="fixed inset-y-0 left-0 w-72 bg-white text-slate-600 flex flex-col justify-between p-6 z-50 transform -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen transition-transform duration-300 ease-in-out border-r border-slate-200 shadow-xl lg:shadow-none overflow-y-auto">
    
    <div>
        <!-- Logo & Brand (Desktop Only) -->
        <div class="hidden lg:flex items-center gap-4 mb-10 px-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Dalista" class="w-12 h-12 object-contain bg-slate-100 p-1.5 rounded-2xl">
            <div class="min-w-0 flex-1">
                <img src="{{ asset('images/logo-text.png') }}" alt="DALISTA" class="h-6 object-contain max-w-full">
                <p class="text-xs text-slate-400 mt-0.5 font-medium truncate">Portal Pengunjung</p>
            </div>
        </div>

        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest px-3 mb-4">Menu Utama</p>

        <!-- Menu Links -->
        <nav class="space-y-1">
            <!-- PENDAFTARAN TAMU -->
            <a href="/form"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                {{ request()->is('form')
                    ? 'bg-blue-50 text-blue-600 shadow-sm'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span class="truncate">Pendaftaran Tamu</span>
            </a>

            <!-- STATUS PENGAJUAN -->
            <a href="/status"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                {{ request()->is('status')
                    ? 'bg-blue-50 text-blue-600 shadow-sm'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="truncate">Status Pengajuan</span>
            </a>

            <!-- SURVEI -->
            <a href="/survey"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                {{ request()->is('survey')
                    ? 'bg-blue-50 text-blue-600 shadow-sm'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span class="truncate">Survei</span>
            </a>
        </nav>
    </div>

    <!-- FOOTER SIDEBAR -->
    <div class="border-t border-slate-100 pt-6 mt-6 flex-shrink-0">
        <p class="text-[11px] text-slate-400 text-center leading-relaxed font-medium">
            &copy; {{ date('Y') }} DALISTA <br>
            <span class="text-[10px] text-slate-400/70 font-normal">Digitalisasi Layanan Registrasi Tamu</span>
        </p>
    </div>
</aside>

<!-- SCRIPT TOGGLE (Hanya taruh jika belum di-include di layout utama) -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebarContainer');
        const backdrop = document.getElementById('sidebarBackdrop');
        const hamburgerPath = document.getElementById('hamburgerPath');
        const isOpen = sidebar.classList.contains('translate-x-0');

        if (isOpen) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
            hamburgerPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            backdrop.classList.remove('hidden');
            hamburgerPath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
        }
    }
</script>