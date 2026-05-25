<aside class="w-64 min-h-screen h-screen sticky top-0 bg-white/90 backdrop-blur-xl border-r border-gray-100 shadow-sm flex flex-col">    <!-- LOGO -->
    <div class="flex items-center gap-3 px-6 py-6 border-b">

        <img src="{{ asset('images/logo-dalista.jpg') }}"
            alt="Logo"
            class="w-12 h-12 object-contain">

        <div>

            <img src="{{ asset('images/logo-dalista-text.jpg') }}"
                alt="DALISTA"
                class="h-8 object-contain">

            <p class="text-gray-400 text-sm">
                Admin Panel
            </p>

        </div>

    </div>

    <!-- MENU -->
    <nav class="flex-1 p-4 space-y-2">

        <!-- DASHBOARD -->
        <a href="/admin/dashboard"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition

            {{ request()->is('admin/dashboard')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'hover:bg-gray-100 text-gray-600' }}">
                
            📊 Dashboard

        </a>

        <!-- MANAJEMEN TAMU -->
        <a href="/admin/manajemen-tamu"
class="flex items-center gap-3 px-4 py-3 rounded-xl transition

{{ request()->is('admin/manajemen-tamu')
    ? 'bg-pink-50 text-pink-600 font-semibold'
    : 'hover:bg-gray-100 text-gray-600' }}">

            👥 Manajemen Tamu

        </a>

        <!-- LAPORAN -->
        <a href="/admin/laporan"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 transition">

            📑 Laporan

        </a>

        <!-- SURVEY -->
        <a href="/admin/survey"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 transition">

            ⭐ Survey

        </a>

    </nav>

    <!-- LOGOUT -->
    <div class="p-4 border-t">

        <button class="w-full bg-gray-100 hover:bg-red-50 hover:text-red-500 transition rounded-xl py-3 text-gray-600">
            Logout
        </button>

    </div>

</aside>