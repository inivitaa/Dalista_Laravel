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

    {{-- SIDEBAR --}}
    @include('pengunjung.sidebar')

    {{-- CONTENT --}}
    <main class="flex-1 p-4 md:p-6 lg:p-10 overflow-x-hidden">
        <div class="lg:hidden flex justify-between items-center mb-6">

    <h2 class="text-xl font-bold text-gray-700">
        DALISTA
    </h2>

    <button id="menuBtn"
        class="bg-blue-600 text-white px-4 py-2 rounded-xl">

        ☰

    </button>

</div>


        @yield('content')

        {{-- FOOTER --}}
        <div class="border-t border-gray-300 mt-16 pt-6 pb-4 text-center text-gray-500 text-sm">

            <p>
                © {{ date('Y') }}
                Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah.
                All rights reserved.
            </p>

        </div>

    </main>

</div>

</body>

</html>