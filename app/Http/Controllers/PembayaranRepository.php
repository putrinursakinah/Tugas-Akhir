<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\TagihanSiswa;
use App\Models\Transaksi;
use Carbon\Carbon;
use App\Models\Pembayaran;
use App\Models\DataAnggaran;
use App\Models\JenisTransaksi;
use Illuminate\Support\Facades\DB;

class PembayaranRepository
{
    public static function getDataByNis($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();
        if (!$siswa) {
            return [null, collect(), collect()];
        }

        $kelasHasSiswaIds = $siswa->kelasHasSiswa()->pluck('id_kelashassiswa');
        $tagihanSiswa = TagihanSiswa::whereIn('kelas_has_siswa_id_kelashassiswa', $kelasHasSiswaIds)
            ->with('jenisBiaya')
            ->get();
        $pembayaranSiswa = Pembayaran::whereHas('tagihanSiswa', function ($query) use ($kelasHasSiswaIds) {
            $query->whereIn('kelas_has_siswa_id_kelashassiswa', $kelasHasSiswaIds);
        })->with(['tagihanSiswa.jenisBiaya', 'transaksi'])->get();

        // Tambahkan properti kelas ke siswa
        $kelasAktif = $siswa->kelasHasSiswa()->with('kelas')->latest()->first();
        $siswa->kelas = $kelasAktif?->kelas?->nama_kelas ?? '-';

        return [$siswa, $tagihanSiswa, $pembayaranSiswa];
    }

    public static function getTagihanBySiswa($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $kelasHasSiswaIds = $siswa->kelasHasSiswa()->pluck('id_kelashassiswa');

        $tagihanSiswa = TagihanSiswa::whereIn('kelas_has_siswa_id_kelashassiswa', $kelasHasSiswaIds)
            ->with('jenisBiaya')
            ->get();

        return compact('siswa', 'tagihanSiswa');
    }

    public static function prosesSimpanPembayaran($request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'siswa_id'   => 'required|exists:siswa,id_siswa',
                'tagihan_id' => 'required|exists:tagihan_siswa,id_tagihan',
                'nominal'    => 'required|numeric|min:1',
            ]);

            $tagihan = TagihanSiswa::with('jenisBiaya')->findOrFail($request->tagihan_id);

            $dataAnggaran = DataAnggaran::first();
            if (!$dataAnggaran) {
                return [
                    'success' => false,
                    'error' => 'Data Anggaran belum tersedia.'
                ];
            }

            $jenisTransaksi = JenisTransaksi::first();
            if (!$jenisTransaksi) {
                return [
                    'success' => false,
                    'error' => 'Jenis Transaksi belum tersedia.'
                ];
            }

            $transaksi = Transaksi::create([
                'tanggal'                    => Carbon::now(),
                'uraian'                     => 'Pembayaran tagihan: ' . $tagihan->jenisBiaya->nama,
                'debet'                      => $request->nominal,
                'kredit'                     => 0,
                'jenis_transaksi_id_transaksi' => $jenisTransaksi->id_transaksi,
                'data_anggaran_id'          => $dataAnggaran->id_anggaran,
            ]);

            Pembayaran::create([
                'tgl_pembayaran'             => Carbon::now(),
                'tagihan_siswa_id_tagihan'  => $tagihan->id_tagihan,
                'transaksi_id_transaksi'    => $transaksi->id_transaksi,
            ]);


            $totalBayar = Pembayaran::where('tagihan_siswa_id_tagihan', $tagihan->id_tagihan)
                ->join('transaksi', 'pembayaran.transaksi_id_transaksi', '=', 'transaksi.id_transaksi')
                ->sum('transaksi.debet');

            // Jika total pembayaran == nominal tagihan → update status ke Lunas
            $nominalTagihan = $tagihan->jenisBiaya->nominal;
            if ($totalBayar >= $nominalTagihan) {
                $tagihan->status = 'Lunas';
            } else {
                $tagihan->status = 'Belum Lunas';
            }
            $tagihan->save();


            DB::commit();
            return [
                'success' => true,
                'route' => route('pembayaran.view', ['nis' => $request->nis])
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
    }
}
