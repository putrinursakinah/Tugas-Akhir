<?php

namespace App\Http\Controllers;

use App\Models\DataAnggaran;

class DataAnggaranHierarchyService
{
    public static function getHierarchy($detail_id)
    {
        $detail = DataAnggaran::findOrFail($detail_id);

        $akun = $detail->parent; // Mengambil akun yang menjadi parent dari detail ini
        $komponen = $akun->parent; // Mengambil komponen dari akun
        $kegiatan = $komponen->parent; // Mengambil kegiatan dari komponen
        $kategori = $kegiatan->parent; // Mengambil kategori dari kegiatan

        return compact('detail', 'kategori', 'kegiatan', 'komponen', 'akun');
    }

    public static function UpdateJumlahParent(DataAnggaran $detail): void
    {
        // Update total di parent (akun)
        $parent = $detail->parent;

        if ($parent) {
            // Hitung total baru untuk akun
            $parent->jumlah = $parent->children->sum('jumlah');
            $parent->save();

            // Update total di komponen
            $komponen = $parent->parent;
            if ($komponen) {
                $komponen->jumlah = $komponen->children->sum('jumlah');
                $komponen->save();

                // Update total di kegiatan
                $kegiatan = $komponen->parent;
                if ($kegiatan) {
                    $kegiatan->jumlah = $kegiatan->children->sum('jumlah');
                    $kegiatan->save();
                }
            }
        }
    }
}
