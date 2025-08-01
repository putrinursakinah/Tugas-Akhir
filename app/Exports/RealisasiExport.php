<?php

namespace App\Exports;

use App\Models\Anggaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Controllers\LaporanController;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RealisasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

      protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $data = app(LaporanController::class)->getLaporanData($this->bulan);
        return view('admin.laporan.realisasi_excel', $data);
    }
}
