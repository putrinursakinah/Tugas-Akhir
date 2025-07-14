<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KodeKegiatanController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\KodeAkunController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DataAnggaranController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TahunAjaranKodeKegiatanController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login_proses']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('tahun_ajaran')->group(function () {
        Route::post('/set-tahun', [TahunAjaranKodeKegiatanController::class, 'store'])->name('tahun.store');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('identitas')->group(function () {
        Route::get('/view', [IdentitasController::class, 'index'])->name('identitas.view');
        Route::post('/add', [IdentitasController::class, 'store'])->name('identitas.store');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('kegiatan')->group(function () {
        Route::get('/view', [KodeKegiatanController::class, 'index'])->name('kegiatan.view');
        Route::get('/add', [KodeKegiatanController::class, 'create'])->name('kegiatan.add');
        Route::post('/store', [KodeKegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('/edit/{id}', [KodeKegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('/update/{id}', [KodeKegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('/kegiatan/bulk-delete', [KodeKegiatanController::class, 'bulkDelete'])->name('kegiatan.bulkDelete');
        Route::get('/delete/{id}', [KodeKegiatanController::class, 'destroy'])->name('kegiatan.delete');
    });
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('akun')->group(function () {
        Route::get('/view', [KodeAkunController::class, 'index'])->name('akun.view');
        Route::get('/add', [KodeAkunController::class, 'create'])->name('akun.add');
        Route::post('/store', [KodeAkunController::class, 'store'])->name('akun.store');
        Route::get('/akun/edit/{id}', [KodeAkunController::class, 'edit'])->name('akun.edit');
        Route::put('/update/{id}', [KodeAkunController::class, 'update'])->name('akun.update');
        Route::delete('/akun/bulk-delete', [KodeAkunController::class, 'bulkDelete'])->name('akun.bulkDelete');
        Route::get('/akun/delete/{id}', [KodeAkunController::class, 'destroy'])->name('akun.delete');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/view', [SiswaController::class, 'index'])->name('siswa.view');
        Route::get('/add', [KodeAkunController::class, 'create'])->name('akun.add');
        Route::post('/store', [KodeAkunController::class, 'store'])->name('akun.store');
        Route::get('/akun/edit/{id}', [KodeAkunController::class, 'edit'])->name('akun.edit');
        Route::put('/update/{id}', [KodeAkunController::class, 'update'])->name('akun.update');
        Route::delete('/akun/bulk-delete', [KodeAkunController::class, 'bulkDelete'])->name('akun.bulkDelete');
        Route::get('/akun/delete/{id}', [KodeAkunController::class, 'destroy'])->name('akun.delete');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('rkas')->group(function () {
        Route::get('/view', [DataAnggaranController::class, 'index'])->name('rkas.view');
        Route::get('/add', [DataAnggaranController::class, 'create'])->name('rkas.add');
        Route::post('/store', [DataAnggaranController::class, 'store'])->name('rkas.store');
        Route::get('/rkas/{id}/komponen', [DataAnggaranController::class, 'komponenView'])->name('komponen.rkas');
        Route::post('/rkas/{id}/komponen', [DataAnggaranController::class, 'komponenStore'])->name('rkas.komponenStore');
        Route::get('/rkas/{komponen_id}/akun', [DataAnggaranController::class, 'akunTambah'])->name('rkas.akunTambah');
        Route::post('/rkas/{komponen_id}/akun', [DataAnggaranController::class, 'akunStore'])->name('rkas.akunStore');
        Route::get('/rkas/{akun_id}/detail', [DataAnggaranController::class, 'detailTambah'])->name('rkas.detailTambah');
        Route::post('/rkas/{akun_id}/detail', [DataAnggaranController::class, 'detailStore'])->name('rkas.detailStore');
        Route::get('/rkas/edit/{id}', [DataAnggaranController::class, 'edit'])->name('rkas.edit');
        Route::put('/rkas/update/{id}', [DataAnggaranController::class, 'update'])->name('rkas.update');
        Route::get('/rkas/cetak', [DataAnggaranController::class, 'cetak'])->name('rkas.cetak');
        Route::get('/rkas/download', [DataAnggaranController::class, 'downloadExcel'])->name('rkas.download');
        Route::delete('/rkas/{id}', [DataAnggaranController::class, 'destroy'])->name('rkas.delete');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('transaksi')->group(function () {
        Route::get('/view', [TransaksiController::class, 'index'])->name('transaksi.view');
        Route::get('/add', [TransaksiController::class, 'add'])->name('transaksi.add');
        Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/pagu', [TransaksiController::class, 'pagu'])->name('transaksi.pagu');
        Route::get('/get-pagu-data', [TransaksiController::class, 'getPaguData'])->name('transaksi.getPaguData');
    });
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::prefix('laporan')->group(function () {
//         Route::get('/view', [LaporanController::class, 'index'])->name('laporan.view');
//         Route::get('/add', [LaporanController::class, 'create'])->name('laporan.add');
//         Route::get('/laporan/filter', [TransaksiController::class, 'filterLaporan'])->name('transaksi.laporan.filter');
//     });
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('histori')->group(function () {
        Route::get('/view', [HistoryController::class, 'index'])->name('histori.view');
        Route::get('/add', [HistoryController::class, 'create'])->name('histori.add');
        Route::post('/histori/store', [HistoryController::class, 'store'])->name('histori.store');
        Route::delete('/{id}', [HistoryController::class, 'destroy'])->name('histori.destroy');
    });
});


