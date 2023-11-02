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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class=" flex justify-center items-center  h-screen ">
        <div class=" w-80 bg-slate-200 shadow-lg rounded-lg inline-block">
            <div class="image flex justify-center mt-4 mb-4">
                <img src="{{ asset('img/dosmur-2.png') }}" alt="" class="w-[5rem] h-auto rounded-full ">
            </div>
            <div class="body px-4 mb-5 w-full">
                <h1 class="font-bold text-center mb-2">{{ config('app.name', 'laravel') }}</h1>
                <form action="{{ route('student.result') }}" method="get">
                    <div class="mb-4">
                        <label for="nis"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Nis
                            Kamu</label>
                        <input type="number" id="nis" name="nis"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="NIS" required>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2"><i
                            class="bi bi-search mr-2"></i>Cari</button>

                    <p class="text-xs font-thin text-slate-300 text-center">PT BOGENG MEDIA PRIMA</p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
