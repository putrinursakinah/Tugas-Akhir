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
use App\Http\Controllers\JenisBiayaController;
use App\Http\Controllers\TagihanSiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PaguSppController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\KomponenController;

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
Route::get('/register', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login_proses']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kepsek/dashboard', [KepsekController::class, 'index'])->name('kepsek.dashboard');
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
// Pindahkan ke luar middleware kalau endpoint API tidak butuh login
Route::get('/kelas/api/siswa-by-angkatan/{angkatan}', [KelasController::class, 'getSiswaByAngkatan']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('kelas')->group(function () {
        Route::get('/view', [KelasController::class, 'index'])->name('kelas.view');
        Route::get('/add', [KelasController::class, 'create'])->name('kelas.add');
        Route::post('/store', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/{id}/peserta', [KelasController::class, 'lihatPeserta'])->name('kelas.peserta');
        Route::get('/{id}/tambah-peserta', [KelasController::class, 'formTambahPeserta'])->name('kelas.form_tambah_kelas');
        Route::post('/{id}/tambah-peserta', [KelasController::class, 'simpanPeserta'])->name('kelas.tambah_kelas');
        Route::get('/{id}/peserta/tambah', [KelasController::class, 'tambahPeserta'])->name('kelas.peserta.tambah');
        Route::post('/{id}/peserta/simpan', [KelasController::class, 'simpanPeserta'])->name('kelas.peserta.simpan');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('jenis')->group(function () {
        Route::get('/view', [JenisBiayaController::class, 'index'])->name('jenis.view');
        Route::get('/add', [JenisBiayaController::class, 'create'])->name('jenis.add');
        Route::post('/store', [JenisBiayaController::class, 'store'])->name('jenis.store');
        Route::get('/edit/{id}', [JenisBiayaController::class, 'edit'])->name('jenis.edit');
        Route::post('/update/{id}', [JenisBiayaController::class, 'update'])->name('jenis.update');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('tagihan')->group(function () {
        Route::get('/view', [TagihanSiswaController::class, 'index'])->name('tagihan.view');
        Route::get('/add', [TagihanSiswaController::class, 'create'])->name('tagihan.add');
        Route::post('/store', [TagihanSiswaController::class, 'store'])->name('tagihan.store');
        Route::get('/generate', [TagihanSiswaController::class, 'generatePage'])->name('tagihan.generate.page');
        Route::post('/generate/proces', [TagihanSiswaController::class, 'generate'])->name('tagihan.generate');
        Route::get('/get-siswa-by-kelas/{kelas_id}', [TagihanSiswaController::class, 'getSiswaByKelas']);
        Route::delete('/delete/{id}', [TagihanSiswaController::class, 'destroy'])->name('tagihan.delete');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('pembayaran')->group(function () {
        Route::get('/view', [PembayaranController::class, 'index'])->name('pembayaran.view');
        Route::get('/add/{siswa_id}', [PembayaranController::class, 'create'])->name('pembayaran.add');
        Route::post('/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/tambah/{siswa_id}', [PembayaranController::class, 'create'])->name('pembayaran.tambah');
        Route::post('/pembayaran/simpan', [PembayaranController::class, 'store'])->name('pembayaran.simpan');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('pagu')->group(function () {
        Route::get('/view', [PaguSppController::class, 'index'])->name('pagu.view');
        Route::post('/pagu-spp/store', [PaguSppController::class, 'store'])->name('pagu-spp.store');
    });
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/view', [SiswaController::class, 'index'])->name('siswa.view');
        Route::get('/add', [SiswaController::class, 'create'])->name('siswa.add');
        Route::post('/store', [siswaController::class, 'store'])->name('siswa.store');
        Route::get('/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::post('/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::get('/siswa/export/excel', [SiswaController::class, 'exportExcel'])->name('siswa.export.excel');
        Route::post('/siswa/import', [SiswaController::class, 'importExcel'])->name('siswa.import.excel');
        Route::get('/siswa/template-excel', [SiswaController::class, 'downloadTemplate'])->name('siswa.template.excel');
        Route::post('/delete', [SiswaController::class, 'destroySelected'])->name('siswa.delete');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('rkas')->group(function () {
        Route::get('/view', [DataAnggaranController::class, 'index'])->name('rkas.view');
        Route::get('/add/{kategori_id}', [DataAnggaranController::class, 'create'])->name('rkas.add');
        Route::post('/store', [DataAnggaranController::class, 'store'])->name('rkas.store');
        Route::get('/komponen/tambah/{id}', [DataAnggaranController::class, 'komponenForm'])->name('rkas.komponen.tambah');
        Route::post('/komponen/simpan', [DataAnggaranController::class, 'komponenSimpan'])->name('rkas.komponen.simpan');
        Route::post('/{komponen_id}/akun', [DataAnggaranController::class, 'akunStore'])->name('rkas.akunStore');
        Route::get('/akun/tambah/{komponen_id}', [DataAnggaranController::class, 'akunTambah'])->name('rkas.akun.tambah');
        Route::get('/detail/tambah/{akun_id}', [DataAnggaranController::class, 'detailTambah'])->name('rkas.detail.tambah');
        Route::post('/{akun_id}/detail', [DataAnggaranController::class, 'detailStore'])->name('rkas.detailStore');
        Route::get('/edit/{id}', [DataAnggaranController::class, 'edit'])->name('rkas.edit');
        Route::put('/update/{id}', [DataAnggaranController::class, 'update'])->name('rkas.update');
        Route::get('/cetak', [DataAnggaranController::class, 'cetak'])->name('rkas.cetak');
        Route::get('/download', [DataAnggaranController::class, 'downloadExcel'])->name('rkas.download');
        Route::delete('/{id}', [DataAnggaranController::class, 'destroy'])->name('rkas.delete');
        Route::post('/lock', [DataAnggaranController::class, 'lock'])->name('rkas.lock');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('transaksi')->group(function () {
        Route::get('/view', [TransaksiController::class, 'index'])->name('transaksi.view');
        Route::get('/add', [TransaksiController::class, 'create'])->name('transaksi.add');
        Route::get('/get-kategori-by-mode/{id_mode}', [TransaksiController::class, 'getKategoriByMode']);
        Route::get('/get-jenis-transaksi', [TransaksiController::class, 'getJenisTransaksi']);
        Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/cetak/{id}', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
        Route::get('/pagu', [TransaksiController::class, 'pagu'])->name('transaksi.pagu');
        Route::get('/get-dataanggaran-by-kategori/{id}', [TransaksiController::class, 'getDataAnggaranByKategori']);
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('laporan')->group(function () {
        Route::get('/view', [LaporanController::class, 'index'])->name('laporan.realisasi');

        // Route::get('/view', [LaporanController::class, 'index'])->name('laporan.view');
        // Route::get('/add', [LaporanController::class, 'create'])->name('laporan.add');
        // Route::get('/laporan/filter', [TransaksiController::class, 'filterLaporan'])->name('transaksi.laporan.filter');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('histori')->group(function () {
        Route::get('/view', [HistoryController::class, 'index'])->name('histori.view');
        Route::get('/add', [HistoryController::class, 'create'])->name('histori.add');
        Route::post('/store', [HistoryController::class, 'store'])->name('histori.store');
        Route::delete('/{id}', [HistoryController::class, 'destroy'])->name('histori.destroy');
    });
});
