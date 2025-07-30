<?php

namespace App\Exports;

use App\Models\DataAnggaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataAnggaranExport implements FromCollection
{

    public function __construct(){
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataAnggaran::all();
    }
        public function headings(): array
    {
        return [
            'Kode/Akun',
            'Uraian',
            'Vol',
            'Satuan',
            'Harga Satuan',
            'Jumlah',
            'PSBD',
            'Surplus/Defisit',
        ];
    }
}
