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

        @include('pengunjung.sidebar')

        <div class="flex-1 p-10">

            @yield('content')

            <!-- FOOTER -->
            <div class="border-t border-gray-300 mt-16 pt-6 pb-4 text-center text-gray-500 text-sm">

                <p class="mt-2">
                    © {{date('Y')}} Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah. All rights reserved.
                </p>

            </div>
        </div>
    </div>
    
</body>

</html>