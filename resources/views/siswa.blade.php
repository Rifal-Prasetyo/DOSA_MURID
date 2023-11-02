<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <section class="w-screen h-screen relative">
        <img src="{{ asset('img/cewek.webp') }}" alt="Cewek" srcset="" class="w-screen h-screen object-cover">
        <div class="herro">
            <div class="text-2xl md:text-5xl px-3 text-center font-bold text-white mb-2 md:mb-3">
                {{ config('app.name', 'Laravel') }}</div>
            <div class="text-lg md:text-2xl font-medium text-slate-300 mb-2 md:mb-4">Masukan Nis Kamu... Dibawah... ini
            </div>
            <div class="flex">
                <form action="{{ route('result') }}" method="GET" id="form">
                    <input type="number" name="nis" id="id" placeholder="NIS (NOMOR INDUK SISWA)" required
                        class="text-lg rounded-md transition-all delay-150 active:border active:border-blue-500   ">
                    <button type="submit"
                        class="text-lg bg-violet-500 text-white shadow-md rounded-lg px-5 py-2 hover:border hover:border-blue-500  "><i
                            class="bi bi-search"></i>Cari</button>

                </form>
            </div>
            <div class="mt-4">
                <a href="{{ route('student.page') }}"
                    class="text-lg bg-red-500 text-white shadow-md rounded-lg px-2 border border-red-500 py-2 hover:border hover:border-blue-500  ">Kamu
                    Siswa? Klik Disini</a>
            </div>
            <div class="text-center text-xs text-opacity-60 text-white font-serif uppercase mt-6">pt. bogeng media prima
            </div>
        </div>

    </section>
</body>

</html>
