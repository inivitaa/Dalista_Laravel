<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-gray-100">

<div class="min-h-screen flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-3xl">

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Formulir Pendaftaran Tamu</h1>
            <p class="text-gray-500 mt-2">Silakan isi formulir di bawah ini untuk mendaftar sebagai tamu. Pastikan semua informasi yang Anda berikan adalah akurat.</p>
        </div>

        <!-- PROGRESS -->
        <div class="mb-10">
            <div class="flex items-center justify-between">

                <div class="flex flex-col items-center w-full">
                    <div id="circle1" class="circle active">1</div>
                    <span class="label active">Data Diri</span>
                </div>

                <div class="line" id="line1"></div>

                <div class="flex flex-col items-center w-full">
                    <div id="circle2" class="circle">2</div>
                    <span class="label">Informasi</span>
                </div>

                <div class="line" id="line2"></div>

                <div class="flex flex-col items-center w-full">
                    <div id="circle3" class="circle">3</div>
                    <span class="label">Kunjungan</span>
                </div>

            </div>
        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-xl p-8">

            <form action="/guest/store" 
                  method="POST" 
                  enctype="multipart/form-data"
                  id="formMultiStep">

                  @csrf

                <!-- STEP 1 -->
                <div class="step" id="step1">
                    <h2 class="text-xl font-semibold mb-4">Data Diri</h2>

                    <div class="space-y-4">
                        <input id="nama" name="nama" class="input" placeholder="Nama Lengkap">
                        <input id="email" name="email" class="input" placeholder="Email">
                        <input id="nohp" name="nohp" class="input" placeholder="No HP">

                        <select id="jk" name="jk" class="input">
                            <option value="">Jenis Kelamin</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>

                        <input id="alamat" name="alamat" class="input" placeholder="Alamat">
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="step hidden" id="step2">
                    <h2 class="text-xl font-semibold mb-4">Informasi Tambahan</h2>

                    <div class="space-y-4">

                        <!-- PROFESI LENGKAP -->
                        <select id="profesi" name="profesi" class="input">
                            <option value="">-- Pilih Profesi --</option>
                            <option value="PNS">PNS</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Karyawan Swasta">Karyawan Swasta</option>
                            <option value="Guru/Dosen">Guru/Dosen</option>
                            <option value="TNI/Polri">TNI/Polri</option>
                            <option value="Dokter/Nakes">Dokter/Nakes</option>
                            <option value="Petani">Petani</option>
                            <option value="Buruh">Buruh</option>
                            <option value="Pengacara">Pengacara</option>
                            <option value="Konsultan">Konsultan</option>
                            <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>

                        <input id="profesi_lainnya" name="profesi_lainnya" class="input hidden" placeholder="Tulis profesi lainnya">

                        <select id="pendidikan" name="pendidikan" class="input">
                            <option value="">-- Pendidikan Terakhir --</option>
                            <option>TIDAK SEKOLAH</option>
                            <option>SD</option>
                            <option>SMP</option>
                            <option>SMA/SMK</option>
                            <option>D3</option>
                            <option>S1</option>
                            <option>S2</option>
                            <option>S3</option>
                        </select>

                        <input name="instansi" class="input" placeholder="Nama Perusahaan/Instansi">

                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="step hidden" id="step3">
                    <h2 class="text-xl font-semibold mb-4">Informasi Kunjungan</h2>

                    <div class="space-y-4">

                        <select id="tujuan" name="tujuan" class="input">
                            <option value="">-- Pilih Tujuan Kunjungan --</option>
                            <option>Konsultasi Layanan</option>
                            <option>Pengaduan/Keluhan</option>
                            <option>Pengajuan Permohonan</option>
                            <option>Mencari Informasi</option>
                            <option>Survey/Penelitian</option>
                            <option>Layanan Terpadu</option>
                            <option>Meeting</option>
                            <option>Lainnya</option>
                        </select>

                        <input id="tujuan_lainnya"
                            name="tujuan_lainnya"
                            class="input hidden"
                            placeholder="Tulis tujuan kunjungan lainnya">

                        <select id="info" name="informasi" class="input">
                            <option value="">-- Cara memperoleh informasi --</option>
                            <option>Melihat/Membaca/Mendengarkan/Mencatat</option>
                            <option>Mendapatkan Salinan informasi</option>
                        </select>

                        <!-- UPLOAD MODERN -->
                        <div id="uploadBox" class="upload-box">
                            <input type="file" id="fileInput" name="file_upload" class="hidden">

                            <div class="text-center">
                                <div class="text-5xl text-gray-400 mb-3">📁</div>
                                <p class="text-blue-600 font-medium">Klik untuk upload</p>
                                <p class="text-gray-500 text-sm">atau drag file ke sini</p>
                                <p class="text-gray-400 text-xs mt-2">
                                    Maksimal 1 file, ukuran 5MB. JPG, PNG, PDF
                                </p>
                            </div>
                        </div>

                        <img id="previewImg" class="hidden mt-3 rounded-xl max-h-40">
                        <p id="fileName" class="hidden text-sm mt-2"></p>

                        <textarea id="keterangan" name="keterangan" class="input" placeholder="Keterangan"></textarea>

                    </div>
                </div>

                <!-- ERROR -->
                <p id="errorMsg" class="text-red-500 hidden mt-2"></p>

                <!-- BUTTON -->
                <div class="flex justify-between mt-6">
                    <button type="button" onclick="prevStep()" id="btnPrev"
                        class="hidden bg-gray-300 px-4 py-2 rounded">
                        Kembali
                    </button>

                    <button type="button" onclick="nextStep()"
                        class="bg-blue-600 text-white px-6 py-2 rounded">
                        Lanjut
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<style>
.input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 12px;
}
.input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 2px #93c5fd;
}

/* progress */
.circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #d1d5db;
    display: flex;
    align-items: center;
    justify-content: center;
}
.circle.active {
    background: #2563eb;
    color: white;
}
.label {
    font-size: 12px;
}
.label.active {
    color: #2563eb;
    font-weight: 600;
}
.line {
    height: 3px;
    flex: 1;
    background: #e5e7eb;
}
.line.active {
    background: #2563eb;
}

/* upload */
.upload-box {
    border: 2px dashed #d1d5db;
    padding: 30px;
    border-radius: 16px;
    cursor: pointer;
}
.upload-box:hover {
    border-color: #2563eb;
    background: #eff6ff;
}
</style>

<script>
let step = 1;

function showStep(s){

    document.querySelectorAll('.step').forEach(e =>
        e.classList.add('hidden')
    );

    document.getElementById('step' + s)
        .classList.remove('hidden');

    document.getElementById('btnPrev').style.display =
        s === 1 ? 'none' : 'block';

    for(let i = 1; i <= 3; i++){

        document.getElementById('circle' + i)
            .classList.toggle('active', i <= s);

        document.querySelectorAll('.label')[i - 1]
            .classList.toggle('active', i <= s);

    }

    document.getElementById('line1')
        .classList.toggle('active', s > 1);

    document.getElementById('line2')
        .classList.toggle('active', s > 2);

}

/* VALIDASI + NEXT STEP */
function nextStep(){

    let error = "";

    // ================= STEP 1 =================
    if(step === 1){

        if(
            !document.getElementById('nama').value.trim() ||
            !document.getElementById('email').value.trim() ||
            !document.getElementById('nohp').value.trim() ||
            !document.getElementById('jk').value.trim() ||
            !document.getElementById('alamat').value.trim()
        ){

            error = "Lengkapi semua data diri!";

        }

    }

    // ================= STEP 2 =================
    if(step === 2){

        let profesi = document.getElementById('profesi')
            .value.trim();

        let pendidikan = document.getElementById('pendidikan')
            .value.trim();

        let instansi = document.querySelector('input[name="instansi"]')
            .value.trim();

        // wajib isi semua
        if(
            profesi === "" ||
            pendidikan === "" ||
            instansi === ""
        ){

            error = "Lengkapi informasi tambahan!";

        }

        // jika pilih lainnya
        if(
            profesi === "Lainnya" &&
            document.getElementById('profesi_lainnya')
                .value.trim() === ""
        ){

            error = "Isi profesi lainnya!";

        }

    }

    // ================= STEP 3 =================
    if(step === 3){

        if(
            !document.getElementById('tujuan').value.trim() ||
            !document.getElementById('info').value.trim() ||
            !document.getElementById('keterangan').value.trim()
        ){

            error = "Lengkapi data kunjungan!";

        }
        // jika pilih lainnya
        if(
            document.getElementById('tujuan').value === "Lainnya" &&
            document.getElementById('tujuan_lainnya').value.trim() === ""
        ){

            error = "Isi tujuan kunjungan lainnya!";

        }
    }

    // ================= ADA ERROR =================
    if(error){

        Swal.fire({
            icon: 'warning',
            title: 'Form belum lengkap',
            text: error,
            confirmButtonColor: '#2563eb'
        });

        return;

    }

    // ================= PINDAH STEP / SUBMIT =================
    if(step < 3){

        step++;
        showStep(step);

    } else {

        document.getElementById('formMultiStep').submit();

    }

}

/* PREV STEP */
function prevStep(){

    step--;
    showStep(step);

}

showStep(step);

/* ================= PROFESI LAINNYA ================= */
document.getElementById('profesi')
    .addEventListener('change', function(){

    document.getElementById('profesi_lainnya')
        .classList.toggle(
            'hidden',
            this.value !== 'Lainnya'
        );

});

/* ================= TUJUAN LAINNYA ================= */
document.getElementById('tujuan')
    .addEventListener('change', function(){

    document.getElementById('tujuan_lainnya')
        .classList.toggle(
            'hidden',
            this.value !== 'Lainnya'
        );

});

/* ================= UPLOAD ================= */

const box = document.getElementById('uploadBox');
const input = document.getElementById('fileInput');
const preview = document.getElementById('previewImg');
const fileName = document.getElementById('fileName');

box.onclick = () => input.click();

input.onchange = () => handle(input.files[0]);

function handle(file){

    if(!file) return;

    // VALIDASI UKURAN
    if(file.size > 5 * 1024 * 1024){

        Swal.fire({
            icon: 'error',
            title: 'File terlalu besar',
            text: 'Maksimal ukuran file 5MB',
            confirmButtonColor: '#2563eb'
        });

        return;

    }

    // TAMPILKAN NAMA FILE
    fileName.innerText = file.name;
    fileName.classList.remove('hidden');

    // PREVIEW GAMBAR
    if(file.type.startsWith('image/')){

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');

    } else {

        preview.classList.add('hidden');

    }

}
</script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Pendaftaran Telah Berhasil',
    text: 'Data tamu berhasil dikirim ke sistem. Terima kasih telah mendaftar!',
    confirmButtonColor: '#2563eb'
});
</script>
@endif

</body>
</html>