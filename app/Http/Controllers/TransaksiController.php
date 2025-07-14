<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\ModeKas;

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

    public function add()
    {
        $kategori = session('kategori');
        $jenis = session('jenis');
        return view('backend.transaksi.add_transaksi', compact('kategori', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modeKas = ModeKas::all(); // Mengambil semua data dari tabel mode_kas
        
        return view('add_transaksi', ['modeKas' => $modeKas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'uraian' => 'required|string',
            'penerima_uang' => 'required|string',
            'jabatan_penerima_uang' => 'required|string',

        ]);

        Transaksi::create([
            'no_bukti' => $request->no_bukti,
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'debet' => $request->jumlah,
            'kredit' => 0,
            'jenis_transaksi' => $request->jenis_transaksi,
            'akun' => $request->akun,
            'kuitansi' => $request->kuitansi,
        ]);
        return redirect()->route('transaksi.view')->with('success', 'Transaksi berhasil ditambahkan!');
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
