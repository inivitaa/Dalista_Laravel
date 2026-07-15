<!-- NAVBAR MOBILE (TERANG) -->
<div class="lg:hidden bg-white text-slate-800 p-4 flex items-center justify-between sticky top-0 z-40 shadow-sm border-b border-slate-200">
    <div class="flex items-center gap-3">
        <span class="text-2xl">🏢</span>
        <span class="font-bold text-lg text-slate-900">Admin Dalista</span>
    </div>
    <button onclick="toggleSidebar()" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 focus:outline-none transition text-slate-600">
        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path id="hamburgerPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>

<!-- BACKDROP MOBILE -->
<div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/30 z-40 hidden lg:hidden transition-opacity duration-300 backdrop-blur-sm"></div>

<!-- CONTAINER SIDEBAR (TERANG) -->
<!-- CONTAINER SIDEBAR -->
<aside id="sidebarContainer" class="fixed inset-y-0 left-0 w-72 bg-white text-slate-600 flex flex-col justify-between p-6 z-50 transform -translate-x-full lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen transition-transform duration-300 ease-in-out border-r border-slate-200 shadow-xl lg:shadow-none overflow-y-auto">    
    <div>
        <!-- Logo & Brand (Desktop Only) -->
        <div class="hidden lg:flex items-center gap-4 mb-10 px-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Dalista" class="w-12 h-12 object-contain bg-slate-100 p-1.5 rounded-2xl">
            <div>
                <h1 class="font-black text-slate-900 text-xl tracking-wider">DALISTA</h1>
                <p class="text-xs text-slate-500 font-medium">Disnakertrans Jateng</p>
            </div>
        </div>

        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest px-3 mb-4">Menu Utama</p>

        <!-- Menu Links -->
        <nav class="space-y-1">
             <!-- DASHBOARD -->
            <a href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                {{ request()->is('admin/dashboard')
                    ? 'bg-blue-50 text-blue-600 shadow-sm'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- MANAJEMEN TAMU -->
            <a href="/admin/manajemen-tamu"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                {{ request()->is('admin/manajemen-tamu')
                    ? 'bg-blue-50 text-blue-600 shadow-sm'
                    : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>Manajemen Tamu</span>
            </a>

            <!-- LAPORAN -->
            <a href="/admin/laporan"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                 {{ request()->is('admin/laporan')
                     ? 'bg-blue-50 text-blue-600 shadow-sm'
                     : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                 </svg>
                 <span>Laporan</span>
             </a
             <!-- SURVEY -->
             <a href="/admin/survey"
                 class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                 {{ request()->is('admin/survey')
                     ? 'bg-blue-50 text-blue-600 shadow-sm'
                     : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                 </svg>
                 <span>Survey</span>
             </a
             <!-- PROFIL -->
             <a href="/admin/profil"
                 class="flex items-center gap-3 px-4 py-3 rounded-xl transition font-semibold text-sm
                 {{ request()->is('admin/profil')
                     ? 'bg-blue-50 text-blue-600 shadow-sm'
                     : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                 </svg>
                 <span>Profil Admin</span>
             </a>
        </nav>
    </div>

    <!-- Profil & Logout -->
    <div class="border-t border-slate-100 pt-6 mt-6">
        <div class="flex items-center gap-3 px-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-lg font-bold text-slate-700 shrink-0">
                AD
            </div>
            <div class="overflow-hidden">
                <h4 class="font-bold text-slate-800 text-sm truncate">Admin Dalista</h4>
                <p class="text-xs text-slate-400 truncate">admin@jatengprov.go.id</p>
            </div>
        </div>

        <a href="/admin/logout" onclick="return confirm('Apakah Anda yakin ingin keluar?')"
           class="w-full flex items-center gap-4 px-4 py-3 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition font-bold text-sm justify-center lg:justify-start">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            <span>Logout</span>
        </a>
    </div>
</aside>

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