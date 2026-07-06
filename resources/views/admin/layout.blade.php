<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f5f7fb]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('admin.sidebar')

    <!-- CONTENT -->
    <main class="flex-1 px-4 py-6">

        @yield('content')
        <!-- FOOTER -->
                    <div class="border-t border-gray-300 mt-16 pt-6 pb-4 text-center text-gray-500 text-sm">

                        <p class="mt-2">
                            © {{date('Y')}} Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah. All rights reserved.
                        </p>

                    </div>

    </main>
    
</div>

</body>
</html>