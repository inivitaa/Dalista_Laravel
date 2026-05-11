<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f5f7fb]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('admin.sidebar')

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        @yield('content')

    </main>

</div>

</body>
</html>