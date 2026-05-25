@extends('admin.layout')

@section('content')

<div class="p-8">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-gray-800">
            Survey Kepuasan
        </h1>

        <p class="text-gray-500 mt-2">
            Data hasil penilaian dan kepuasan pengunjung.
        </p>

    </div>

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <!-- TOTAL -->
        <div class="bg-white rounded-3xl p-6 shadow hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Total Survey
                    </p>

                    <h2 class="text-4xl font-bold text-blue-600 mt-2">
                        {{ $totalSurvey }}
                    </h2>

                </div>

                <div class="text-5xl">
                    📋
                </div>

            </div>

        </div>

        <!-- RATA -->
        <div class="bg-white rounded-3xl p-6 shadow hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Rating Rata-rata
                    </p>

                    <h2 class="text-4xl font-bold text-yellow-500 mt-2">
                        ⭐ {{ $avgRating }}
                    </h2>

                </div>

                <div class="text-5xl">
                    🌟
                </div>

            </div>

        </div>

        <!-- HEBAT -->
        <div class="bg-white rounded-3xl p-6 shadow hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Rating Hebat
                    </p>

                    <h2 class="text-4xl font-bold text-green-500 mt-2">
                        {{ $hebat }}
                    </h2>

                </div>

                <div class="text-5xl">
                    😍
                </div>

            </div>

        </div>

        <!-- BURUK -->
        <div class="bg-white rounded-3xl p-6 shadow hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400">
                        Rating Buruk
                    </p>

                    <h2 class="text-4xl font-bold text-red-500 mt-2">
                        {{ $buruk }}
                    </h2>

                </div>

                <div class="text-5xl">
                    😢
                </div>

            </div>

        </div>

    </div>

    <!-- CHART -->
    <div class="bg-white rounded-3xl shadow p-6 mb-8">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Statistik Rating
                </h2>

                <p class="text-gray-400 text-sm">
                    Grafik penilaian pengunjung
                </p>

            </div>

        </div>

        <div class="h-[350px]">

            <canvas id="ratingChart"></canvas>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-3xl shadow p-6 mb-8">

        <form method="GET" action="" id="filterForm">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- SEARCH -->
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama..."
                    onkeyup="submitFilter()"
                    class="border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                <!-- FILTER LAYANAN -->
                <select 
                    name="layanan"
                    onchange="submitFilter"              
                    class="border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                   <option value="">
                        Semua Layanan
                    </option>

                    <option value="Konsultasi Layanan"
                    {{ request('layanan') == 'Konsultasi Layanan' ? 'selected' : '' }}
                    >
                        Konsultasi Layanan
                    </option>

                    <option value="Pengaduan/Keluhan"
                    {{ request('layanan') == 'Pengaduan/Keluhan' ? 'selected' : '' }}
                    >
                        Pengaduan/Keluhan
                    </option>

                    <option value="Pengajuan Permohonan"
                    {{ request('layanan') == 'Pengajuan Permohonan' ? 'selected' : '' }}
                    >
                        Pengajuan Permohonan
                    </option>

                    <option value="Mencari Informasi"
                    {{ request('layanan') == 'Mencari Informasi' ? 'selected' : '' }}
                    >
                        Mencari Informasi
                    </option>

                    <option value="Survey/Penelitian"
                    {{ request('layanan') == 'Survey/Penelitian' ? 'selected' : '' }}
                    >
                        Survey/Penelitian
                    </option>

                    <option value="Layanan Terpadu"
                    {{ request('layanan') == 'Layanan Terpadu' ? 'selected' : '' }}
                    >
                        Layanan Terpadu
                    </option>

                    <option value="Meeting"
                    {{ request('layanan') == 'Meeting' ? 'selected' : '' }}
                    >
                        Meeting
                    </option>

                    <option value="Lainnya"
                    {{ request('layanan') == 'Lainnya' ? 'selected' : '' }}
                    >
                        Lainnya
                    </option>
                </select>
                
                <!-- FILTER RATING -->
                <select 
                    name="rating"
                    onchange="submitFilter()" 
                    class="border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"               
                    >

                    <option value="">
                        Semua Rating
                    </option>

                    <option value="1"{{ request('rating') == '1' ? 'selected' : '' }}>
                        😢 Buruk
                    </option>

                    <option value="2"{{ request('rating') == '2' ? 'selected' : '' }}>
                        😕 Kurang
                    </option>

                    <option value="3"{{ request('rating') == '3' ? 'selected' : '' }}>
                        🙂 Cukup
                    </option>

                    <option value="4"{{ request('rating') == '4' ? 'selected' : '' }}>
                        😊 Puas
                    </option>

                    <option value="5"{{ request('rating') == '5' ? 'selected' : '' }}>
                        🤩 Hebat
                    </option>

                </select>

                <a href="/admin/survey/export"
                class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-2xl font-semibold transition">

                    Export CSV

                </a>
            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <div class="p-6 border-b flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Data Survey
                </h2>

                <p class="text-gray-400 text-sm mt-1">
                    Seluruh data penilaian pengunjung
                </p>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="p-4 text-left font-semibold text-gray-600">
                            Nama
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-600">
                            Layanan
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-600">
                            Rating
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-600">
                            Saran
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-600">
                            Tanggal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($surveys as $survey)

                    <tr class="border-t hover:bg-gray-50 transition">

                        <!-- NAMA -->
                        <td class="p-4 font-semibold text-gray-700">

                            {{ $survey->nama }}

                        </td>

                        <!-- LAYANAN -->
                        <td class="p-4">

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                {{ $survey->layanan_diakses }}

                            </span>

                        </td>

                        <!-- RATING -->
                        <td class="p-4">

                            @if($survey->rating == 5)

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                    🤩 Hebat
                                </span>

                            @elseif($survey->rating >= 3)

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-bold">
                                    🙂 Cukup
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                                    😢 Buruk
                                </span>

                            @endif

                        </td>

                        <!-- SARAN -->
                        <td class="p-4 text-gray-600 max-w-xs">

                            {{ $survey->ulasan ?? '-' }}

                        </td>

                        <!-- TANGGAL -->
                        <td class="p-4 text-gray-400 text-sm">

                            {{ $survey->created_at->format('d M Y') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="p-10 text-center">

                            <div class="text-6xl mb-4">
                                📭
                            </div>

                            <h2 class="text-xl font-bold text-gray-700 mb-2">
                                Belum ada survey
                            </h2>

                            <p class="text-gray-400">
                                Data survey akan muncul di sini.
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>
            <div class="px-6 py-4 border-t bg-white">

                {{ $surveys->links() }}

            </div>
        </div>

    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('ratingChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            '⭐ Buruk',

            '⭐ Kurang',

            '⭐ Cukup',

            '⭐ Puas',

            '⭐ Hebat'

        ],

        datasets: [{

            label: 'Jumlah Rating',

            data: [

                {{ $surveys->where('rating',1)->count() }},

                {{ $surveys->where('rating',2)->count() }},

                {{ $surveys->where('rating',3)->count() }},

                {{ $surveys->where('rating',4)->count() }},

                {{ $surveys->where('rating',5)->count() }}

            ],

            borderRadius: 12,

            backgroundColor: [

                '#ef4444',

                '#f97316',

                '#eab308',

                '#22c55e',

                '#3b82f6'

            ]

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true,

                ticks: {

                    stepSize: 1,

                    precision: 0

                }

            }

        }

    }

});

function submitFilter(){

    document
        .getElementById('filterForm')
        .submit();

}

</script>

@endsection