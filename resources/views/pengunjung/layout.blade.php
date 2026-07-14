<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal Pengunjung DALISTA</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-100 antialiased">

<div class="flex flex-col lg:flex-row min-h-screen w-full">

    {{-- Sidebar Desktop --}}
    <div class="hidden lg:flex lg:w-64 lg:flex-shrink-0">
        @include('pengunjung.sidebar')
    </div>

    <main class="flex-1 p-4 sm:p-6 md:p-8 w-full max-w-full overflow-x-hidden flex flex-col">
    
    {{-- Pembungkus Atas (Navbar + Konten) --}}
    <div class="flex-1 w-full max-w-5xl mx-auto flex flex-col">
        
        <div class="lg:hidden flex flex-col mb-6">
            <x-navbar />
        </div>

        {{-- Slot Konten Utama --}}
        <div class="w-full flex-1 my-2 md:my-4">
            @yield('content')
        </div>

    </div>

    {{-- Footer Responsif --}}
    <footer class="border-t border-gray-200 mt-auto pt-6 pb-2 text-center text-gray-500 text-xs sm:text-sm w-full max-w-5xl mx-auto">
        © {{ date('Y') }} Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah.
    </footer>

</main>

</div>



</body>

</html>