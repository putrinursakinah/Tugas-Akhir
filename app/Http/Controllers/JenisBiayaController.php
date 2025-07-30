<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBiaya;
use App\Models\TagihanSiswa;
use App\Models\TagihanBulanan;
use App\Models\TagihanTahunan;
use App\Models\TagihanInsidental;
use Illuminate\Support\Facades\Auth;

class JenisBiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisBiaya = JenisBiaya::all();
        return view('backend.jenis.view_jenis', compact('jenisBiaya'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.jenis.add_jenis');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_biaya,nama',
            'nominal' => 'required|numeric|min:0',
            'periode_pembayaran' => 'required|in:bulanan,tahunan,sekali',
        ], [
            'nama.unique' => 'Nama jenis biaya sudah terdaftar.',
        ]);

        // Simpan ke jenis_biaya
        $jenisBiaya = JenisBiaya::create([
            'nama' => $request->nama,
            'nominal' => $request->nominal,
            'periode_pembayaran' => $request->periode_pembayaran,
        ]);

        return redirect()->route('jenis.view')->with('success', 'Jenis Biaya berhasil ditambahkan.');
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
        $jenis = JenisBiaya::findOrFail($id);
        return view('backend.jenis.edit_jenis', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:45|unique:jenis_biaya,nama,' . $id . ',id_jenisbiaya',
            'nominal' => 'required|integer|min:0',
            'periode_pembayaran' => 'required|in:bulanan,tahunan,sekali',
        ], [
            'nama.unique' => 'Nama jenis biaya sudah terdaftar.',
        ]);

        $jenis = JenisBiaya::findOrFail($id);
        $jenis->update([
            'nama' => $request->nama,
            'nominal' => $request->nominal,
            'periode_pembayaran' => $request->periode_pembayaran,
        ]);
        return redirect()->route('jenis.view')->with('success', 'Jenis biaya berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
