@extends('pengunjung.layout')

@section('content')

<div class="min-h-screen flex justify-center px-6 pt-16">

    <div class="w-full max-w-3xl">

        <!-- ICON -->
        <div class="text-center mb-8">

            <div class="text-6xl mb-3">
                🔔
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Lupa Token?
            </h1>

            <p class="text-gray-500">
                Masukkan email yang terdaftar untuk melihat token Anda.
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-10">

            <!-- FORM -->
            <form action="/lupa-token"
                method="POST"
                class="space-y-6">

                @csrf

                <div>

                    <label class="block text-gray-700 font-semibold mb-3">

                        Email Terdaftar

                    </label>

                    <div class="relative">

                        <span class="absolute left-5 top-4 text-gray-400 text-xl">
                            ✉️
                        </span>

                        <input type="email"
                            name="email"
                            placeholder="Masukkan email Anda"
                            class="w-full border border-blue-200 rounded-2xl pl-14 pr-5 py-4 outline-none focus:ring-4 focus:ring-blue-100">

                    </div>

                </div>

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl text-lg font-semibold shadow-lg transition">

                    📨 Kirim

                </button>

            </form>

            <!-- KEMBALI -->
            <div class="flex items-center gap-4 my-6">

                <div class="flex-1 h-px bg-gray-200"></div>

                <span class="text-gray-400 text-sm">
                    atau
                </span>

                <div class="flex-1 h-px bg-gray-200"></div>

            </div>

            <div class="text-center">

                <a href="/status"
                    class="text-blue-500 hover:text-blue-600 font-medium">

                    ← Kembali

                </a>

            </div>

            <!-- HASIL TOKEN -->
            @isset($guest)

            <div class="mt-8 border-t pt-8">

                <div class="bg-green-50 border border-green-200 rounded-3xl p-6">

                    <div class="flex items-start gap-4">

                        <div class="text-4xl">
                            ✅
                        </div>

                        <div class="flex-1">

                            <h2 class="text-2xl font-bold text-green-700 mb-2">

                                Token Anda Ditemukan!

                            </h2>

                            <p class="text-gray-600 mb-6">

                                Gunakan token berikut untuk cek status pengajuan.

                            </p>

                            <div class="border-2 border-dashed border-green-300 rounded-2xl p-5 bg-white flex items-center justify-between">

                                <div>

                                    <p class="text-sm text-gray-400 mb-1">
                                        Tracking Code
                                    </p>

                                    <h3 class="text-3xl font-bold tracking-widest text-green-600">

                                        {{ $guest->tracking_code }}

                                    </h3>

                                </div>

                                <button
                                    onclick="copyToken()"
                                    class="bg-green-100 hover:bg-green-200 text-green-700 px-5 py-3 rounded-xl font-semibold">

                                    📋 Salin

                                </button>

                            </div>

                            <p class="text-sm text-gray-500 mt-5">

                                Simpan token ini untuk memudahkan pengecekan status pengajuan.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <script>

                function copyToken() {

                    navigator.clipboard.writeText(
                        "{{ $guest->tracking_code }}"
                    );

                    alert('Token berhasil disalin');

                }

            </script>

            @endisset

        </div>

    </div>

</div>

@endsection