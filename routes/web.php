<?php

use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use Database\Seeders\PelanggaranSeeder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



// require __DIR__.'/auth.php';

Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/result', [SiswaController::class, 'result'])->name('result');
Route::get('/pelanggaranSaya', [PelanggaranController::class, 'siswaPage'])->name('student.page');
Route::get('/pelanggaransaya/saya', [PelanggaranController::class, 'totalPoint'])->name('student.result');
Route::get('/pelanggaran/{aksi}', [PelanggaranController::class, 'pelanggaran'])->name('pelanggaran');
Route::post('/pelanggaran/store/aksi', [PelanggaranController::class, 'storeAksi'])->name('pelanggaran.store.aksi');
Route::post('/pelanggaran/add/{aksi}', [PelanggaranController::class, 'addAksi'])->name('pelanggaran.add.aksi');
Route::post('/pelanggaran/print', [PelanggaranController::class, 'print'])->name('pelanggaran.print');
Route::post('/pelanggaran/remove/{aksi}', [PelanggaranController::class, 'removeAksi'])->name('pelanggaran.remove.aksi');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
