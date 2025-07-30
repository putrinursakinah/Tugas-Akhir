<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Siswa::all();
    }

    /**
     * Atur urutan dan isi tiap baris
     */
    public function map($siswa): array
    {
        return [
            $siswa->nis,
            $siswa->nama,
            $siswa->alamat,
            $siswa->telepon,
            $siswa->angkatan,
        ];
    }

    /**
     * Judul kolom di file Excel
     */
    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Alamat',
            'Telepon',
            'Angkatan',
        ];
    }
}
