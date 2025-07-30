@extends('admin.admin_master')
@section('title','Laporan Realisasi')
@section('admin')

<div class="container-fluid">
    <h4 class="mb-4 font-weight-bold text-gray-800">Laporan Realisasi Anggaran</h4>

    {{-- Form Filter --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('laporan.realisasi') }}" method="GET" class="row align-items-end">
                <div class="form-group col-md-4">
                    <label for="periode_bulan">Periode Bulan</label>
                    <select name="periode_bulan" class="form-control" required>
                        <option value="">Pilih Bulan</option>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                        <option value="{{ $bulan }} 2025"
                            {{ request('periode_bulan') == "$bulan 2025" ? 'selected' : '' }}>
                            {{ $bulan }} 2025
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="tanggal_laporan">Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" class="form-control"
                        value="{{ request('tanggal_laporan') ?? now()->toDateString() }}" required>
                </div>

                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Laporan --}}
    @if(isset($laporan) && count($laporan))
    <div class="card shadow mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Kode Akun</th>
                        <th>Uraian</th>
                        <th>Pagu Anggaran</th>
                        <th>Realisasi Bulan Lalu</th>
                        <th>Realisasi s.d Bulan Ini</th>
                        <th>Sisa Anggaran</th>
                        <th>% Realisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporan as $item)
                    <tr>
                        <td>{{ $item['kode_akun'] }}</td>
                        <td>{{ $item['uraian'] }}</td>
                        <td>{{ number_format($item['pagu_anggaran'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['realisasi_bulan_lalu'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['realisasi_sampai_bulan_ini'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['sisa_anggaran'], 0, ',', '.') }}</td>
                        <td>{{ number_format($item['persentase_realisasi'], 2) }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @elseif(request()->has('periode_bulan'))
    <div class="alert alert-warning">Data tidak ditemukan untuk periode yang dipilih.</div>
    @endif
</div>

@endsection