<div class="w-full bg-white rounded-2xl shadow-sm mb-6 px-5 py-4 flex flex-col lg:gap-3 transition-all duration-300">
    
    <!-- BARIS 1: Logo & Hamburger -->
    <div class="flex items-center justify-between w-full">
        <div class="font-bold text-blue-700 text-xl tracking-wider">
            DALISTA
        </div>

        <button id="menuBtn" class="block md:hidden text-2xl p-1 focus:outline-none focus:bg-gray-100 rounded-lg transition-colors" aria-label="Toggle Menu">
            ☰
        </button>
    </div>

    <!-- BARIS 2 (DESKTOP): Menu Berjajar Horisontal -->
    <div class="hidden md:flex items-center gap-6 font-medium text-gray-700 border-t border-gray-50 pt-2">
        <a href="/form" class="hover:text-blue-700 transition">👤 Pendaftaran Tamu</a>
        <a href="/status" class="hover:text-blue-700 transition">🔔 Status Pengajuan</a>
        <a href="/survey" class="hover:text-blue-700 transition">📋 Survei</a>
    </div>

    <div id="mobileMenu" class="max-h-0 opacity-0 invisible overflow-hidden md:hidden transition-all duration-300 ease-in-out">
        <div class="pt-3 flex flex-col gap-1">
            <a href="/form" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <span>👤</span> Pendaftaran Tamu
            </a>
            <a href="/status" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <span>🔔</span> Status Pengajuan
            </a>
            <a href="/survey" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <span>📋</span> Survei
            </a>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');

    btn.addEventListener('click', () => {
        // Cek jika menu sedang tertutup
        if (menu.classList.contains('max-h-0')) {
            menu.classList.remove('max-h-0', 'opacity-0');
            menu.classList.add('max-h-[300px]', 'opacity-100'); // Berikan batas tinggi aman agar animasi berjalan
        } else {
            menu.classList.remove('max-h-[300px]', 'opacity-100');
            menu.classList.add('max-h-0', 'opacity-0');
        }
    });
    
    // Menutup menu HP otomatis jika layar di-resize ke desktop secara tidak sengaja
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            menu.classList.remove('max-h-[300px]', 'opacity-100');
            menu.classList.add('max-h-0', 'opacity-0');
        }
    });
});
</script>