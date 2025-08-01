<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\DataAnggaran;
use App\Models\Kategori;
use App\Models\KodeAkun;
use App\Models\KodeKegiatan;
use App\Models\Komponen;
use App\Models\Transaksi;
use App\Models\PaguSpp;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RealisasiExport;

class LaporanController extends Controller
{



    public function index(Request $request)
    {
        if (auth()->user()->role !== 'bendahara' && auth()->user()->role !== 'kepala sekolah') {
            abort(403, 'Unauthorized');
        }
        $bulan = $request->get('bulan', Carbon::now()->month);
        $kategori = Kategori::all();
        $kegiatan = KodeKegiatan::all();
        $komponen = Komponen::all();
        $kode_akun = KodeAkun::all();
        $dataanggaran = DataAnggaran::with([
            'transaksi' => function ($q) use ($bulan) {
                $q->whereMonth('tanggal', $bulan);
            },
            'paguSpp',
            'kegiatan'
        ])->get();
        $bulan = $request->get('bulan', Carbon::now()->month); // default: bulan ini

        $anggarans = DataAnggaran::with([
            'transaksi' => function ($q) use ($bulan) {
                $q->whereMonth('tanggal', $bulan);
            },
            'paguSpp',
            'kegiatan'
        ])->get();
        //dd($anggarans);
        return view('backend.laporan.view_laporan', compact('kategori', 'kegiatan', 'komponen', 'kode_akun', 'dataanggaran', 'anggarans', 'bulan'));
    }

    public function laporanRealisasiSPP()
    {
        $tahunAjaranId = 1; // nanti bisa dibuat dinamis
        $paguItems = PaguSPP::with(['anggaran', 'tahunAjaran'])->get();

        $laporan = [];

        foreach ($paguItems as $pagu) {
            $paguJumlah = $pagu->anggaran->jumlah ?? 0;
            $realisasiBulanan = [];

            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $start = Carbon::create(null, $bulan, 1)->startOfMonth();
                $end = Carbon::create(null, $bulan, 1)->endOfMonth();

                $realisasi = Transaksi::whereBetween('tanggal', [$start, $end])
                    ->whereHas('pembayaran.tagihanSiswa.KelasHasSiswa.Kelas', function ($q) use ($tahunAjaranId) {
                        $q->where('tahun_ajaran', $tahunAjaranId);
                    })
                    ->whereHas('spp')
                    ->sum('debet');

                $realisasiBulanan[$bulan] = $realisasi;
            }

            $totalRealisasi = array_sum($realisasiBulanan);
            $sisa = $paguJumlah - $totalRealisasi;
            $persen = $paguJumlah > 0 ? ($totalRealisasi / $paguJumlah) * 100 : 0;

            $laporan[] = [
                'kode_kegiatan' => $pagu->tahunAjaranKodeKegiatan->kode_kegiatan ?? '-',
                'uraian' => $pagu->anggaran->uraian ?? '-',
                'pagu_anggaran' => $paguJumlah,
                'realisasi_bulanan' => $realisasiBulanan,
                'total_realisasi' => $totalRealisasi,
                'sisa_anggaran' => $sisa,
                'persentase' => round($persen, 2),
            ];
        }

        //return view('backend.laporan.View_laporan', compact('laporan'));
    }

    public function rkas()
    {
        $kategori = Kategori::all();
        $kegiatan = KodeKegiatan::all();
        $komponen = Komponen::all();
        $kode_akun = KodeAkun::all();
        $dataanggaran = DataAnggaran::all();

        return view('backend.laporan.view_laporan', compact(
            'kategori',
            'kegiatan',
            'komponen',
            'kode_akun',
            'dataanggaran'
        ));
    }
    public function cetakPdf(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;

        // Ambil data yang sama seperti tampilan biasa
        $data = $this->getLaporanData($bulan); // buat method ini agar bisa digunakan bersama

        $pdf = Pdf::loadView('backend.laporan.realisasi_pdf', $data);
        return $pdf->download("laporan-realisasi-spp-{$bulan}.pdf");
    }
    public function exportExcel(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        return Excel::download(new RealisasiExport($bulan), "laporan-realisasi-spp-{$bulan}.xlsx");
    }

    private function getLaporanData($bulan)
    {
        $kategori = Kategori::all();
        $kegiatan = KodeKegiatan::all();
        $komponen = Komponen::all();
        $kode_akun = KodeAkun::all();

        // Ambil semua data anggaran dengan transaksi di bulan yang dipilih
        $dataanggaran = \App\Models\DataAnggaran::with(['transaksi' => function ($q) use ($bulan) {
            $q->whereMonth('tanggal', $bulan);
        }])->get();

        return compact('bulan', 'kategori', 'kegiatan', 'komponen', 'kode_akun', 'dataanggaran');
    }
}
