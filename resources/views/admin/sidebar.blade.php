<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">

    <!-- LOGO -->
    <div class="p-6 border-b">

        <h1 class="text-2xl font-bold text-gray-800">
            DALISTA
        </h1>

        <p class="text-sm text-gray-400 mt-1">
            Admin Panel
        </p>

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
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-600 transition">

            📑 Laporan

        </a>

        <!-- SURVEY -->
        <a href="#"
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