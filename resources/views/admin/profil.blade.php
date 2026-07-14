@extends('admin.layout')

@section('content')

<div class="p-4 sm:p-8">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
            Profil Admin
        </h1>
        <p class="text-gray-500 mt-2 text-sm sm:text-base">
            Kelola informasi akun administrator DALISTA
        </p>
    </div>

    <!-- MAIN GRID (Dibuat bertumpuk di HP, 3-kolom di Desktop) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- CARD PROFIL (KIRI) -->
        <div class="bg-white rounded-3xl shadow-sm p-6 sm:p-8">
            <div class="flex flex-col items-center">
                <!-- FOTO -->
                <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full bg-blue-100 flex items-center justify-center text-4xl sm:text-5xl mb-4 shrink-0">
                    👤
                </div>

                <!-- NAMA -->
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 text-center">
                    {{ $admin->nama_lengkap }}
                </h2>

                <!-- USERNAME -->
                <p class="text-gray-500 mt-1 text-sm sm:text-base">
                    {{ '@'.$admin->username }}
                </p>

                <!-- ROLE -->
                <span class="mt-3 px-4 py-1.5 bg-blue-100 text-blue-700 rounded-full text-xs sm:text-sm font-semibold text-center">
                    Administrator DALISTA
                </span>
            </div>

            <!-- INFO LAIN -->
            <div class="mt-8 space-y-4 text-xs sm:text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">ID Admin</span>
                    <span class="font-semibold text-gray-800">#{{ $admin->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Bergabung</span>
                    <span class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($admin->created_at)->format('d M Y') }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span class="text-green-600 font-semibold flex items-center gap-1.5">
                        ● Aktif
                    </span>
                </div>
            </div>
        </div>

        <!-- INFORMASI AKUN (KANAN) -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm p-6 sm:p-8 flex flex-col justify-between">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-8">
                    Informasi Akun
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-500 text-sm mb-2">
                            Nama Lengkap
                        </label>
                        <div class="border rounded-2xl p-4 bg-gray-50 text-sm text-gray-700">
                            {{ $admin->nama_lengkap }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-sm mb-2">
                            Username
                        </label>
                        <div class="border rounded-2xl p-4 bg-gray-50 text-sm text-gray-700">
                            {{ $admin->username }}
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-500 text-sm mb-2">
                            Email
                        </label>
                        <div class="border rounded-2xl p-4 bg-gray-50 text-sm text-gray-700 truncate" title="{{ $admin->email }}">
                            {{ $admin->email }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="mt-10 pt-4 border-t border-gray-100 flex justify-end">
                <button
                    onclick="document.getElementById('passwordModal').classList.remove('hidden')"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-2xl font-semibold text-sm transition text-center shadow-md shadow-blue-500/20">
                    🔒 Ubah Password
                </button>
            </div>
        </div>

    </div>
</div>

<!-- =========================
     MODAL GANTI PASSWORD (Diperbaiki agar proporsional di HP)
========================= -->
<div id="passwordModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl p-6 sm:p-8 w-full max-w-md my-auto relative shadow-2xl">
        <h3 class="text-xl sm:text-2xl font-bold mb-6 text-gray-800">
            Ubah Password
        </h3>

        <form action="{{ route('admin.change-password') }}" method="POST">
            @csrf

            <!-- PASSWORD LAMA -->
            <div class="mb-4 text-sm text-gray-700">
                 <label class="font-medium text-gray-600">Password Lama</label>
                <div class="relative mt-2">
                    <input
                        id="old_password"
                        type="password"
                        name="old_password"
                        class="w-full border rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                    <button
                        type="button"
                        onclick="togglePassword('old_password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <span class="eye-open">👁️</span>
                        <span class="eye-slash hidden">🙈</span>
                    </button>
                </div>
            </div>

            <!-- PASSWORD BARU -->
            <div class="mb-4 text-sm text-gray-700">
                <label class="font-medium text-gray-600">Password Baru</label>
                <div class="relative mt-2">
                    <input
                        id="new_password"
                        type="password"
                        name="new_password"
                        class="w-full border rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                    <button
                        type="button"
                        onclick="togglePassword('new_password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <span class="eye-open">👁️</span>
                        <span class="eye-slash hidden">🙈</span>
                    </button>
                </div>
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-6 text-sm text-gray-700">
                <label class="font-medium text-gray-600">Konfirmasi Password Baru</label>
                <div class="relative mt-2">
                    <input
                        id="confirm_password"
                        type="password"
                        name="new_password_confirmation"
                        class="w-full border rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                    <button
                        type="button"
                        onclick="togglePassword('confirm_password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <span class="eye-open">👁️</span>
                        <span class="eye-slash hidden">🙈</span>
                    </button>
                </div>
            </div>

            <!-- AKSI MODAL (Batal / Simpan) -->
            <div class="flex gap-3 text-sm font-semibold">
                <button
                    type="button"
                    onclick="document.getElementById('passwordModal').classList.add('hidden')"
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 py-3 rounded-xl transition">
                    Batal
                </button>
                <button
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition shadow-md shadow-blue-500/10">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    confirmButtonColor: '#2563eb',
    confirmButtonText: 'OK',
    timer: 2200,
    timerProgressBar: true
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ session('error') }}',
    confirmButtonColor: '#dc2626',
    confirmButtonText: 'OK'
});
</script>
@endif

<script>
function togglePassword(id, button) {
    const input = document.getElementById(id);
    const eyeOpen = button.querySelector('.eye-open');
    const eyeSlash = button.querySelector('.eye-slash');

    if (input.type === "password") {
        input.type = "text";
        eyeOpen.classList.add("hidden");
        eyeSlash.classList.remove("hidden");
    } else {
        input.type = "password";
        eyeOpen.classList.remove("hidden");
        eyeSlash.classList.add("hidden");
    }
}
</script>

@endsection