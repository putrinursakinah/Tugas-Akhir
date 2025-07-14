@extends('admin.admin_master')
@section('title','Rkas')
@section('admin')


<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-file-alt"></i> ANGGARAN PENDAPATAN DAN BELANJA SEKOLAH/MADRASAH [APBS/M] TP. 2024/2025
        </div>
        <div class="card-body">
            <p class="text-danger fw-bold">HISTORY RKAS/M : REVISI 3</p>
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> BUAT/HAPUS REVISI</a>
            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-print"></i> CETAK</a>
            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-file-excel"></i> EXCEL</a>
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
                            <th>Surplus/Defisit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- KODE A - PENDAPATAN --}}
                        <tr class="table-primary fw-bold">
                            <td>A</td>
                            <td>PENDAPATAN</td>
                            <td colspan="6"></td>
                            <td>
                                <a href="{{ route('rkas.add') }}" class="btn btn-sm btn-success" title="Tambah Pendapatan">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                        {{-- Anak-anak pendapatan --}}
                        @foreach($pendapatan as $row)
                        <tr>
                            <td class="text-primary font-weight-bold">{{ $row->kode }}</td>
                            <td>
                                <a href="#" class="text-primary font-weight-bold">{{ $row->uraian }}</a>
                            </td>
                            <td>{{ $row->vol }}</td>
                            <td>{{ $row->satuan }}</td>
                            <td>{{ $row->harga_satuan }}</td>
                            <td class="text-primary font-weight-bold">{{ number_format($row->jumlah, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('komponen.rkas', $row->id) }}" class="btn btn-info btn-sm px-2 py-1" style="font-size: 0.8rem;" title="Tambah Komponen"><i class="fas fa-plus"></i></a>
                                <a href="{{ route('rkas.edit', $row->id) }}" class="btn btn-success btn-sm px-2 py-1" style="font-size:0.8rem;" title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('rkas.delete', $row->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-2 py-1" style="font-size:0.8rem;" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                         @endforeach

                        {{-- Total Pendapatan --}}

                        {{-- KODE B - BELANJA --}}
                        <tr class="table-danger fw-bold">
                            <td>B</td>
                            <td>BELANJA</td>
                            <td colspan="6"></td>
                            <td>
                                <a href="{{ route('rkas.add') }}" class="btn btn-sm btn-success" title="Tambah Belanja">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                        {{-- Anak-anak belanja --}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection