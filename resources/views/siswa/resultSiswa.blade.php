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

<body class="bg-slate-50">
    <h1 class="font-bold text-lg  md:text-2xl px-4 py-5 w-full text-center text-white mb-4 bg-blue-500">
        {{ config('app.name', 'Laravel') }}</h1>
    <main class="container mx-auto">
        <div class="flex  flex-wrap  mb-2">
            <div class="image w-full md:w-1/2 flex justify-center shadow-xl rounded-md">
                <img src="{{ asset($siswa->foto) }}" alt="" class="">
            </div>
            <div class="body w-full md:w-1/2 inline-block px-6 py-6 bg-slate-100 shadow-lg rounded-md ">
                <h2 class="font-bold text-md text-slate-700 uppercase mb-2">SISWA</h2>
                <h3 class="font-bold text-3xl text-slate-900 mb-2 ">{{ $siswa->nama }}</h3>
                <table class="mb-5">
                    <tr>
                        <td>NISN:</td>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <td>Kelas:</td>
                        <td> {{ $siswa->kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <td>Jurusan: </td>
                        <td>{{ $siswa->kelas->jurusan->nama_jurusan }}</td>
                    </tr>
                    <tr>
                        <td>Alamat:</td>
                        <td> {{ $siswa->alamat }}</td>
                    </tr>
                    <tr>
                </table>
            </div>
        </div>
        <div class="w-full  flex justify-center gap-4 my-4">
            <h3 class="px-6 py-3 bg-slate-700 shadow-xl text-white">POIN PELANGGARAN KAMU</h3>
            <p class="font-bold  shadow-xl px-6 py-3 text-center bg-red-700 text-white"><i
                    class="bi bi-exclamation-circle mr-2"></i>{{ $total }}</p>
        </div>
        <h4 class="font-bold text-2xl m-4">Daftar Aksi</h4>
        @foreach ($siswa->aksi as $list)
            <div class="w-full mb-5 ">
                <div class="px-6 py-6  bg-slate-200 shadow-lg rounded-md  ">
                    <h2 class="font-bold text-md text-slate-700 uppercase mb-4">Aksi {{ $list->kode_aksi }}</h2>

                    <div class="relative overflow-x-auto">

                        <table
                            class="w-full text-sm text-left text-gray-700
                        dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Kode Aksi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pelanggaran
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Keterangan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list->listPelanggaran as $listPelanggaran)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $listPelanggaran->pelanggaran->kode_pelanggaran }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $listPelanggaran->pelanggaran->nama_pelanggaran }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $listPelanggaran->keterangan }}
                                        </th>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </main>


</body>

</html>
