<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DataAnggaran;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
   {
    $periodeBulan = $request->input('periode_bulan') ?? Carbon::now()->translatedFormat('F Y');
        $tanggalLaporan = $request->input('tanggal_laporan') ?? Carbon::now()->format('Y-m-d');

        // Parse bulan dan tahun dari inputan
        $bulan = Carbon::parse('01 ' . $periodeBulan)->month;
        $tahun = Carbon::parse('01 ' . $periodeBulan)->year;

        // Ambil semua data anggaran (hanya akun level terbawah jika ada struktur bertingkat)
        $rkas = DataAnggaran::with('transaksi')->get();

        // Map dan hitung realisasi
        $rkas = $rkas->map(function ($item) use ($bulan, $tahun) {
            $pagu = $item->jumlah ?? 0;

            $transaksiBulanIni = $item->transaksi
                ->where('tanggal', '>=', Carbon::create($tahun, $bulan, 1)->startOfMonth())
                ->where('tanggal', '<=', Carbon::create($tahun, $bulan, 1)->endOfMonth());

            $transaksiSebelumnya = $item->transaksi
                ->where('tanggal', '<', Carbon::create($tahun, $bulan, 1)->startOfMonth());

            $realisasiLalu = $transaksiSebelumnya->sum('kredit');
            $realisasiIni = $transaksiBulanIni->sum('kredit');
            $totalRealisasi = $realisasiLalu + $realisasiIni;

            $sisa = $pagu - $totalRealisasi;
            $persen = $pagu > 0 ? ($totalRealisasi / $pagu) * 100 : 0;

            return (object) [
                'kode_akun' => $item->kodeAkun->kode ?? '-',
                'uraian' => $item->uraian,
                'pagu_anggaran' => $pagu,
                'realisasi_s_d_bulan_lalu' => $realisasiLalu,
                'realisasi_s_d_bulan_ini' => $totalRealisasi,
                'pengembalian' => 0, // jika belum ada fitur pengembalian
                'sisa_anggaran' => $sisa,
                'persentase_realisasi' => $persen
            ];
        });

        return view('backend.laporan.view_laporan', compact('rkas', 'periodeBulan', 'tanggalLaporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
