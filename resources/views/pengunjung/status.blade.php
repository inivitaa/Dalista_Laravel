@extends('pengunjung.layout')

@section('content')

<div class="min-h-screen flex justify-center px-6 pt-16">
    <div class="w-full max-w-4xl">

        <!-- HEADER -->
        <div class="text-center mb-10">

            <div class="text-5xl mb-3">
                🔔
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-3">
                Status Pengajuan
            </h1>

            <p class="text-gray-500">
                Masukkan kode tracking untuk melihat status pengajuan tamu.
            </p>

        </div>

        <!-- CARD -->
<div class="bg-white rounded-3xl shadow-xl p-5 md:p-10">
            <!-- FORM -->
            <form action="/status/check"
                method="POST"
                class="space-y-6">

                @csrf

                <div>

                    <label class="block text-lg font-semibold text-gray-700 mb-3">

                        Kode Tracking

                    </label>

                    <input type="text"
                        name="tracking_code"
                        placeholder="Contoh: DLT-2026-0001"
                        class="w-full border border-gray-200 rounded-2xl px-6 py-5 outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition">

                </div>

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl text-lg font-semibold transition duration-300 shadow-lg">

                    Cek Status

                </button>

                <div class="text-center mt-4">

                    <a href="/lupa-token"
                        class="text-blue-500 hover:text-blue-600 text-sm">

                        Lupa token?

                    </a>

                </div>
            </form>

            <!-- HASIL -->
            @isset($guest)

            <div class="mt-10 border-t pt-8">

                <div class="grid md:grid-cols-2 gap-6">

                    <div class="bg-gray-50 rounded-2xl p-5">

                        <p class="text-sm text-gray-400 mb-2">
                            Nama Tamu
                        </p>

                        <h3 class="text-xl font-bold text-gray-800">
                            {{ $guest->nama }}
                        </h3>

                    </div>

                    <div class="bg-gray-50 rounded-2xl p-5">

                        <p class="text-sm text-gray-400 mb-2">
                            Status
                        </p>

                        <h3 class="text-xl font-bold

                        @if($guest->status_kunjungan == 'Menunggu')
                            text-yellow-500
                        @elseif($guest->status_kunjungan == 'Terjadwal')
                            text-blue-500
                        @elseif($guest->status_kunjungan == 'Datang')
                            text-purple-500
                        @elseif($guest->status_kunjungan == 'Selesai')
                            text-green-500
                        @endif

                        ">

                            {{ $guest->status_kunjungan }}

                        </h3>

                    </div>

                    <div class="bg-gray-50 rounded-2xl p-5">

                        <p class="text-sm text-gray-400 mb-2">
                            Tracking Code
                        </p>

                        <h3 class="text-lg font-bold tracking-widest text-gray-800">
                            {{ $guest->tracking_code }}
                        </h3>

                    </div>

                    <div class="bg-gray-50 rounded-2xl p-5">

                        <p class="text-sm text-gray-400 mb-2">
                            Instansi
                        </p>

                        <h3 class="text-lg font-bold text-gray-800">
                            {{ $guest->asal_instansi }}
                        </h3>

                    </div>

                </div>

            </div>

            @endisset

        </div>

    </div>

</div>

@endsection