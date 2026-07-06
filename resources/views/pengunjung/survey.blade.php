@extends('pengunjung.layout')

@section('content')

<div class="min-h-screen flex items-center justify-center p-6 py-10 relative overflow-hidden">

    <!-- BACKGROUND BLUR -->
    <div class="fixed top-0 right-0 w-[400px] h-[400px] bg-blue-200/30 rounded-full blur-3xl -z-10"></div>

    <div class="fixed bottom-0 left-0 w-[400px] h-[400px] bg-indigo-200/20 rounded-full blur-3xl -z-10"></div>

    <!-- CARD -->
    <div class="bg-white/80 backdrop-blur-2xl rounded-[32px] shadow-[0_20px_60px_rgba(0,0,0,0.08)] border border-white/60 p-10 max-w-xl w-full">

        <!-- HEADER -->
        <div class="text-center mb-10">


            <!-- TITLE -->
            <h2 class="text-3xl font-black text-gray-800 tracking-tight mb-3">

                ⭐ Bagaimana pengalaman Anda?
            </h2>

            <!-- DESC -->
            <p class="text-gray-500 leading-relaxed">

                Masukanmu sangat berarti untuk kami agar bisa melayani lebih baik lagi.

            </p>

        </div>

        <!-- FORM -->
        <form action="/survey/store" method="POST" id="surveyForm">

            @csrf

            <!-- NAMA -->
            <div class="mb-6">

                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">

                    Nama Anda

                </label>

                <input 
                    type="text"
                    name="nama"
                    required
                    placeholder="Masukkan nama"
                    class="w-full bg-white/70 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition duration-300"
                >

            </div>

            <!-- LAYANAN -->
            <div class="mb-8">

                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">

                    Layanan yang Anda terima

                </label>

                <select 
                    name="layanan"
                    required
                    class="w-full appearance-none bg-white/70 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition duration-300 cursor-pointer"
                >

                    <option value="">-- Pilih Layanan --</option>

                    <option>Konsultasi Layanan</option>
                    <option>Pengaduan/Keluhan</option>
                    <option>Pengajuan Permohonan</option>
                    <option>Mencari Informasi</option>
                    <option>Survey/Penelitian</option>
                    <option>Layanan Terpadu</option>
                    <option>Meeting</option>
                    <option>Lainnya</option>

                </select>

            </div>

            <!-- RATING -->
            <div class="mb-10">

                <label class="block text-sm font-bold text-gray-700 mb-6 ml-1">

                    Berikan Rating

                </label>

                <div class="grid grid-cols-5 gap-3">

                    @foreach([
                        ['val' => 1, 'img' => '😠', 'label' => 'Buruk'],
                        ['val' => 2, 'img' => '😟', 'label' => 'Kurang'],
                        ['val' => 3, 'img' => '😐', 'label' => 'Cukup'],
                        ['val' => 4, 'img' => '😊', 'label' => 'Puas'],
                        ['val' => 5, 'img' => '🤩', 'label' => 'Hebat']
                    ] as $rate)

                    <label class="group cursor-pointer flex flex-col items-center bg-gray-50 hover:bg-blue-50 rounded-3xl px-3 py-5 transition duration-300 border border-transparent hover:border-blue-200">

                        <input 
                            type="radio"
                            name="rating"
                            value="{{ $rate['val'] }}"
                            required
                            class="hidden peer"
                        >

                        <!-- EMOJI -->
                        <div class="text-4xl filter grayscale opacity-40 peer-checked:grayscale-0 peer-checked:opacity-100 peer-checked:scale-125 transition-all duration-300 group-hover:scale-110 group-hover:opacity-100">

                            {{ $rate['img'] }}

                        </div>

                        <!-- LABEL -->
                        <span class="text-[11px] mt-3 text-gray-400 font-bold uppercase tracking-tight peer-checked:text-blue-600">

                            {{ $rate['label'] }}

                        </span>

                    </label>

                    @endforeach

                </div>

            </div>

            <!-- ULASAN -->
            <div class="mb-8">

                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">

                    Pesan atau Saran

                </label>

                <textarea 
                    name="ulasan"
                    rows="4"
                    placeholder="Ada masukan tambahan?"
                    class="w-full bg-white/70 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition duration-300 resize-none"
                ></textarea>

            </div>

           

            <!-- BUTTON -->
            <button 
                type="submit"
                class="w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-200 hover:shadow-blue-300 hover:scale-[1.02] transition-all duration-300 active:scale-95"
            >

                Kirim Penilaian ✨

            </button>

        </form>

        <!-- BACK -->
        <a href="/" class="block mt-6 text-center text-sm text-gray-400 hover:text-gray-600 transition">

            ← Kembali ke Beranda

        </a>

    </div>

</div>
 <!-- PENILAIAN PELAYANAN -->
            <div class="mb-10">

                <!-- Judul -->
                <div class="bg-gray-50 border border-gray-200 rounded-3xl p-6">

                    <div class="mb-6">

                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            📝 Penilaian Pelayanan
                        </h3>

                        <p class="text-sm text-gray-500 mt-2">
                            Mohon berikan penilaian terhadap beberapa aspek pelayanan berikut.
                        </p>

                    </div>

                    @php
                        $pertanyaan = [
                            'Pelayanan yang saya terima sudah sesuai dengan harapan.',
                            'Petugas melayani dengan ramah dan sopan.',
                            'Informasi yang diberikan mudah dipahami.',
                            'Proses pelayanan berlangsung dengan baik.',
                        ];

                        $opsi = [
                            'STS' => 'Sangat Tidak Setuju',
                            'TS'  => 'Tidak Setuju',
                            'KS'  => 'Kurang Setuju',
                            'S'   => 'Setuju',
                            'SS'  => 'Sangat Setuju',
                        ];
                    @endphp

                    @foreach($pertanyaan as $index => $item)

                    <div class="mb-6 last:mb-0 border border-gray-200 rounded-2xl p-5 bg-white">

                        <p class="font-semibold text-gray-700 mb-4">
                            {{ $index + 1 }}. {{ $item }}
                        </p>

                        <div class="space-y-3">

                            @foreach($opsi as $value => $label)

                            <label class="flex items-center gap-3 cursor-pointer hover:text-blue-600 transition">

                                <input
                                    type="radio"
                                    name="pertanyaan_{{ $index }}"
                                    value="{{ $value }}"
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                >

                                <span class="text-sm text-gray-600">
                                    {{ $label }}
                                </span>

                            </label>

                            @endforeach

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

@endsection