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

    <div class="flex-1 p-4 md:p-8 lg:p-10 overflow-x-hidden">
        <div
            id="overlay"
            class="fixed inset-0 bg-black/40 hidden lg:hidden z-40"
            onclick="toggleSidebar()">
        </div>


        @include('pengunjung.sidebar')

        <div class="flex-1 p-10">
            <div class="lg:hidden mb-5">

                <button
                    onclick="toggleSidebar()"
                    class="bg-blue-600 text-white px-4 py-2 rounded-xl">

                    ☰ Menu

                </button>

            </div>
            @yield('content')

            <!-- FOOTER -->
            <div class="border-t mt-16 pt-6 pb-4 px-4 text-center text-gray-500 text-sm">
                <p class="mt-2">
                    © {{date('Y')}} Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah. All rights reserved.
                </p>

            </div>
        </div>
</div>

<script>

function toggleSidebar(){

    document
        .getElementById('sidebar')
        .classList.toggle('-translate-x-full');

    document
        .getElementById('overlay')
        .classList.toggle('hidden');

}

</script>

</body>

</html>