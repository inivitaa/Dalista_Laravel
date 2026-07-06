<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin DALISTA</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-6xl bg-white rounded-3xl overflow-hidden shadow-2xl">

    <div class="grid md:grid-cols-2">

        <!-- KIRI -->
        <div class="relative hidden md:block">

            <img
                src="{{ asset('images/kantor.jpg') }}"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/55"></div>

            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-8">

                <div class="flex items-center justify-center gap-4 mb-8">

                    <img src="{{ asset('images/logo-jateng.png') }}"
                        class="w-20 h-20 object-contain">

                    <img src="{{ asset('images/logo.png') }}"
                        class="w-20 h-20 object-contain">

                </div>


                <h1 class="text-white text-4xl font-bold mb-2">
                        DALISTA
                </h1>

                <p class="text-white text-xl font-medium mt-2">
                    Digitalisasi Layanan Registrasi Tamu
                </p>

                <p class="text-white/90 text-base mt-2">
                    Disnakertrans Provinsi Jawa Tengah
                </p>

</div>

        </div>

        <!-- KANAN -->
        <div class="p-16 flex flex-col justify-center">

            <div class="mb-10">

                <h2 class="text-4xl font-bold text-gray-800">
                    Masuk
                </h2>

                <p class="text-gray-500 mt-2">
                    Silakan masuk ke akun admin DALISTA
                </p>
                @if(session('error'))

                <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-xl mt-4">
                    {{ session('error') }}
                </div>

                @endif

            </div>

            <form
                action="/admin/login"
                method="POST"
                class="space-y-5">

                @csrf

                <div>

                    <label class="block text-sm text-gray-600 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div>

                    <label class="block text-sm text-gray-600 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>
                    
                    <div class="flex items-center gap-2">
                        <input type="checkbox">
                        <span class="text-sm text-gray-600">
                            Ingat saya
                        </span>
                    </div>
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">

                    Masuk

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>