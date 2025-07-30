<?php

namespace App\Http\Controllers;

use App\Models\KodeAkun;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KodeAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = KodeAkun::all();
        return view('backend.akun.view_akun', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('backend.akun.add_akun', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|digits:6|unique:kode_akun,kode',
            'kegiatan' => 'required|string|max:255',
        ]);

        $kodeAwal = intval(substr($request->kode, 0, 6));

        // Tentukan kategori (jika mau disimpan atau diverifikasi)
        if ($kodeAwal >= 100000 && $kodeAwal <= 199999) {
            $kategori = 'Pendapatan';
        } elseif ($kodeAwal >= 200000 && $kodeAwal <= 299999) {
            $kategori = 'Belanja';
        } else {
            return back()->with('error', 'Kode tidak valid (kategori tidak dapat dikenali).');
        }

        KodeAkun::create([
            'kode' => $request->kode,
            'kegiatan' => $request->kegiatan,
            'kategori' => $kategori,
        ]);

        return redirect()->route('akun.view')->with('success', 'Kegiatan berhasil ditambahkan!');
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
        $akun = KodeAkun::where('id_akun', $id)->firstOrFail();
        return view('backend.akun.edit_akun', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|numeric|min:100000|unique:kode_akun,kode,' . $id . ',id_akun',
            'kegiatan' => 'required|string|max:255',
        ]);
        $akun = KodeAkun::findOrFail($id);
        $akun->update([
            'kode' => $request->kode,
            'kegiatan' => $request->kegiatan,
        ]);
        return redirect()->route('akun.view')->with('success', 'Akun berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akun = KodeAkun::findOrFail($id);
        $akun->delete();

        return redirect()->route('akun.view')->with('success', 'Akun deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && count($ids)) {
            KodeAkun::whereIn('id_akun', $ids)->delete();
            return redirect()->route('akun.view')->with('success', 'Data akun berhasil dihapus.');
        }
        return redirect()->route('akun.view')->with('error', 'Tidak ada akun yang dipilih untuk dihapus.');
    }
}
