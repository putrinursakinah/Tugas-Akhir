<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use App\Exports\SiswaTemplateExport;
use App\Http\Requests\SiswaRequest;

class SiswaRepository
{
    public static function update(array $data, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nis' => $data['nis'],
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'angkatan' => $data['angkatan'],
        ]);

        return $siswa;
    }
}
