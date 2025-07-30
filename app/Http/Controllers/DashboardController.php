<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnggaran;
use App\Models\Realiasi;
use App\Models\Realisasi;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua anggaran pendapatan
        $rencanaPendapatan = DataAnggaran::whereHas('kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'Pendapatan');
        })->sum('jumlah');

        // Ambil semua realisasi pendapatan
        $realisasiPendapatan = Realiasi::whereHas('anggaran.kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'Pendapatan');
        })->sum('jumlah');

        // Ambil semua anggaran belanja
        $rencanaBelanja = DataAnggaran::whereHas('kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'Belanja');
        })->sum('jumlah');

        // Ambil semua realisasi belanja
        $realisasiBelanja = Realiasi::whereHas('anggaran.kegiatan.kategori', function ($q) {
            $q->where('nama_kategori', 'Belanja');
        })->sum('jumlah');

        // Hitung persentase realisasi pendapatan
        $persenPendapatan = $rencanaPendapatan > 0
            ? ($realisasiPendapatan / $rencanaPendapatan) * 100
            : 0;

        // Hitung persentase realisasi belanja
        $persenBelanja = $rencanaBelanja > 0
            ? ($realisasiBelanja / $rencanaBelanja) * 100
            : 0;

        return view('admin.index', compact(
            'rencanaPendapatan',
            'realisasiPendapatan',
            'rencanaBelanja',
            'realisasiBelanja',
            'persenPendapatan',
            'persenBelanja'
        ));
    }
}
