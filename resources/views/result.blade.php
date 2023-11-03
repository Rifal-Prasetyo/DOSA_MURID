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

<body class="bg-slate-100">

    <div class="bg-blue-500 text-white py-10">
        <div class="container mx-auto text-center text-4xl font-bold">
            {{ config('app.name', 'Laravel') }}
        </div>
    </div>
    <div class="mt-4 bg-white rounded-md p-4">
        <div class="container mx-auto ">
            <div class="text-4xl font-semibold">NIS YANG DIKIRIM: {{ $nis }}</div>
            <div class="font-base">
                @if ($siswa == null)
                    .::SISWA TIDAK DITEMUKAN:.
                @else
                    <table>
                        <tr>
                            <td>Nama: {{ $siswa->nama }}</td>
                        </tr>
                        <tr>
                            <td>NISN: {{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <td>Kelas: {{ $siswa->kelas->nama_kelas }}</td>
                        </tr>
                        <tr>
                            <td>Jurusan: {{ $siswa->kelas->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <td>Alamat: {{ $siswa->alamat }}</td>
                        </tr>
                    </table>

                    <form action="{{ route('pelanggaran.store.aksi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                        <div class="mb-4">
                            <label for="tanggal" class="block mb-2 text-lg font-medium">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="bg-gray-50 border border-gray-300 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        </div>


                        <div class="mb-4">
                            <label for="waktu" class="block mb-2 text-lg font-medium">Waktu</label>
                            <input type="time" id="waktu" name="waktu"
                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        </div>
                        <select name="kode_bk" id="">
                            <option value="" disabled selected>--- PILIH ---</option>
                            @foreach ($guruBK as $bk)
                                <option value="{{ $bk->kode_bk }}">{{ $bk->nama }}</option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2.5 text-center ">Catat
                            Pelanggaran</button>
                    </form>
                @endif

            </div>

        </div>
    </div>
</body>

</html>
