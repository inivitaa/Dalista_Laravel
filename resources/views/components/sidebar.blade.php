<div class="lg:hidden bg-slate-800 text-white p-4 flex items-center justify-between sticky top-0 z-40 shadow-md">
    <div class="flex items-center gap-3">
        <img src="{{ asset('images/logo-dalista.jpg') }}"
            class="w-14 h-14 rounded-xl shadow"
            alt="Logo">            
            <img src="{{ asset('images/logo-dalista-text.jpg') }}"
                class="h-6 object-contain max-w-full">               
    </div>
    <button onclick="toggleSidebar()" class="p-2 rounded-xl bg-slate-700 hover:bg-slate-600 focus:outline-none transition">
        <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path id="hamburgerPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>

<!-- BACKDROP MOBILE -->
<div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden transition-opacity duration-300"></div>

<!-- CONTAINER SIDEBAR -->
<aside id="sidebarContainer" class="fixed inset-y-0 left-0 w-72 bg-slate-800 text-gray-700 flex flex-col justify-between p-6 z-50 transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none min-h-screen">
    
    <div>
        <!-- Logo & Brand (Desktop Only) -->
        <div class="hidden lg:flex items-center gap-4 mb-10 px-2">
        <img src="{{ asset('images/logo-dalista.jpg') }}"
            class="w-14 h-14 rounded-xl shadow"
            alt="Logo">            
        <div>
            <img src="{{ asset('images/logo-dalista-text.jpg') }}"
                class="h-6 object-contain max-w-full">
                <p class="text-xs text-slate-400">Admin Panel</p>
            </div>
        </div>

        <!-- Menu Links -->
        <nav class="space-y-2">
            <a href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('admin/dashboard')
                    ? 'bg-blue-50 text-blue-600 font-semibold'
                    : 'hover:bg-gray-100 text-gray-600' }}">

                📊 Dashboard
            </a>

            <a href="/admin/manajemen-tamu"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('admin/manajemen-tamu')
                    ? 'bg-blue-50 text-blue-600 font-semibold'
                    : 'hover:bg-gray-100 text-gray-600' }}">

                👥 Manajemen Tamu
            </a>

            <a href="/admin/laporan"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('admin/laporan')
                    ? 'bg-blue-50 text-blue-600 font-semibold'
                    : 'hover:bg-gray-100 text-gray-600' }}">
                📑 Laporan
            </a>

            <a href="/admin/survey"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('admin/survey')
                    ? 'bg-blue-50 text-blue-600 font-semibold'
                    : 'hover:bg-gray-100 text-gray-600' }}">
                ⭐ Survey
            </a>

            <a href="/admin/profil"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->is('admin/profil')
                    ? 'bg-slate-50 text-slate-600 font-semibold'
                    : 'hover:bg-gray-100 text-gray-600' }}">
                👤 Profil Admin
            </a>
        </nav>
    </div>

    <!-- Profil & Logout -->
    <div class="border-t border-slate-700/60 pt-6 mt-6">
        <div class="flex items-center gap-3 px-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-slate-700 flex items-center justify-center text-lg font-bold text-white shrink-0">
                AD
            </div>
            <div class="overflow-hidden">
                <h4 class="font-bold text-white text-sm truncate">Admin Dalista</h4>
                <p class="text-xs text-slate-500 truncate">admin@jatengprov.go.id</p>
            </div>
        </div>

        <form action="/logout" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition font-medium">
                <span class="text-xl">🚪</span>
                <span>Logout</span>
            </button>
        </form>
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