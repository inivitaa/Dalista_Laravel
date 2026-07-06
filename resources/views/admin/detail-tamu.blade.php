@extends('admin.layout')

@section('title', 'Detail Tamu')

@section('content')

<main class="p-8">

    <h1 class="text-3xl font-bold">
        Detail Tamu
    </h1>

    <hr class="my-6">

    <h2 class="text-xl font-semibold">
        {{ $guest->nama }}
    </h2>

    <p>{{ $guest->email }}</p>

</main>

@endsection