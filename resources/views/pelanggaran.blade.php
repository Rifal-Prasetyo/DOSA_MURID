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

<body class="bg-slate-100">

    <div class="bg-blue-500 text-white py-10 mb-2">
        <div class="container mx-auto text-center text-lg md:text-4xl font-bold">
            {{ config('app.name', 'Laravel') }}
        </div>
    </div>
    <div class="container mx-auto">
        <div class="text-lg md:text-4xl font-semibold mb-4 px-4 py-2 bg-black rounded-md text-white shadow-black"><i
                class="bi bi-envelope-paper mr-3"></i>KODE AKSI
            PELANGGARAN: {{ $kode_aksi }}</div>
        <div class="font-bold bg-slate-200 rounded-md shadow px-4 py-3 mb-2">
            @if ($aksi == null)
                .::AKSI TIDAK DITEMUKAN:.
            @else
                <table class="mb-5">
                    <tr>
                        <td>Nama:</td>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
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
                        <td>Tanggal:</td>
                        <td>{{ $aksi->tanggal }}</td>
                    </tr>
                    <tr>
                        <td>Waktu:</td>
                        <td> {{ $aksi->waktu }}</td>
                    </tr>
                    <tr>
                        <td>GURU BK:</td>
                        <td> {{ $aksi->guruBK->nama }}</td>
                    </tr>
                </table>



                <form action="{{ route('pelanggaran.add.aksi', $kode_aksi) }}" method="POST">
                    @csrf

                    <label for="pelanggaran" id="pelanggaran" class="">Pilih pelanggaran</label>
                    <select name="kode_pelanggaran" id="pelanggaran" class="rounded mb-2">
                        <option value="" disabled selected>--- PILIH PELANGGARAN ---</option>
                        @foreach ($pelanggaranAll as $pelanggaran)
                            <option class="bg-slate-100" value="{{ $pelanggaran->kode_pelanggaran }}">
                                {{ $pelanggaran->nama_pelanggaran }}
                            </option>
                        @endforeach
                    </select>



                    <div class="mb-4">
                        <label for="keterangan" class="block mb-2 text-lg font-medium">Keterangan</label>
                        <input type="text" id="keterangan" name="keterangan"
                            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    </div>
                    <div class="flex gap-4">
                        <button type="submit"
                            class="text-white bg-yellow-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2.5 text-center "><i
                                class="bi bi-plus-circle mr-3"></i>Tambah
                            Pelanggaran</button>
                </form>

                <form action="{{ route('pelanggaran.print') }}" method="post" class="">
                    @csrf
                    <input type="hidden" name="kode_aksi" value="{{ $kode_aksi }}">
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2.5 text-center "><i
                            class="bi bi-printer mr-3"></i>Cetak</button>
                </form>
        </div>
    </div>
    <div class="relative overflow-x-auto rounded-xl  ">
        <table class="w-full text-lg text-left text-gray-700 px-4 py-2 shadow-lg ">
            <thead class="text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Kode Pelanggaran
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pelanggaran
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aksi->listPelanggaran as $pelanggaran)
                    <tr class="bg-white border-b dark:bg-gray-800 ">
                        <td class="px-6 py-4">
                            {{ $pelanggaran->kode_pelanggaran }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pelanggaran->pelanggaran->nama_pelanggaran }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pelanggaran->keterangan }}
                        </td>
                        <td class="px-6 py-4 ">
                            <form action="{{ route('pelanggaran.remove.aksi', $kode_aksi) }}" method="post">
                                @csrf
                                <input type="hidden" name="id_list" value="{{ $pelanggaran->id }}">
                                <button
                                    class="px-4 py-2 w-28  bg-red-600 text-white shadow-red-500 uppercase rounded-md font-bold hover:bg-red-200 ">
                                    <i class=" bi bi-trash mr-3"></i>hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    </div>
    </div>
    </div>


</body>

</html>
