@extends('admin.admin_master')
@section('title','Cetak Kuitansi')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-print"></i> Cetak Kuitansi
            </h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> CETAK</button>
                <a href="{{ route('transaksi.view') }}" class="btn btn-secondary btn-sm">KEMBALI</a>
            </div>

            <div class="border p-4" id="kuitansi">
                <div class="text-center">
                    <h4><strong>KUITANSI PEMBAYARAN</strong></h4>
                </div>

                <table class="table table-borderless mt-4">
                    <tr>
                        <td width="30%">Telah terima dari</td>
                        <td>: Bendahara SMA Mulia Jakarta</td>
                    </tr>
                    <tr>
                        <td>Uang Sebesar</td>
                        <td>: <em>--- {{ terbilang($transaksi->debet ?: $transaksi->kredit) }} Rupiah ---</em></td>
                    </tr>
                    <tr>
                        <td>Guna Membayar</td>
                        <td>: {{ $transaksi->uraian }}</td>
                    </tr>
                    <tr>
                        <td>Terbilang</td>
                        <td>: <strong>Rp. {{ number_format($transaksi->debet ?: $transaksi->kredit, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td>Akun/Mata Anggaran</td>
                        <td>: {{ $transaksi->dataAnggaran->kode_akun ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Uraian Akun</td>
                        <td>: {{ $transaksi->dataAnggaran->uraian ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>: {{ now()->year }}/{{ now()->addYear()->year }}</td>
                    </tr>
                </table>

                <div class="row mt-4">
                    <div class="col text-center">
                        Mengetahui,<br>Kepala Sekolah<br><br><br>
                        Ahmad<br>NIP. 1321654987
                    </div>
                    <div class="col text-center">
                        Lunas dibayar tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y') }}<br>Bendahara<br><br><br>
                        Khumaira<br>NIP. 123456789
                    </div>
                    <div class="col text-center">
                        Jakarta, {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y') }}<br>Penerima<br><br><br>
                        {{ $transaksi->penerima_uang ?? 'Ahmad' }}<br>{{ $transaksi->jabatan_penerima_uang ?? 'Direktur' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
