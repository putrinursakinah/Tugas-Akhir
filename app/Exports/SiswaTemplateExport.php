<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaTemplateExport implements FromArray, WithHeadings 
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return [
            // Contoh baris kosong
            [
                '',
                '',
                '',
                '',
                ''
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'nis',
            'nama',
            'alamat',
            'telepon',
            'angkatan'
        ];
    }
}
