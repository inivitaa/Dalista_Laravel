<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f5f7fb] antialiased">

<div class="flex flex-col lg:flex-row min-h-screen">

    <!-- SIDEBAR -->
    <x-sidebar />

    <!-- CONTENT -->
    <main class="flex-1 w-full px-4 sm:px-6 py-6">

        @yield('content')
        
        <!-- FOOTER -->
        <div class="border-t border-gray-300 mt-16 pt-6 pb-4 text-center text-gray-500 text-xs md:text-sm">
            <p>© {{date('Y')}} Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah. All rights reserved.</p>
        </div>

    </main>
    
</div>

</body>
</html>