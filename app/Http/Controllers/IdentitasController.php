<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identitas;

class IdentitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $identitas = Identitas::first(); // Ambil data pertama (atau null jika belum ada)
            return view('backend.identitas.view_identitas', compact('identitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.identitas.add_identitas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_bendahara' => 'required|string|max:100',
        'nip_bendahara' => 'nullable|string|max:50',
        'nama_pimpinan' => 'required|string|max:100',
        'nip_pimpinan' => 'nullable|string|max:50',
        'jabatan_pimpinan' => 'nullable|string|max:100',
        'nama_atasan_pimpinan' => 'nullable|string|max:100',
        'jabatan_atasan_pimpinan' => 'nullable|string|max:100',
        'nama_pejabat_komitmen' => 'nullable|string|max:100',
        'nip_pejabat_komitmen' => 'nullable|string|max:50',
        'jabatan_pejabat_komitmen' => 'nullable|string|max:100',
    ]);

    $identitas = Identitas::first();
    if ($identitas) {
        $identitas->update($request->all());
    } else {
        Identitas::create($request->all());
    }

    return redirect()->route('identitas.view')->with('success', 'Data identitas berhasil disimpan.');
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
