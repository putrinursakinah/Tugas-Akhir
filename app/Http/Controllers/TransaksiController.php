<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\ModeKas;
use App\Models\KategoriKas;
use App\Models\JenisTransaksi;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('backend.transaksi.view_transaksi', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $modeKasList = ModeKas::all();
        $kategoriKasList = KategoriKas::all();
        $jenisTransaksiList = JenisTransaksi::all();

        return view('backend.transaksi.add_transaksi', compact('modeKasList', 'kategoriKasList', 'jenisTransaksiList'));
    }

    public function getKategoriByMode($id_mode)
    {
        $kategori = KategoriKas::where('mode_kas_id_mode', $id_mode)->get();
        return response()->json($kategori);
    }

    public function getJenisTransaksi()
    {
        $jenis = JenisTransaksi::all();
        return response()->json($jenis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'jumlah' => 'required|numeric|min:1',
        //     'uraian' => 'required|string',
        //     'penerima_uang' => 'required|string',
        //     'jabatan_penerima_uang' => 'required|string',
        $modeKas = KategoriKas::find($request->mode_kas_id);

        $debet = 0;
        $kredit = 0;
        if ($modeKas->kategori->id_kategori == 1) {
            $debet = $request->jumlah;
        } else if ($modeKas->kategori->id_kategori == 2) {
            $kredit = $request->jumlah;
        }
        Transaksi::create([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'jenis_transaksi_id_transaksi' => $request->jenis_transaksi_id,
            'data_anggaran_id' => $request->dataanggaran,
            'debet' => $debet,
            'kredit' => $kredit,

        ]);

        return redirect()->route('transaksi.view')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function pagu()
    {
        $kategori = Kategori::all();

        return view('backend.transaksi.pagu_transaksi', compact('kategori'));
    }

    public function getDataAnggaranByKategori($kategoriKasId)
    {
        $dataAnggaran = DB::table('data_anggaran')
            ->join('komponen', 'data_anggaran.komponen_id_komponen', '=', 'komponen.id_komponen')
            ->join('kode_kegiatan', 'komponen.kode_kegiatan_id_kegiatan', '=', 'kode_kegiatan.id_kegiatan')
            ->join('kategori', 'kode_kegiatan.kategori_id_kategori', '=', 'kategori.id_kategori')
            ->where('kategori.id_kategori', $kategoriKasId)
            ->select('data_anggaran.id_anggaran', 'data_anggaran.uraian')
            ->get();

        return response()->json($dataAnggaran);
    }

    public function cetak($id)
    {
        $transaksi = Transaksi::with(['jenisTransaksi', 'detailAkun', 'dataAnggaran'])->findOrFail($id);

        return view('backend.transaksi.cetak_transaksi', compact('transaksi'));
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

    public function exportExcel()
    {
        return Excel::download(new TransaksiExport, 'data_transaksi.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            Transaksi::whereIn('id_transaksi', $ids)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }
}
