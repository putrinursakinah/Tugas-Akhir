<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histori = History::orderBy('revisi')->get();
        $nextRevisi = ($histori->max('revisi') ?? 0) + 1;
        return view('backend.histori.view_histori', compact('histori', 'nextRevisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $maxRevisi = History::max('revisi') ?? 0;
        $history = History::create([
            'revisi' => $maxRevisi + 1,
            'tanggal' => now()->toDateString(),
        ]);
        return redirect()->route('histori.view')->with('success', 'History revisi baru berhasil dibuat!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi jika diperlukan
        $nextRevisi = History::max('revisi') + 1; // Menghitung revisi selanjutnya

        // Simpan data ke tabel histori
        History::create([
            'revisi' => $nextRevisi,
            'tanggal' => now()->format('Y-m-d'), // Tanggal saat ini
            'created_at' => now(), // Waktu saat ini
        ]);

        return redirect()->route('histori.view')->with('success', 'History berhasil dibuat!');
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
        $history = History::findOrFail($id);
        $history->delete();

        return redirect()->route('histori.view')->with('success', 'History berhasil dihapus!');
    }
}
