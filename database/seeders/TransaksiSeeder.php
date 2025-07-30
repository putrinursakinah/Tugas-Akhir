<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // MODE KAS
        $modeKas = [
            ['keterangan' => 'Transaksi Tunai'],
            ['keterangan' => 'Transaksi Bank'],
            ['keterangan' => 'Pergeseran Uang PU'],
        ];

        foreach ($modeKas as &$m) {
            $m['created_at'] = now();
            $m['updated_at'] = now();
        }
        DB::table('mode_kas')->insert($modeKas);

        $modeTunaiId = DB::table('mode_kas')->where('keterangan', 'Transaksi Tunai')->value('id_mode');

        // Ambil ID kategori yang sudah ada
        $kategoriPendapatanId = DB::table('kategori')->where('nama_kategori', 'Pendapatan')->value('id_kategori');
        $kategoriBelanjaId = DB::table('kategori')->where('nama_kategori', 'Belanja')->value('id_kategori');

        // KATEGORI KAS (hanya untuk Transaksi Tunai)
        $kategoriKas = [
            [
                'keterangan' => 'Penerimaan Tunai',
                'mode_kas_id_mode' => $modeTunaiId,
                'kategori_id_kategori' => $kategoriPendapatanId,
            ],
            [
                'keterangan' => 'Pengeluaran Tunai',
                'mode_kas_id_mode' => $modeTunaiId,
                'kategori_id_kategori' => $kategoriBelanjaId,
            ],
            [
                'keterangan' => 'Non Anggaran',
                'mode_kas_id_mode' => $modeTunaiId,
                'kategori_id_kategori' => $kategoriBelanjaId, // atau sesuaikan jika punya kategori khusus
            ],
        ];

        foreach ($kategoriKas as &$k) {
            $k['created_at'] = now();
            $k['updated_at'] = now();
        }
        DB::table('kategori_kas')->insert($kategoriKas);

        $kategoriKasPenerimaanTunaiId = DB::table('kategori_kas')
            ->where('keterangan', 'Penerimaan Tunai')
            ->value('id_kategorikas');

        // JENIS TRANSAKSI
        $jenisTransaksi = [
            [
                'keterangan' => 'Penerimaan Ke Tunai',
                'kategori_kas_id_kategorikas' => $kategoriKasPenerimaanTunaiId,
            ],
            [
                'keterangan' => 'Pungutan Pajak Tunai',
                'kategori_kas_id_kategorikas' => $kategoriKasPenerimaanTunaiId,
            ],
            [
                'keterangan' => 'Pengembalian Belanja Tunai',
                'kategori_kas_id_kategorikas' => $kategoriKasPenerimaanTunaiId,
            ],
        ];

        foreach ($jenisTransaksi as &$j) {
            $j['created_at'] = now();
            $j['updated_at'] = now();
        }
        DB::table('jenis_transaksi')->insert($jenisTransaksi);
    }
}
