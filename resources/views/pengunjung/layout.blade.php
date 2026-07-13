<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal Pengunjung DALISTA</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar Desktop --}}
    <div class="hidden lg:flex">
        @include('pengunjung.sidebar')
    </div>

    {{-- Content --}}
    <main class="flex-1 p-4 md:p-8">

        {{-- Navbar HP --}}
        <div class="lg:hidden flex items-center justify-between bg-white rounded-2xl shadow px-4 py-3 mb-6">

            <div class="font-bold text-blue-700 text-xl">
                DALISTA
            </div>

            <button id="menuBtn" class="text-3xl">
                ☰
            </button>

        </div>

        {{-- Menu HP --}}
        <div
            id="mobileMenu"
            class="hidden bg-white rounded-2xl shadow mb-6 overflow-hidden">

            <a href="/form"
                class="block px-5 py-4 border-b hover:bg-gray-100">
                👤 Pendaftaran Tamu
            </a>

            <a href="/status"
                class="block px-5 py-4 border-b hover:bg-gray-100">
                🔔 Status Pengajuan
            </a>

            <a href="/survey"
                class="block px-5 py-4 hover:bg-gray-100">
                📋 Survei
            </a>

        </div>

        @yield('content')

        <div class="border-t border-gray-300 mt-16 pt-6 text-center text-gray-500 text-sm">

            © {{ date('Y') }}
            Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah.

        </div>

    </main>

</div>

<script>

const btn=document.getElementById('menuBtn');

const menu=document.getElementById('mobileMenu');

btn.addEventListener('click',()=>{

    menu.classList.toggle('hidden');

});

</script>

</body>

</html>