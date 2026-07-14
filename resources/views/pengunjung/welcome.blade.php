<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan library SweetAlert untuk notifikasi sukses -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-gray-100 antialiased selection:bg-blue-500 selection:text-white">

    <!-- CONTAINER UTAMA -->
    <div class="min-h-screen flex flex-col items-center px-4 pb-10 overflow-x-hidden">

        <!-- HEADER DALISTA -->
        <div class="relative w-full max-w-6xl rounded-[40px] overflow-visible mb-6 md:mb-10">

            <!-- CONTENT -->
            <div class="relative z-10 flex flex-col items-center text-center px-4 py-10 md:py-16">

                <!-- LOGO -->
                <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-[24px] md:rounded-[32px] p-4 md:p-6 shadow-2xl mb-6 transition-transform hover:scale-105 duration-300">
                    <img src="/images/logo.png"
                        class="w-24 h-24 md:w-32 md:h-32 object-contain">
                </div>

                <!-- STATUS -->
                <div class="flex items-center gap-2 sm:gap-3 bg-white/40 backdrop-blur-md border border-white/40 rounded-full px-5 py-2 sm:px-8 sm:py-3 mb-6 md:mb-8 shadow-md">
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-green-800 font-semibold text-sm sm:text-base md:text-xl">
                        Sistem Online 24/7
                    </span>
                </div>

                <!-- TITLE -->
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-black text-[#16275f] tracking-tight mb-4 md:mb-6">
                    Selamat Datang di
                </h1>

                <!-- LOGO TEXT (Responsive Width Fix) -->
                <div class="w-full max-w-xs sm:max-w-md md:max-w-lg mb-6 md:mb-10 px-4">
                    <img src="/images/logo-text.png"
                        class="w-full h-auto object-contain mx-auto drop-shadow-2xl">
                </div>

                <!-- SUBTITLE -->
                <p class="text-lg sm:text-xl md:text-3xl text-indigo-900 font-bold max-w-2xl px-2">
                    Digitalisasi Layanan Registrasi Tamu
                </p>

                <!-- STATISTIK (Responsive Grid) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mt-8 md:mt-10 w-full max-w-xl px-2">

                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl md:rounded-3xl shadow-md p-5 md:p-6 border border-white/50">
                        <p class="text-gray-500 text-xs md:text-sm font-medium uppercase tracking-wider">
                            Kunjungan Hari Ini
                        </p>
                        <h3 class="text-3xl md:text-4xl font-extrabold text-blue-700 mt-1 md:mt-2">
                            {{ $visitorHariIni }}
                        </h3>
                    </div>

                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl md:rounded-3xl shadow-md p-5 md:p-6 border border-white/50">
                        <p class="text-gray-500 text-xs md:text-sm font-medium uppercase tracking-wider">
                            Total Kunjungan
                        </p>
                        <h3 class="text-3xl md:text-4xl font-extrabold text-orange-500 mt-1 md:mt-2">
                            {{ number_format($totalVisitor) }}
                        </h3>
                    </div>

                </div>
            </div>

        </div>

        <!-- HERO CARD (Responsive Padding and Flex) -->
        <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl overflow-hidden max-w-6xl w-full mb-10 md:mb-14 border border-gray-100">

            <!-- HERO IMAGE CONTAINER -->
            <div class="relative min-h-[380px] md:h-[450px] w-full flex flex-col justify-center">

                <img src="/images/kantor.jpg" class="absolute inset-0 w-full h-full object-cover">

                <!-- overlay -->
                <div class="absolute inset-0 bg-black/60 backdrop-blur-[1px]"></div>

                <!-- TEXT & ACTION CONTROL -->
                <div class="relative z-10 flex flex-col items-center justify-center text-center text-white px-4 sm:px-8 py-10">

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2">
                        Buku Tamu Digital
                    </h2>

                    <p class="text-sm sm:text-base md:text-lg text-blue-200 font-medium mb-4">
                        Dinas Tenaga Kerja dan Transmigrasi
                    </p>

                    <p class="max-w-xl text-xs sm:text-sm md:text-base text-gray-200 leading-relaxed mb-8">
                        Selamat datang di sistem buku tamu digital.
                        Silakan isi data kunjungan Anda untuk keperluan administrasi dan kelancaran standar mutu pelayanan.
                    </p>

                    <!-- BUTTONS -->
                    <div class="flex flex-col sm:flex-row gap-3.5 w-full sm:w-auto px-4 sm:px-0">

                        <a href="/form"
                           class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-xl font-bold transition duration-300 shadow-md hover:scale-[1.03] text-center text-sm md:text-base">
                           Isi Buku Tamu
                        </a>

                        <a href="/survey"
                           class="w-full sm:w-auto border border-white/70 text-white px-8 py-3.5 rounded-xl font-bold transition duration-300 hover:bg-white hover:text-black hover:scale-[1.03] text-center text-sm md:text-base">
                           Survei Kepuasan
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- MENU LAYANAN -->
        <div class="max-w-6xl w-full px-2">
            <!-- LOGO DINAS -->
            <div class="flex justify-center mb-4 md:mb-6">
                <img src="/images/logo-jateng.png"
                    class="w-20 h-20 md:w-24 md:h-24 object-contain drop-shadow-md">
            </div>

            <!-- JUDUL TENGAH -->
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 text-gray-800 tracking-tight">
                    Layanan Kami
                </h2>
                <p class="max-w-xl mx-auto text-gray-500 text-sm sm:text-base md:text-lg leading-relaxed px-4">
                    Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah melayani masyarakat dengan sistem digital yang modern, transparan, dan terintegrasi.
                </p>
            </div>

            <!-- CARD GRID (Responsive Grid Columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 mt-6">

                <!-- CARD 1 -->
                <div onclick="window.location.href='/form'"
                    class="group bg-white border border-gray-100 rounded-2xl md:rounded-[32px] shadow-md hover:shadow-xl p-6 md:p-8 text-center transition duration-300 sm:hover:-translate-y-2 cursor-pointer flex flex-col items-center">
                    
                    <div class="bg-blue-50 text-blue-600 w-16 h-16 flex items-center justify-center rounded-2xl mb-5 text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                        📋
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">
                        Registrasi Tamu
                    </h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">
                        Daftarkan kunjungan Anda dengan mudah, aman, dan cepat langsung via gawai pintar Anda.
                    </p>
                </div>

                <!-- CARD 2 -->
                <div class="group bg-white border border-gray-100 rounded-2xl md:rounded-[32px] shadow-md hover:shadow-xl p-6 md:p-8 text-center transition duration-300 sm:hover:-translate-y-2 cursor-pointer flex flex-col items-center">
                    
                    <div class="bg-green-50 text-green-600 w-16 h-16 flex items-center justify-center rounded-2xl mb-5 text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                        🏢
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">
                        Layanan Dinas
                    </h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">
                        Akses alur informasi kerja dan berbagai program layanan publik utama terpadu di dinas kami.
                    </p>
                </div>

                <!-- CARD 3 -->
                <div onclick="window.location.href='/survey'"
                    class="group bg-white border border-gray-100 rounded-2xl md:rounded-[32px] shadow-md hover:shadow-xl p-6 md:p-8 text-center transition duration-300 sm:hover:-translate-y-2 cursor-pointer flex flex-col items-center sm:col-span-2 md:col-span-1">
                    
                    <div class="bg-orange-50 text-orange-600 w-16 h-16 flex items-center justify-center rounded-2xl mb-5 text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                        ⭐
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">
                        Feedback & Evaluasi
                    </h3>
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed">
                        Bantu kami berkembang dengan mengisi kuesioner Indeks Kepuasan Masyarakat (IKM) secara berkala.
                    </p>
                </div>

            </div>
        </div>

        <!-- CTA SECTION -->
        <div class="w-full max-w-6xl mt-16 md:mt-24 px-2">

            <div class="relative overflow-hidden rounded-3xl md:rounded-[40px] bg-gradient-to-r from-blue-700 to-indigo-700 px-6 py-12 md:py-16 text-center shadow-2xl">

                <!-- BULATAN DEKOR -->
                <div class="absolute -top-10 -right-10 w-32 h-32 md:w-40 md:h-40 bg-white/10 rounded-full pointer-events-none"></div>
                <div class="absolute -bottom-14 -left-14 w-40 h-40 md:w-52 md:h-52 bg-white/10 rounded-full pointer-events-none"></div>

                <!-- CONTENT -->
                <div class="relative z-10 max-w-xl mx-auto">

                    <h2 class="text-3xl md:text-5xl font-black text-white mb-3">
                        Mulai Sekarang!
                    </h2>

                    <p class="text-white/80 text-sm md:text-xl mb-8 md:mb-10">
                        Silakan tentukan keperluan utama kedatangan Anda hari ini untuk melanjutkan
                    </p>

                    <!-- BUTTON ACTION -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 px-4 sm:px-0">

                        <a href="/form"
                            class="w-full sm:w-auto bg-white text-blue-700 font-bold px-8 py-4 rounded-xl shadow-lg hover:scale-[1.03] transition duration-200 text-sm md:text-base">
                            Daftar Tamu
                        </a>

                        <a href="/survey"
                            class="w-full sm:w-auto border-2 border-white/80 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-white/10 transition duration-200 text-sm md:text-base">
                            Isi Survei
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <footer class="border-t border-gray-200 mt-16 pt-6 w-full max-w-6xl text-center text-gray-400 text-xs md:text-sm">
            <p>© {{ date('Y') }} Dinas Tenaga Kerja dan Transmigrasi Provinsi Jawa Tengah. All rights reserved.</p>
        </footer>
    </div>

    <!-- NOTIFIKASI SUKSES SETELAH ISI SURVEY -->
    @if(session('success_survey'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Terima Kasih!',
            text: "{{ session('success_survey') }}",
            confirmButtonColor: '#2563eb',
            customClass: {
                popup: 'rounded-3xl'
            }
        });
    </script>
    @endif

</body>
</html>