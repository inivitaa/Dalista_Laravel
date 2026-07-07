@extends('pengunjung.layout')

@section('content')

<div class="min-h-screen flex items-center justify-center p-6 py-10 relative overflow-hidden">

    <div class="fixed top-0 right-0 w-[400px] h-[400px] bg-blue-200/30 rounded-full blur-3xl -z-10"></div>
    <div class="fixed bottom-0 left-0 w-[400px] h-[400px] bg-indigo-200/20 rounded-full blur-3xl -z-10"></div>

    <div class="bg-white/80 backdrop-blur-2xl rounded-[32px] shadow-[0_20px_60px_rgba(0,0,0,0.08)] border border-white/60 p-10 max-w-xl w-full">

        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-gray-800 tracking-tight mb-3">
                ⭐ Survei Kepuasan Masyarakat
            </h2>
            <p class="text-gray-500 leading-relaxed text-sm" id="form-desc">
                Langkah 1 dari 2: Berikan penilaian umum Anda terlebih dahulu.
            </p>
        </div>

        <form action="/survey/store" method="POST" id="surveyForm">
            @csrf

            <div id="step-1" class="transition-all duration-300">
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">
                        Nama Anda
                    </label>
                    <input 
                        type="text"
                        name="nama"
                        id="input-nama"
                        required
                        placeholder="Masukkan nama Anda"
                        class="w-full bg-white/70 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition duration-300"
                    >
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">
                        Layanan yang Anda terima
                    </label>
                    <select 
                        name="layanan"
                        id="input-layanan"
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
                        <option>Lainnya</option>
                    </select>
                </div>

                <div class="mb-10">
                    <label class="block text-sm font-bold text-gray-700 mb-6 ml-1">
                        Berikan Rating Pengalaman Umum
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
                                class="hidden peer rating-radio"
                            >
                            <div class="text-4xl filter grayscale opacity-40 peer-checked:grayscale-0 peer-checked:opacity-100 peer-checked:scale-125 transition-all duration-300 group-hover:scale-110 group-hover:opacity-100">
                                {{ $rate['img'] }}
                            </div>
                            <span class="text-[11px] mt-3 text-gray-400 font-bold uppercase tracking-tight peer-checked:text-blue-600">
                                {{ $rate['label'] }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button 
                    type="button"
                    onclick="nextStep()"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-100 hover:shadow-blue-200 hover:scale-[1.01] transition-all duration-300"
                >
                    Lanjutkan ➔
                </button>
            </div>


            <div id="step-2" class="hidden opacity-0 transition-all duration-300">
                
                <div class="mb-8 bg-gray-50 border border-gray-200 rounded-3xl p-6">
                    <div class="mb-6">
                        <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                            📝 Detail Penilaian Pelayanan
                        </h3>
                    </div>

                    @php
                        $pertanyaan = [
                            'Pelayanan yang saya terima sudah sesuai dengan harapan.',
                            'Petugas melayani dengan ramah dan sopan.',
                            'Informasi yang diberikan mudah dipahami.',
                            'Proses pelayanan berlangsung dengan baik.',
                            'Fasilitas atau lingkungan pelayanan memadai dan nyaman.',
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
                    <div class="mb-5 last:mb-0 border border-gray-100 rounded-2xl p-5 bg-white shadow-sm">
                        <p class="font-semibold text-sm text-gray-700 mb-4">
                            {{ $index + 1 }}. {{ $item }}
                        </p>

                        <div class="space-y-3">
                            @foreach($opsi as $value => $label)
                            <label class="flex items-center gap-3 cursor-pointer hover:text-blue-600 transition text-sm text-gray-600">
                                <input
                                    type="radio"
                                    name="pertanyaan_{{ $index }}"
                                    value="{{ $value }}"
                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300 step2-input"
                                >
                                <span>{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">
                        Pesan atau Saran (Opsional)
                    </label>
                    <textarea 
                        name="ulasan"
                        rows="4"
                        placeholder="Ada masukan tambahan untuk operasional kami?"
                        class="w-full bg-white/70 border border-gray-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition duration-300 resize-none"
                    ></textarea>
                </div>

                <div class="flex gap-3">
                    <button 
                        type="button"
                        onclick="prevStep()"
                        class="w-1/3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-5 rounded-2xl transition duration-300"
                    >
                        🠔 Kembali
                    </button>
                    
                    <button 
                        type="submit"
                        class="w-2/3 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-200 hover:shadow-blue-300 hover:scale-[1.02] transition-all duration-300 active:scale-95"
                    >
                        Kirim Penilaian ✨
                    </button>
                </div>
            </div>

        </form>

        <a href="/" class="block mt-6 text-center text-sm text-gray-400 hover:text-gray-600 transition">
            ← Kembali ke Beranda
        </a>

    </div>
</div>

<script>
    function nextStep() {
        const nama = document.getElementById('input-nama').value.trim();
        const layanan = document.getElementById('input-layanan').value;
        
        // Cek apakah radio rating ada yang terpilih
        const ratingSelected = document.querySelector('input[name="rating"]:checked');

        // Validasi Step 1 secara manual agar tidak kosong sebelum pindah halaman
        if (!nama) {
            alert('Silakan isi nama Anda terlebih dahulu.');
            return;
        }
        if (!layanan) {
            alert('Silakan pilih jenis layanan yang Anda terima.');
            return;
        }
        if (!ratingSelected) {
            alert('Silakan pilih salah satu rating emoji.');
            return;
        }

        // Aktifkan attribute required untuk input step 2 saat berpindah halaman
        document.querySelectorAll('.step2-input').forEach(input => {
            input.required = true;
        });

        // Animasi transisi menyembunyikan Step 1 dan memunculkan Step 2
        document.getElementById('step-1').classList.add('hidden');
        
        const step2 = document.getElementById('step-2');
        step2.classList.remove('hidden');
        setTimeout(() => {
            step2.classList.remove('opacity-0');
        }, 50);

        document.getElementById('form-desc').innerText = "Langkah 2 dari 2: Detail aspek penilaian pelayanan.";
    }

    function prevStep() {
        // Nonaktifkan attribute required step 2 agar tombol back tidak memicu validasi browser
        document.querySelectorAll('.step2-input').forEach(input => {
            input.required = false;
        });

        document.getElementById('step-2').classList.add('hidden');
        document.getElementById('step-2').classList.add('opacity-0');
        
        document.getElementById('step-1').classList.remove('hidden');
        document.getElementById('form-desc').innerText = "Langkah 1 dari 2: Berikan penilaian umum Anda terlebih dahulu.";
    }
</script>

@endsection