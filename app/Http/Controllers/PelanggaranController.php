<?php

namespace App\Http\Controllers;


use App\Models\Aksi;
use App\Models\Siswa;
use Mike42\Escpos\Printer;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Mike42\Escpos\EscposImage;
use App\Models\ListPelanggaran;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class PelanggaranController extends Controller
{
    //
    public function pelanggaran($aksi)
    {
        $kode_aksi = $aksi;
        $aksi = Aksi::where('kode_aksi', $aksi)
            ->with('siswa.kelas.jurusan', 'guruBK', 'listPelanggaran.pelanggaran')
            ->first();
        $siswa = $aksi->siswa ?? null;
        $pelanggaranAll = Pelanggaran::all();
        return view('pelanggaran', compact('aksi', 'siswa', 'kode_aksi', 'pelanggaranAll'));
    }

    public function print(Request $request)
    {
        $request->validate([
            'kode_aksi' => 'required'
        ]);
        $kode_aksi = $request->kode_aksi;
        $aksi = Aksi::where('kode_aksi', $kode_aksi)
            ->with('siswa.kelas.jurusan', 'guruBK', 'listPelanggaran.pelanggaran')
            ->first();

        $siswa = $aksi->siswa ?? null;
        if ($siswa === null) {
            redirect()->back();
        }


        $connector = new FilePrintConnector("/dev/usb/lp0");
        $printer = new Printer($connector);

        // print logo
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $logo = public_path('img/dosmur-2.png');
        $logo = EscposImage::load($logo);
        $printer->graphics($logo);
        $printer->feed();
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_EMPHASIZED);
        $printer->text("DOSA MURID\n");
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
        $printer->text("Sistem Pencatatan Anak Nakal\n");
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_EMPHASIZED);
        $printer->text("SMK Negeri 1 Bangsri\n\n");
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);


        // Print Data Siswa
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->selectPrintMode();
        $printer->text("Nama Siswa  :" . $siswa->nama . "\n");
        $printer->text("NISN        :" . $siswa->nisn . "\n");
        $printer->text("NIS         :" . $siswa->nis . "\n");
        $printer->text("Kelas       :" . $siswa->kelas->nama_kelas . "\n");
        $printer->text("Jurusan     :" . $siswa->kelas->jurusan->nama_jurusan . "\n");
        $printer->text("Alamat      :" . $siswa->alamat . "\n");
        $printer->text("Tanggal     :" . $aksi->tanggal . "\n");
        $printer->text("Waktu       :" . $aksi->waktu . "\n");
        $printer->text("Guru BK     :" . $aksi->guruBK->nama . "\n");
        $printer->text("Poin Total  :" . $aksi->siswa->nis . "\n");


        // print list Pelanggaran
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("**********************\n");
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
        $printer->text("List Pelanggaran\n");
        $printer->selectPrintMode();
        $printer->text("**********************\n");
        $printer->feed();
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        foreach ($aksi->listPelanggaran as $list) {

            $printer->text(" # " . $list->pelanggaran->nama_pelanggaran . "\n");
            $printer->text("  " . $list->keterangan . "\n");
            $printer->feed();
        }
        $printer->text("**********************\n");
        $printer->feed();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Sebaik-baiknya manusia adalah yang tidak mengulangi dosanya kembali, dan mengajak temannya kepada kebaikan\n\n");


        // print qr kode aksi
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->qrCode($kode_aksi, Printer::QR_ECLEVEL_L, 10);
        $printer->text("kode aksi" . $kode_aksi . "\n\n");

        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_EMPHASIZED);
        $printer->text("PT. BOGENG MEDIA PRIMA\n");
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);


        $printer->feed(2);
        $printer->cut();
        $printer->close();








        return redirect()->back();
    }

    public function storeAksi(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i'
        ]);

        $kode_aksi = 'AKS' . fake()->unique()->numerify('###');

        $siswa = Siswa::Where('nis', $request->nis)->first();
        Aksi::create([
            'nis_siswa' => $siswa->nis,
            'kode_aksi' => $kode_aksi,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'kode_bk' => $request->kode_bk
        ]);

        return redirect()->route('pelanggaran', $kode_aksi);
    }

    public function removeAksi($aksi, Request $request)
    {
        $request->validate([
            'id_list' => 'required'
        ]);

        $list = ListPelanggaran::find($request->id_list);
        if ($list->kode_aksi = $aksi) {
            $list->delete();
        }
        return redirect()->back();
    }

    public function addAksi($kode_aksi, Request $request)
    {
        $request->validate([
            'kode_pelanggaran' => 'required',
            'keterangan' => 'required',
            'nis_siswa' => 'required'
        ]);
        $siswaNis = Siswa::where('nis', $request->nis_siswa)->first();
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('images');
            $siswaNis->foto = $path;
            $siswaNis->save();
        }
        $list = ListPelanggaran::create([
            'kode_aksi' => $kode_aksi,
            'kode_pelanggaran' => $request->kode_pelanggaran,
            'keterangan' => $request->keterangan,
        ]);


        return redirect()->back();
    }


    public function siswaPage()
    {
        return view('siswa.index');
    }


    // public function pelanggaranSaya(Request $request)
    // {
    //     $request->validate([
    //         'nis' => 'required'
    //     ]);


    // }
    public function totalPoint(Request $request)
    {
        $request->validate([
            'nis' => 'required'
        ]);
        // data awal
        $siswa = Siswa::where('nis', $request->nis)->with('aksi.listPelanggaran.pelanggaran')->first();
        $total = 0;





        if ($siswa == null) {
            return $total;
        }

        foreach ($siswa->aksi as $aksi) {
            foreach ($aksi->listPelanggaran as $list) {
                $total += $list->pelanggaran->poin;
            }
        }
        return view('siswa.resultSiswa', compact('siswa', 'total'));
    }
}
