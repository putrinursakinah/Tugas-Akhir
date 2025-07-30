<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Validation\Rule;
use App\Models\Siswa;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = kelas::all();
        return view('backend.kelas.view_kelas', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kelas.add_kelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'max:10',
                Rule::unique('kelas')->where(function ($query) use ($request) {
                    return $query->where('tahun_ajaran', $request->tahun_ajaran)
                        ->where('jurusan', $request->jurusan);
                }),
            ],
            'tingkat' => 'required',
            'jurusan' => 'required',
            'tahun_ajaran' => 'required|string|max:9',
        ], [
            'nama.unique' => 'Kelas dengan nama, jurusan, dan tahun ajaran tersebut sudah ada',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.view')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function lihatPeserta($id)
    {
        $kelas = Kelas::findOrFail($id);

        // Ambil siswa yang terhubung dengan kelas ini melalui tabel pivot
        $siswa = $kelas->siswa; // relasi manyToMany melalui kelas_has_siswa
       
        return view('backend.kelas.peserta_kelas', compact('kelas', 'siswa'));
    }

    public function formTambahPeserta($id)
    {
        $kelas = Kelas::findOrFail($id);
        $angkatanList = Siswa::select('angkatan')->distinct()->pluck('angkatan');
        return view('backend.kelas.create_kelas', compact('kelas', 'angkatanList'));
    }

    public function simpanPeserta(Request $request, $id)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->siswa()->syncWithoutDetaching($request->siswa_ids);;

        return redirect()->route('kelas.peserta', $id)->with('success', 'Siswa berhasil ditambahkan ke kelas.');
    }

    public function getSiswaByAngkatan($angkatan)
    {
        $siswa = Siswa::where('angkatan', $angkatan)->get(['id_siswa', 'nama', 'nis', 'alamat']);
        return response()->json($siswa);
    }

    public function showTambahPeserta($kelasId)
    {
        $angkatanList = Siswa::select('angkatan')->distinct()->pluck('angkatan');
        return view('backend.kelas.peserta_kelas', compact('angkatanList', 'kelasId'));
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return back()->with('success', 'Data siswa berhasil diimpor.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat impor: ' . $e->getMessage());
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
