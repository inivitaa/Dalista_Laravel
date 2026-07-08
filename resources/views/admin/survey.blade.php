@extends('admin.layout')

@section('content')

<div class="p-8">

    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">
            Survey Kepuasan
        </h1>
        <p class="text-gray-500 mt-2">
            Data hasil penilaian dan kepuasan pengunjung.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-slate-800">
                        {{ $totalSurvey }}
                    </h3>
                    <p class="text-gray-500 mt-1">Total Survey</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-3xl">📋</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-yellow-500">
                        {{ number_format($avgRating, 1) }}
                    </h3>
                    <p class="text-gray-500 mt-1">Rating Rata-rata</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-yellow-50 flex items-center justify-center text-3xl">⭐</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-green-500">
                        {{ $hebat }}
                    </h3>
                    <p class="text-gray-500 mt-1">Rating Hebat</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-3xl">😍</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-red-500">
                        {{ $buruk }}
                    </h3>
                    <p class="text-gray-500 mt-1">Rating Buruk</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center text-3xl">😢</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 mb-8">
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-slate-800">
                Rerata Nilai Per Aspek Pelayanan
            </h2>
            <p class="text-gray-500 mt-1">
                Analisis detil performa kualitas pelayanan berdasarkan 5 komponen utama Indeks Kepuasan.
            </p>
        </div>

        @php
            $namaAspek = [
                'p1' => 'Pelayanan Sesuai Harapan (P1)',
                'p2' => 'Kerapian & Kesopanan Petugas (P2)',
                'p3' => 'Kejelasan & Kemudahan Informasi (P3)',
                'p4' => 'Kecepatan & Alur Proses Kerja (P4)',
                'p5' => 'Kenyamanan Fasilitas Lingkungan (P5)'
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            @foreach($avgAspek as $key => $skor)
            <div class="bg-slate-50/60 border border-slate-100 rounded-2xl p-5 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">
                        {{ strtoupper($key) }}
                    </span>
                    <h4 class="text-sm font-semibold text-slate-700 leading-snug mb-3 min-h-[40px]">
                        {{ $namaAspek[$key] }}
                    </h4>
                </div>
                
                <div>
                    <div class="flex items-baseline justify-between mb-2">
                        <span class="text-3xl font-black text-slate-800">{{ $skor }}</span>
                        <span class="text-xs text-gray-400 font-bold">/ 5.0</span>
                    </div>
                    
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2.5 rounded-full transition-all duration-500" 
                             style="width: {{ ($skor / 5) * 100 }}%">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 mb-8">
        <div class="mb-5">
            <h2 class="text-3xl font-bold text-slate-800">Statistik Rating</h2>
            <p class="text-gray-500 mt-1">Distribusi penilaian kepuasan pengunjung</p>
        </div>
        <div class="h-[280px]">
            <canvas id="ratingChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow overflow-hidden">
        <div class="flex justify-between items-start p-6 border-b">
            <div>
                <h2 class="text-3xl font-bold text-slate-800">Data Survey Pengunjung</h2>   
                <p class="text-gray-500 text-sm mt-1">Daftar seluruh penilaian dan kepuasan layanan</p>
            </div>
            <div class="flex items-center gap-3">
                <form method="GET" class="flex items-center gap-3">
                    <select name="periode" onchange="this.form.submit()" class="border border-gray-200 rounded-2xl px-5 py-3 shadow-sm bg-white cursor-pointer">
                        <option value="" {{ request()->filled('periode') ? '' : 'selected' }}>Semua Waktu</option>
                        <option value="7" {{ request('periode') == 7 ? 'selected' : '' }}>7 Hari Terakhir</option>
                        <option value="30" {{ request('periode') == 30 ? 'selected' : '' }}>30 Hari Terakhir</option>
                        <option value="90" {{ request('periode') == 90 ? 'selected' : '' }}>90 Hari Terakhir</option>
                    </select>

                    <select name="bidang" onchange="this.form.submit()" class="border border-gray-200 rounded-2xl px-5 py-3 shadow-sm bg-white cursor-pointer">
                        <option value="">Semua Layanan</option>

                        @foreach($layananUmum as $layanan)

                        <option
                            value="{{ $layanan->nama_layanan }}"
                            {{ request('layanan') == $layanan->nama_layanan ? 'selected' : '' }}>

                            {{ $layanan->nama_layanan }}

                        </option>
                        @endforeach
                    </select>
                </form>

                <a href="/admin/survey/export?periode={{ request('periode') }}&bidang={{ request('bidang') }}"
                    class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-2xl shadow-sm font-medium transition">
                    Export CSV
                </a>
            </div>
        </div>

        <form method="GET" action="" id="filterForm">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-6">
                <div class="md:col-span-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..." onkeyup="submitFilter()"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-3">
                    <select name="layanan" onchange="submitFilter()" class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="">Semua Layanan</option>

                        @foreach($layananUmum as $layanan)

                        <option
                            value="{{ $layanan->nama_layanan }}"
                            {{ request('layanan') == $layanan->nama_layanan ? 'selected' : '' }}>

                            {{ $layanan->nama_layanan }}

                        </option>

                        @endforeach
                    </select>
                </div>
                
                <div class="md:col-span-3">
                    <select name="rating" onchange="submitFilter()" class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="">Semua Rating</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>😢 Buruk</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>😕 Kurang</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>🙂 Cukup</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>😊 Puas</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>🤩 Hebat</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <select name="per_page" onchange="this.form.submit()" class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 per halaman</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per halaman</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per halaman</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-100 border-y border-slate-200">
                   <tr>
                        <th class="px-6 py-5 text-left text-gray-500 font-semibold w-16">No</th>
                        <th class="px-6 py-5 text-left text-gray-500 font-semibold">Nama</th>
                        <th class="px-6 py-5 text-left text-gray-500 font-semibold">Layanan</th>
                        <th class="px-6 py-5 text-left text-gray-500 font-semibold">Detail Aspek (P1-P5)</th>
                        <th class="px-6 py-5 text-left text-gray-500 font-semibold">Rating</th>
                        <th class="px-6 py-5 text-left text-gray-500 font-semibold">Saran</th>
                        <th class="px-6 py-5 text-left text-gray-500 font-semibold">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surveys as $index => $survey)
                    <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition h-20">
                        <td class="px-6 py-6 text-gray-600">
                            {{ $index + $surveys->firstItem() }}
                        </td>

                        <td class="px-6 py-6 font-bold text-slate-700 text-base">
                            {{ $survey->nama ?? 'Anonim' }}
                        </td>

                        <td class="px-6 py-6">
                            <span class="bg-sky-50 text-sky-700 px-3 py-1 rounded-full text-sm">
                                {{ $survey->layanan_diakses }}
                            </span>
                        </td>

                        <td class="px-6 py-6">
                            <div class="flex flex-wrap gap-1 max-w-xs text-[11px]">
                                <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded shadow-sm">P1: <strong class="text-slate-900">{{ $survey->p1 ?? '-' }}</strong></span>
                                <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded shadow-sm">P2: <strong class="text-slate-900">{{ $survey->p2 ?? '-' }}</strong></span>
                                <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded shadow-sm">P3: <strong class="text-slate-900">{{ $survey->p3 ?? '-' }}</strong></span>
                                <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded shadow-sm">P4: <strong class="text-slate-900">{{ $survey->p4 ?? '-' }}</strong></span>
                                <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded shadow-sm">P5: <strong class="text-slate-900">{{ $survey->p5 ?? '-' }}</strong></span>
                            </div>
                        </td>

                        <td class="p-4">
                            @if($survey->rating == 5)
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">🤩 Hebat</span>
                            @elseif($survey->rating == 4)
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-bold">😊 Puas</span>
                            @elseif($survey->rating == 3)
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-bold">🙂 Cukup</span>
                            @elseif($survey->rating == 2)
                                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-bold">😕 Kurang</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">😢 Buruk</span>
                            @endif
                        </td>

                        <td class="px-6 py-6 text-gray-500 italic max-w-xs break-words">
                            {{ $survey->ulasan ?? '-' }}
                        </td>

                        <td class="px-6 py-6 text-gray-500 text-sm whitespace-nowrap">
                            {{ $survey->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-10 text-center">
                            <div class="text-6xl mb-4">📭</div>
                            <h2 class="text-xl font-bold text-gray-700 mb-2">Belum ada survey</h2>
                            <p class="text-gray-400">Data survey akan muncul di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center px-6 py-5 border-t bg-white">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $surveys->firstItem() ?? 0 }} sampai {{ $surveys->lastItem() ?? 0 }} dari {{ $surveys->total() }} data
            </p>
            {{ $surveys->links() }}
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
                {{ $chartData[0] }},
                {{ $chartData[1] }},
                {{ $chartData[2] }},
                {{ $chartData[3] }},
                {{ $chartData[4] }}
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
    document.getElementById('filterForm').submit();
}
</script>

@endsection