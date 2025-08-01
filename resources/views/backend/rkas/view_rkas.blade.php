@extends('admin.admin_master')
@section('title', 'Rkas')
@section('admin')

<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-file-alt"></i> ANGGARAN PENDAPATAN DAN BELANJA SEKOLAH TP. 2024/2025
        </div>
        <div class="card-body">

            <a href="{{ route('rkas.cetak',['type'=>'pdf']) }}" class="btn btn-sm btn-info"><i class="fas fa-print"></i> CETAK</a>
            <a target="_blank" href="{{ route('rkas.cetak',['type'=>'excel']) }}" class="btn btn-sm btn-primary"><i class="fas fa-file-excel"></i> EXCEL</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><strong>RINCIAN RKAS/M</strong></div>
        <div class="card-body">
            <input type="text" class="form-control mb-3" placeholder="Cari Data">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Kode/Akun</th>
                            <th>Uraian</th>
                            <th>Vol</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>PD/SD</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $kategori)
                        <tr>
                            <td class="text-danger font-weight-bold">{{ $kategori->id_kategori }}</td>
                            <td class="text-danger font-weight-bold">{{ $kategori->nama_kategori }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="align-middle">
                                @if(Auth::user()->role === 'bendahara' && !$isLocked)
                                <a href="{{ route('rkas.add', ['kategori_id' => $kategori->id_kategori]) }}" title="Tambah Data">
                                    <i class="fas fa-plus text-success"></i>
                                </a>
                                @endif
                            </td>
                        </tr>

                        @php $totalKategori = 0; @endphp

                        @foreach($kegiatan as $keg)
                        @if($keg->kategori_id_kategori == $kategori->id_kategori)
                        @php
                        $jumlah_kegiatan = 0;
                        foreach($dataanggaran as $anggaran) {
                        if($anggaran->kode_kegiatan_id_kegiatan == $keg->id_kegiatan) {
                        $jumlah_kegiatan += $anggaran->jumlah;
                        $totalKategori += $anggaran->jumlah;
                        }
                        }
                        @endphp
                        <tr>
                            <td>{{ $keg->kode }}</td>
                            <td>{{ $keg->kegiatan }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($jumlah_kegiatan, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($komponen as $kom)
                        @if($kom->kode_kegiatan_id_kegiatan == $keg->id_kegiatan)
                        @php
                        $jumlah_komponen = 0;
                        foreach($dataanggaran as $anggaran) {
                        if($anggaran->komponen_id_komponen == $kom->id_komponen) {
                        $jumlah_komponen += $anggaran->jumlah;
                        }
                        }
                        @endphp
                        <tr>
                            <td>{{ $kom->kode }}</td>
                            <td>{{ $kom->uraian }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($jumlah_komponen, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($kode_akun as $akun)
                        @if($akun->id_akun == $kom->kode_akun_id_akun)
                        @php
                        $jumlah_akun = 0;
                        foreach($dataanggaran as $anggaran) {
                        if($anggaran->komponen_id_komponen == $kom->id_komponen) {
                        $jumlah_akun += $anggaran->jumlah;
                        }
                        }
                        @endphp
                        <tr>
                            <td>{{ $akun->kode }}</td>
                            <td>{{ $akun->kegiatan }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($jumlah_akun, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endif
                        @endforeach

                        @foreach($dataanggaran as $anggaran)
                        @if($anggaran->komponen_id_komponen == $kom->id_komponen)
                        <tr>
                            <td></td>
                            <td>{{ $anggaran->uraian }}</td>
                            <td>{{ $anggaran->vol }}</td>
                            <td>{{ $anggaran->satuan }}</td>
                            <td>{{ number_format($anggaran->harga_satuan, 0, ',', '.') }}</td>
                            <td>{{ number_format($anggaran->jumlah, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                        {{-- Baris Total Kategori --}}
                        <tr class="bg-light font-weight-bold">
                            <td colspan="5" class="text-right">Total {{ $kategori->nama_kategori }}</td>
                            <td>{{ number_format($totalKategori, 0, ',', '.') }}</td>
                            <td colspan="2"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Tombol Simpan & Kunci --}}
                @if(Auth::user()->role === 'bendahara')
                @if($dataanggaran->count() > 0 && !$isLocked)
                <form action="{{ route('rkas.lock') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Simpan & Kunci RKAS</button>
                </form>
                @elseif($isLocked)
                <div class="alert alert-success mt-3">
                    Data RKAS telah dikunci dan tidak dapat diedit.
                </div>
                @endif
                @elseif($isLocked)
                <div class="alert alert-success mt-3">
                    Data RKAS telah dikunci dan tidak dapat diedit.
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection