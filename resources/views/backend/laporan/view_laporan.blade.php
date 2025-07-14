@extends('admin.admin_master')
@section('title','Laporan Realisasi Transaksi')
@section('admin')

<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-file-alt"></i> Laporan Realisasi
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.laporan.filter') }}" method="GET">
                            <div class="mb-4 text-center">
                                <button type="button" class="btn btn-secondary" disabled style="cursor:default;">PERIODE</button>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label text-md-right font-weight-bold">Periode Bulan</label>
                                <div class="col-md-8">
                                    <select name="periode_bulan" class="form-control" required>
                                        <option value="">Pilih Bulan</option>
                                        <option value="Januari 2025">Januari 2025</option>
                                        <option value="Februari 2025">Februari 2025</option>
                                        <option value="Maret 2025">Maret 2025</option>
                                        <option value="April 2025">April 2025</option>
                                        <option value="Mei 2025">Mei 2025</option>
                                        <option value="Juni 2025">Juni 2025</option>
                                        <option value="Juli 2025" selected>Juli 2025</option>
                                        <option value="Agustus 2025">Agustus 2025</option>
                                        <option value="September 2025">September 2025</option>
                                        <option value="Oktober 2025">Oktober 2025</option>
                                        <option value="November 2025">November 2025</option>
                                        <option value="Desember 2025">Desember 2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-md-4 col-form-label text-md-right font-weight-bold">Tanggal Laporan</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_laporan" class="form-control" value="2025-06-15" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="fas fa-filter"></i> FILTER
                                    </button>
                                    <button type="button" class="btn btn-success mr-2">
                                        <i class="fas fa-print"></i> CETAK
                                    </button>
                                    <button type="button" class="btn btn-info">
                                        <i class="fas fa-file-excel"></i> EXCEL
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Realisasi --}}
        <div class="row justify-content-center mt-4">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-table"></i> Realisasi Anggaran Pendapatan dan Belanja
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Kode/Akun</th>
                                        <th>Uraian</th>
                                        <th>Pagu Anggaran</th>
                                        <th>Realisasi s.d Bulan Lalu</th>
                                        <th>Realisasi s.d Bulan Ini</th>
                                        <th>Pengembalian</th>
                                        <th>Sisa Anggaran</th>
                                        <th>% Realisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rkas as $data) {{-- Mengambil data dari Rkas --}}
                                    <tr>
                                        <td>{{ $data->kode_akun }}</td>
                                        <td>{{ $data->uraian }}</td>
                                        <td>{{ number_format($data->pagu_anggaran, 0, ',', '.') }}</td>
                                        <td>{{ number_format($data->realisasi_s_d_bulan_lalu, 0, ',', '.') }}</td>
                                        <td>{{ number_format($data->realisasi_s_d_bulan_ini, 0, ',', '.') }}</td>
                                        <td>{{ number_format($data->pengembalian, 0, ',', '.') }}</td>
                                        <td>{{ number_format($data->sisa_anggaran, 0, ',', '.') }}</td>
                                        <td>{{ number_format($data->persentase_realisasi, 2) }}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection