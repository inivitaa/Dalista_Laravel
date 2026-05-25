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
    <div class="min-h-screen flex flex-col items-center px-4 pb-10">

        <!-- HEADER DALISTA -->
        <div class="relative w-full max-w-6xl rounded-[40px] overflow-hidden mb-10">


            <!-- CONTENT -->
            <div class="relative z-10 flex flex-col items-center text-center px-6 py-16">

                <!-- LOGO -->
                <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-[32px] p-6 shadow-2xl mb-6">

                    <img src="/images/logo.png"
                        class="w-32 h-32 object-contain">

                </div>

                <!-- STATUS -->
                <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-8 py-3 mb-8 shadow-lg">

                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>

                    <span class="text-green-300 font-semibold text-xl">
                        Sistem Online 24/7
                    </span>

                </div>

                <!-- TITLE -->
                <h1 class="text-5xl md:text-7xl font-black bg-gradient-to-r from-gray-900 to-blue-900 bg-clip-text text-transparent leading-tight mb-2">                    
                    Selamat Datang di

                </h1>

                <!-- LOGO TEXT -->
                <img src="/images/logo-text.png"
                    class="h-20 object-contain mb-6 drop-shadow-2xl">

                <!-- SUBTITLE -->
                <p class="text-2xl md:text-3xl bg-gradient-to-r from-blue-900 to-purple-800 bg-clip-text text-transparent font-semibold">

                    Digitalisasi Layanan Registrasi Tamu

                </p>

            </div>

        </div>
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
            <!-- LOGO DINAS -->
            <div class="flex justify-center mb-6">

                <img src="/images/logo-jateng.png"
                    class="w-28 h-28 object-contain drop-shadow-lg">

            </div>
            <!-- JUDUL TENGAH -->
            <div class="text-center mb-10">

                <h2 class="text-5xl md:text-7xl font-bold mb-3 text-gray-800">
                    Layanan Kami
                </h2>
                
                <p class="max-w-2xl mx-auto text-gray-600 text-xl leading-relaxed">
                    Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah melayani masyarakat dengan sistem digital yang modern dan terintegrasi
                </p>

            </div>

            <!-- CARD GRID -->
            <div class="grid md:grid-cols-3 gap-8 mt-12">

                <!-- CARD 1 -->
                <div onclick="window.location.href='/form'"
                    class="group bg-white/80 backdrop-blur-xl border border-white/50 rounded-[32px] shadow-xl p-10 text-center transition duration-500 hover:-translate-y-3 hover:shadow-2xl cursor-pointer">

                    <!-- ICON -->
                    <div class="bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 w-20 h-20 flex items-center justify-center rounded-3xl mx-auto mb-6 text-4xl shadow-lg group-hover:scale-110 transition duration-500">

                        📋

                    </div>

                    <!-- TITLE -->
                    <h3 class="text-2xl font-bold tracking-tight text-gray-800 mb-4">

                        Registrasi Tamu

                    </h3>

                    <!-- DESC -->
                    <p class="text-gray-500 leading-relaxed text-lg">

                        Daftarkan kunjungan Anda dengan mudah dan cepat melalui sistem digital.

                    </p>

                </div>

                <!-- CARD 2 -->
                <div
                    class="group bg-white/80 backdrop-blur-xl border border-white/50 rounded-[32px] shadow-xl p-10 text-center transition duration-500 hover:-translate-y-3 hover:shadow-2xl cursor-pointer">

                    <!-- ICON -->
                    <div class="bg-gradient-to-br from-green-100 to-green-200 text-green-600 w-20 h-20 flex items-center justify-center rounded-3xl mx-auto mb-6 text-4xl shadow-lg group-hover:scale-110 transition duration-500">

                        🏢

                    </div>

                    <!-- TITLE -->
                    <h3 class="text-2xl font-bold tracking-tight text-gray-800 mb-4">

                        Layanan

                    </h3>

                    <!-- DESC -->
                    <p class="text-gray-500 leading-relaxed text-lg">

                        Akses berbagai layanan yang tersedia di dinas secara terintegrasi.

                    </p>

                </div>

                <!-- CARD 3 -->
                <div onclick="window.location.href='/survey'"
                    class="group bg-white/80 backdrop-blur-xl border border-white/50 rounded-[32px] shadow-xl p-10 text-center transition duration-500 hover:-translate-y-3 hover:shadow-2xl cursor-pointer">

                    <!-- ICON -->
                    <div class="bg-gradient-to-br from-orange-100 to-orange-200 text-orange-600 w-20 h-20 flex items-center justify-center rounded-3xl mx-auto mb-6 text-4xl shadow-lg group-hover:scale-110 transition duration-500">

                        ⭐

                    </div>

                    <!-- TITLE -->
                    <h3 class="text-2xl font-bold tracking-tight text-gray-800 mb-4">

                        Feedback & Evaluasi

                    </h3>

                    <!-- DESC -->
                    <p class="text-gray-500 leading-relaxed text-lg">

                        Berikan masukan untuk meningkatkan kualitas pelayanan kami melalui Survey SKM.

                    </p>

                </div>

            </div>

        </div>

        <!-- CTA SECTION -->
        <div class="w-full max-w-6xl mt-20">

            <div class="relative overflow-hidden rounded-[40px] bg-gradient-to-r from-blue-700 to-blue-600 px-8 py-16 text-center shadow-2xl">

                <!-- BULATAN DEKOR -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>

                <div class="absolute -bottom-14 -left-14 w-52 h-52 bg-white/10 rounded-full"></div>

                <!-- CONTENT -->
                <div class="relative z-10">

                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                        Mulai Sekarang!
                    </h2>

                    <p class="text-white/90 text-lg md:text-2xl mb-10">
                        Silakan pilih layanan berikut untuk melanjutkan
                    </p>

                    <!-- BUTTON -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-5">

                        <!-- BTN FORM -->
                        <a href="/form"
                            class="bg-white text-blue-700 font-bold px-10 py-5 rounded-2xl shadow-lg hover:scale-105 transition duration-300">

                            Daftar Tamu

                        </a>

                        <!-- BTN SURVEY -->
                        <a href="/survey"
                            class="border-2 border-white text-white font-bold px-10 py-5 rounded-2xl hover:bg-white hover:text-blue-700 transition duration-300">

                            Isi Survei

                        </a>

                    </div>

                </div>

            </div>

        </div>

            <!-- FOOTER -->
            <div class="border-t border-gray-300 mt-16 pt-6 pb-4 text-center text-gray-500 text-sm">

                <p class="mt-2">
                    © {{date('Y')}} Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah. All rights reserved.
                </p>

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