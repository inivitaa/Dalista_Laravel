<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#f8fafc]">

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 max-w-lg w-full text-center border border-gray-100">
        
        <!-- HEADER -->
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Gimana pelayanan kami?</h2>
            <p class="text-gray-500">Masukanmu sangat berarti untuk kami agar bisa melayani lebih baik lagi.</p>
        </div>

        <form action="/survey/store" method="POST" id="surveyForm">
            @csrf
            
            <!-- JENIS LAYANAN -->
            <div class="mb-8 text-left">
                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Layanan yang Anda terima:</label>
                <select name="layanan" required class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 focus:bg-white outline-none transition-all cursor-pointer">
                    <option value="">-- Pilih Layanan --</option>
                    <option>Konsultasi Layanan</option>
                    <option>Pengaduan/Keluhan</option>
                    <option>Pendaftaran Tamu</option>
                    <option>Informasi Publik</option>
                </select>
            </div>

            <!-- EMOJI RATING SYSTEM -->
            <label class="block text-sm font-bold text-gray-700 mb-6 text-left ml-1">Berikan Rating:</label>
            <div class="flex justify-between items-center mb-10 px-2">
                @foreach([
                    ['val' => 1, 'img' => '😠', 'label' => 'Buruk'],
                    ['val' => 2, 'img' => '😟', 'label' => 'Kurang'],
                    ['val' => 3, 'img' => '😐', 'label' => 'Cukup'],
                    ['val' => 4, 'img' => '😊', 'label' => 'Puas'],
                    ['val' => 5, 'img' => '🤩', 'label' => 'Hebat']
                ] as $rate)
                <label class="group cursor-pointer">
                    <input type="radio" name="rating" value="{{ $rate['val'] }}" required class="hidden peer">
                    <!-- Efek: Grayscale ke Berwarna + Scale Up -->
                    <div class="text-4xl md:text-5xl filter grayscale opacity-40 peer-checked:grayscale-0 peer-checked:opacity-100 peer-checked:scale-125 transition-all duration-300 group-hover:scale-110 group-hover:opacity-100">
                        {{ $rate['img'] }}
                    </div>
                    <span class="text-[10px] block mt-3 text-gray-400 font-bold uppercase tracking-tighter peer-checked:text-blue-600">
                        {{ $rate['label'] }}
                    </span>
                </label>
                @endforeach
            </div>

            <!-- ULASAN -->
            <div class="text-left mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-3 ml-1">Pesan atau Saran:</label>
                <textarea name="ulasan" rows="3" 
                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 focus:bg-white outline-none transition-all" 
                    placeholder="Ada masukan tambahan?"></textarea>
            </div>

            <button type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-100 hover:shadow-blue-200 transition-all duration-300 transform hover:-translate-y-1 active:scale-95">
                Kirim Penilaian ✨
            </button>
        </form>
        
        <a href="/" class="block mt-6 text-sm text-gray-400 hover:text-gray-600 transition">Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>