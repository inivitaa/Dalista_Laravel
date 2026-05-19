<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan library SweetAlert untuk notifikasi sukses -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-gray-100">

    <!-- CONTAINER UTAMA -->
    <div class="min-h-screen flex flex-col items-center px-4 py-10">

        <!-- HERO CARD -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden max-w-6xl w-full mb-12">

            <!-- HERO IMAGE -->
            <div class="relative h-[420px] w-full">

                <img src="/images/kantor.jpg" class="w-full h-full object-cover">

                <!-- overlay -->
                <div class="absolute inset-0 bg-black/50"></div>

                <!-- TEXT -->
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">

                    <h1 class="text-4xl md:text-5xl font-bold mb-3">
                        Buku Tamu Digital
                    </h1>

                    <p class="text-lg mb-2">
                        Dinas Tenaga Kerja dan Transmigrasi
                    </p>

                    <p class="max-w-xl mb-6">
                        Selamat datang di sistem buku tamu digital.
                        Silakan isi data kunjungan Anda untuk keperluan administrasi dan pelayanan.
                    </p>

                    <!-- BUTTON -->
                    <div class="flex flex-col md:flex-row gap-4">

                        <a href="/form"
                           class="bg-blue-600 hover:bg-blue-700 px-8 py-3 rounded-xl font-semibold transition duration-300 shadow-lg hover:scale-105 text-center">
                           Isi Buku Tamu
                        </a>

                        <!-- UPDATE LINK SURVEY DI SINI -->
                        <a href="/survey"
                           class="border border-white text-white px-8 py-3 rounded-xl font-semibold transition duration-300 hover:bg-white hover:text-black hover:scale-105 text-center">
                           Survey Kepuasan
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- MENU LAYANAN -->
        <div class="max-w-6xl w-full">

            <!-- JUDUL TENGAH -->
            <div class="text-center mb-10">

                <h2 class="text-4xl md:text-5xl font-bold mb-3 text-gray-800">
                    Layanan Kami
                </h2>
                
                <p class="max-w-2xl mx-auto text-gray-500">
                    Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah melayani masyarakat dengan sistem digital yang modern dan terintegrasi
                </p>

            </div>

            <!-- CARD GRID -->
            <div class="grid md:grid-cols-3 gap-6">

                <!-- CARD 1 -->
                <div onclick="window.location.href='/form'" class="bg-white rounded-2xl shadow-md p-6 text-center transition duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1 cursor-pointer">

                    <div class="bg-blue-100 text-blue-600 w-14 h-14 flex items-center justify-center rounded-xl mx-auto mb-4 text-2xl">
                        📋
                    </div>

                    <h3 class="text-lg font-semibold mb-2">
                        Registrasi Tamu
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Daftarkan kunjungan Anda dengan mudah dan cepat melalui sistem digital.
                    </p>

                </div>

                <!-- CARD 2 -->
                <div class="bg-white rounded-2xl shadow-md p-6 text-center transition duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1 cursor-pointer">

                    <div class="bg-green-100 text-green-600 w-14 h-14 flex items-center justify-center rounded-xl mx-auto mb-4 text-2xl">
                        🏢
                    </div>

                    <h3 class="text-lg font-semibold mb-2">
                        Layanan
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Akses berbagai layanan yang tersedia di dinas secara terintegrasi.
                    </p>

                </div>

                <!-- CARD 3 (UPDATE LINK DI CARD JUGA) -->
                <div onclick="window.location.href='/survey'" class="bg-white rounded-2xl shadow-md p-6 text-center transition duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1 cursor-pointer">

                    <div class="bg-orange-100 text-orange-600 w-14 h-14 flex items-center justify-center rounded-xl mx-auto mb-4 text-2xl">
                        ⭐
                    </div>

                    <h3 class="text-lg font-semibold mb-2">
                        Feedback & Evaluasi
                    </h3>

                    <p class="text-gray-500 text-sm">
                        Berikan masukan untuk meningkatkan kualitas pelayanan kami Melalui Survey SKM.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- NOTIFIKASI SUKSES SETELAH ISI SURVEY -->
    @if(session('success_survey'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Terima Kasih!',
            text: "{{ session('success_survey') }}",
            confirmButtonColor: '#2563eb',
            borderRadius: '20px'
        });
    </script>
    @endif

</body>
</html>