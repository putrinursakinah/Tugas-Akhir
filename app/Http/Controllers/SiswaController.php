<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Exports\SiswaTemplateExport;
use App\Http\Requests\SiswaRequest;
use App\Http\Requests\SiswaUpdateRequest;
use App\Http\Controllers\SiswaRepository;

class SiswaController extends Controller
{
    /**
     * Tampilkan semua siswa.
     */
    public function index()
    {
        $siswaList = Siswa::all();
        $angkatanList = Siswa::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        return view('backend.siswa.view_siswa', compact('siswaList', 'angkatanList'));
    }

    /**
     * Tampilkan form tambah siswa.
     */
    public function create()
    {
        return view('backend.siswa.add_siswa');
    }

    /**
     * Simpan siswa baru ke database.
     */
    public function store(SiswaRequest $request)
    {
        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'angkatan' => $request->angkatan,
        ]);

        return redirect()->route('siswa.view')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('backend.siswa.edit_siswa', compact('siswa'));
    }

    public function update(SiswaUpdateRequest $request, string $id)
    {
        SiswaRepository::update($request->validated(), $id);
        return redirect()->route('siswa.view')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroySelected(Request $request)
    {
        $ids = $request->selected;

        if (!$ids || count($ids) === 0) {
            return redirect()->route('siswa.view')->with('error', 'Tidak ada siswa yang dipilih.');
        }

        Siswa::whereIn('id_siswa', $ids)->delete();

        return redirect()->route('siswa.view')->with('success', 'Data siswa berhasil dihapus.');
    }
}
