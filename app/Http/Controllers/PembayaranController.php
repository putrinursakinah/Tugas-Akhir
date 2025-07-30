<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\TagihanSiswa;
use App\Models\Transaksi;
use Carbon\Carbon;
use App\Models\Pembayaran;
use App\Models\DataAnggaran;
use App\Models\JenisTransaksi;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $siswa = null;
        $tagihanSiswa = collect();
        $pembayaranSiswa = collect();

        if ($request->filled('nis')) {
            [$siswa, $tagihanSiswa, $pembayaranSiswa] = PembayaranRepository::getDataByNis($request->nis);
        }
        return view('backend.pembayaran.view_pembayaran', compact('siswa', 'tagihanSiswa', 'pembayaranSiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($siswa_id)
    {
        $data = PembayaranRepository::getTagihanBySiswa($siswa_id);

        return view('backend.pembayaran.add_pembayaran', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = PembayaranRepository::prosesSimpanPembayaran($request);

        if ($result['success']) {
            return redirect($result['route'])->with('success', 'Pembayaran berhasil disimpan!');
        } else {
            return back()->withErrors($result['error']);
        }
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
