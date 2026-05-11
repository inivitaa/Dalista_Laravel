@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">

    <div>

        <h1 class="text-4xl font-bold text-gray-800">
            Dashboard Admin
        </h1>

        <p class="text-gray-500 mt-2">
            Ringkasan aktivitas dan data kunjungan tamu
        </p>

    </div>

    <button onclick="location.reload()"
        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-2xl transition shadow">

        ↻ Refresh Data

    </button>

</div>

    <!-- WELCOME CARD -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-3xl p-8 mb-8 text-white shadow-lg">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-3xl font-bold">
                    Selamat Datang Admin Dalista 👋
                </h2>

                <p class="mt-3 text-emerald-100 text-lg">
                    Berikut ringkasan aktivitas dan kunjungan tamu hari ini.
                </p>

            </div>

            <div class="hidden md:flex w-24 h-24 bg-white/20 rounded-3xl items-center justify-center text-5xl">

                📊

            </div>

        </div>

    </div>

<!-- STATISTIK -->
<div class="grid md:grid-cols-4 gap-6 mb-8">

    <!-- TOTAL -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-400 text-sm">
                    Total Tamu
                </p>

                <h2 class="text-3xl font-bold text-gray-800 mt-3">
                    {{ $total }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl">
                👥
            </div>

        </div>

    </div>

    <!-- MENUNGGU -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-400 text-sm">
                    Menunggu
                </p>

                <h2 class="text-4xl font-bold text-yellow-500 mt-3">
                    {{ $menunggu }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center text-3xl">
                ⏳
            </div>

        </div>

    </div>

    <!-- TERJADWAL -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-400 text-sm">
                    Terjadwal
                </p>

                <h2 class="text-4xl font-bold text-blue-500 mt-3">
                    {{ $terjadwal }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">
                📅
            </div>

        </div>

    </div>

    <!-- SELESAI -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-gray-400 text-sm">
                    Selesai
                </p>

                <h2 class="text-4xl font-bold text-green-500 mt-3">
                    {{ $selesai }}
                </h2>

            </div>

            <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">
                ✅
            </div>

        </div>

    </div>

</div>

<!-- CHART -->
<div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-8">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h3 class="text-2xl font-bold text-gray-800">
                Statistik Kunjungan
            </h3>

            <p class="text-gray-400 text-sm mt-1">
                Jumlah tamu berdasarkan bulan
            </p>

        </div>

    </div>

    <div class="h-80">

    <canvas id="visitorChart"></canvas>

    </div>

</div>

<!-- GRID -->
<div class="grid lg:grid-cols-3 gap-6">

    <!-- AKTIVITAS -->
    <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h3 class="text-2xl font-bold text-gray-800">
                    Aktivitas Terbaru
                </h3>

                <p class="text-gray-400 text-sm mt-1">
                    Data tamu terbaru yang masuk
                </p>

            </div>

        </div>

        <div class="space-y-4">

            @foreach($recentGuests as $guest)

            <div class="flex items-center justify-between border border-gray-100 rounded-2xl p-4">

                <div>

                    <h4 class="font-semibold text-gray-800">
                        {{ $guest->nama }}
                    </h4>

                    <p class="text-sm text-gray-400 mt-1">
                        {{ $guest->tujuan }}
                    </p>

                </div>

                <span class="text-sm text-gray-400">
                {{ \Carbon\Carbon::parse($guest->waktu_dibuat)->diffForHumans() }}                </span>

            </div>

            @endforeach

        </div>

    </div>

    <!-- QUICK MENU -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <h3 class="text-2xl font-bold text-gray-800 mb-6">
            Menu Cepat
        </h3>

        <div class="space-y-4">

            <a href="/form"
               class="flex items-center justify-between bg-pink-50 hover:bg-pink-100 transition rounded-2xl p-5">

                <div>

                    <h4 class="font-semibold text-pink-600">
                        Tambah Tamu
                    </h4>

                    <p class="text-sm text-pink-400 mt-1">
                        Form pendaftaran tamu
                    </p>

                </div>

                <span class="text-2xl">
                    ➕
                </span>

            </a>

            <a href="/admin/manajemen-tamu"
               class="flex items-center justify-between bg-blue-50 hover:bg-blue-100 transition rounded-2xl p-5">

                <div>

                    <h4 class="font-semibold text-blue-600">
                        Manajemen Tamu
                    </h4>

                    <p class="text-sm text-blue-400 mt-1">
                        Kelola seluruh data tamu
                    </p>

                </div>

                <span class="text-2xl">
                    👥
                </span>

            </a>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('visitorChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [
            'Jan', 'Feb', 'Mar', 'Apr',
            'Mei', 'Jun', 'Jul', 'Ags',
            'Sep', 'Okt', 'Nov', 'Des'
        ],

        datasets: [{

            label: 'Jumlah Tamu',

            data: @json($chartData),

            borderColor: '#ec4899',

            backgroundColor: 'rgba(236,72,153,0.1)',

            tension: 0.4,

            fill: true

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                display: false
            }

        }

    }

});

</script>

@endsection