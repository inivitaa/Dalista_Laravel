<div class="w-72 bg-white border-r shadow-sm p-5">

    <!-- LOGO -->
    <div class="flex items-center gap-3 border-b pb-5 mb-6">

        <img src="{{ asset('images/logo-dalista.jpg') }}"
            class="w-12 h-12 rounded-xl object-cover">

        <div>

            <img src="{{ asset('images/logo-dalista-text.jpg') }}"
                class="h-7 object-contain">

            <p class="text-sm text-gray-400">
                Portal Pengunjung
            </p>

        </div>

    </div>

    <!-- MENU -->
    <div class="space-y-2">

        <a href="/form"
            class="flex items-center gap-3 bg-green-50 text-green-600 px-4 py-3 rounded-2xl font-medium">

            👤 Pendaftaran Tamu

        </a>

        <a href="/status"
            class="flex items-center gap-3 text-gray-700 hover:bg-gray-100 px-4 py-3 rounded-2xl">

            🔔 Status Pengajuan

        </a>

        <a href="/survey"
            class="flex items-center gap-3 text-gray-700 hover:bg-gray-100 px-4 py-3 rounded-2xl">

            📋 Survei

        </a>

    </div>

</div>