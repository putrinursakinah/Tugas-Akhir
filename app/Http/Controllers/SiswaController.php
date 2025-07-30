<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Exports\SiswaTemplateExport;

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
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'angkatan' => 'required|digits:4',
        ]);

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

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return back()->with('success', 'Data siswa berhasil diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new SiswaTemplateExport, 'template_siswa.xlsx');
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

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id . ',id_siswa',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'angkatan' => 'required|digits:4',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'angkatan' => $request->angkatan,
        ]);
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
