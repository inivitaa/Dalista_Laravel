@extends('admin.layout')

@section('content')

<div class="p-8">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-gray-800">
            Profil Admin
        </h1>

        <p class="text-gray-500 mt-2">
            Kelola informasi akun administrator DALISTA
        </p>
       
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- CARD PROFIL -->
        <div class="bg-white rounded-3xl shadow-sm p-8">

            <div class="flex flex-col items-center">

                <!-- FOTO -->
                <div class="w-32 h-32 rounded-full bg-blue-100 flex items-center justify-center text-5xl mb-4">

                    👤

                </div>

                <!-- NAMA -->
                <h2 class="text-2xl font-bold text-gray-800">

                    {{ $admin->nama_lengkap }}

                </h2>

                <!-- USERNAME -->
                <p class="text-gray-500 mt-1">

                    {{ '@'.$admin->username }}

                </p>

                <!-- ROLE -->
                <span class="mt-3 px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">

                    Administrator DALISTA

                </span>

            </div>

            <!-- INFO -->
            <div class="mt-8 space-y-4 text-sm">

                <div class="flex justify-between">

                    <span class="text-gray-500">
                        ID Admin
                    </span>

                    <span class="font-semibold">
                        #{{ $admin->id }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Bergabung
                    </span>

                    <span class="font-semibold">

                        {{ \Carbon\Carbon::parse($admin->created_at)->format('d M Y') }}

                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Status
                    </span>

                    <span class="text-green-600 font-semibold">
                        ● Aktif
                    </span>

                </div>

            </div>

        </div>

        <!-- INFORMASI AKUN -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm p-8">

            <div class="flex justify-between items-center mb-8">

                <h2 class="text-2xl font-bold text-gray-800">
                    Informasi Akun
                </h2>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block text-gray-500 mb-2">
                        Nama Lengkap
                    </label>

                    <div class="border rounded-2xl p-4 bg-gray-50">

                        {{ $admin->nama_lengkap }}

                    </div>

                </div>

                <div>

                    <label class="block text-gray-500 mb-2">
                        Username
                    </label>

                    <div class="border rounded-2xl p-4 bg-gray-50">

                        {{ $admin->username }}

                    </div>

                </div>

                <div class="md:col-span-2">

                    <label class="block text-gray-500 mb-2">
                        Email
                    </label>

                    <div class="border rounded-2xl p-4 bg-gray-50">

                        {{ $admin->email }}

                    </div>

                </div>

            </div>

            <!-- TOMBOL -->
            <div class="mt-8 flex flex-wrap gap-4">

            <button
                onclick="document.getElementById('passwordModal').classList.remove('hidden')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-semibold transition">

                🔒 Ubah Password

            </button>

        </div>

        </div>

    </div>

</div>
<div
    id="passwordModal"
    class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">

    <div class="bg-white rounded-3xl p-8 w-full max-w-md">

        <h3 class="text-2xl font-bold mb-6">
            Ubah Password
        </h3>

        <form
            action="{{ route('admin.change-password') }}"
            method="POST">

            @csrf

            <div class="mb-4">

                 <label>Password Lama</label>

                <div class="relative mt-2">

                    <input
                        id="old_password"
                        type="password"
                        name="old_password"
                        class="w-full border rounded-xl px-4 py-3 pr-12"
                        required>

                    <button
                        type="button"
                        onclick="togglePassword('old_password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">

                    </button>

                </div>

            </div>

            <div class="mb-4">

                <label>Password Baru</label>

                <div class="relative mt-2">

                    <input
                        id="new_password"
                        type="password"
                        name="new_password"
                        class="w-full border rounded-xl px-4 py-3 pr-12"
                        required>

                    <button
                        type="button"
                        onclick="togglePassword('new_password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">

                    </button>

                </div>

            </div>

            <div class="mb-6">

                <label>Konfirmasi Password Baru</label>

                <div class="relative mt-2">

                    <input
                        id="confirm_password"
                        type="password"
                        name="new_password_confirmation"
                        class="w-full border rounded-xl px-4 py-3 pr-12"
                        required>

                    <button
                        type="button"
                        onclick="togglePassword('confirm_password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">

                    </button>

                </div>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="flex-1 bg-blue-600 text-white py-3 rounded-xl">

                    Simpan

                </button>

                <button
                    type="button"
                    onclick="document.getElementById('passwordModal').classList.add('hidden')"
                    class="flex-1 bg-gray-200 py-3 rounded-xl">

                    Batal

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
<script>

function togglePassword(id, button)
{
    const input = document.getElementById(id);

    const eyeOpen = button.querySelector('.eye-open');
    const eyeSlash = button.querySelector('.eye-slash');

    if (input.type === "password")
    {
        input.type = "text";

        eyeOpen.classList.add("hidden");
        eyeSlash.classList.remove("hidden");
    }
    else
    {
        input.type = "password";

        eyeOpen.classList.remove("hidden");
        eyeSlash.classList.add("hidden");
    }
}

</script>
@endif

@endsection