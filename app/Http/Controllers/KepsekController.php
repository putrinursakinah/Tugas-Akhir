<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\DataAnggaran;

use Illuminate\Http\Request;

class KepsekController extends Controller
{
    public function index()
    {
         $pendapatanId = Kategori::where('nama_kategori', 'pendapatan')->value('id_kategori');
        $belanjaId = Kategori::where('nama_kategori', 'belanja')->value('id_kategori');
        // Ambil semua anggaran pendapatan
        $rencanaPendapatan = DataAnggaran::whereHas('kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'Pendapatan');
        })->sum('jumlah');

        // Ambil semua realisasi pendapatan
        $realisasiPendapatan = DataAnggaran::whereHas('kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'pendapatan');
        })->with('transaksi')->get()->flatMap->transaksi->sum('debet');

        // Ambil semua anggaran belanja
        $rencanaBelanja = DataAnggaran::whereHas('kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'Belanja');
        })->sum('jumlah');

        // Ambil semua realisasi belanja
        $realisasiBelanja = DataAnggaran::whereHas('kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'belanja');
        })->with('transaksi')->get()->flatMap->transaksi->sum('debet');

        // Hitung persentase realisasi pendapatan
        $persenPendapatan = $rencanaPendapatan > 0 ? ($realisasiPendapatan / $rencanaPendapatan) * 100 : 0;
        $persenBelanja = $rencanaBelanja > 0 ? ($realisasiBelanja / $rencanaBelanja) * 100 : 0;

        return view('admin.index', compact( 'rencanaPendapatan',
            'realisasiPendapatan',
            'rencanaBelanja',
            'realisasiBelanja',
            'persenPendapatan',
            'persenBelanja')); // sesuaikan dengan view yang kamu buat
    }
}
