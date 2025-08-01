<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDataAnggaranRequest;
use App\Models\DataAnggaran;

class UpdateDataAnggaranService
{
    public static function update(UpdateDataAnggaranRequest $request, string $id): DataAnggaran
    {
        // Temukan detail yang akan diperbarui
        $detail = DataAnggaran::findOrFail($id);

        // Update detail
        $detail->update([
            'uraian' => $request->uraian_detail,
            'vol' => $request->vol,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'jumlah' => $request->jumlah,
        ]);
        return $detail;
    }
}
