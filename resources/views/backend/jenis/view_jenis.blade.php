@extends('admin.admin_master')
@section('title', 'Daftar Jenis Biaya')
@section('admin')

<div class="container-fluid">

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-table"></i> Daftar Jenis Biaya
            </h6>
        </div>
        <div class="card-body">
            <a href="{{ route('jenis.add') }}" class="btn btn-sm btn-light shadow-sm">
                <i class="fas fa-plus fa-sm text-gray-800"></i> Tambah Data
            </a>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Periode Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jenisBiaya as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>
                                    {{-- Ubah tampilan periode agar lebih rapi --}}
                                    @switch($item->periode_pembayaran)
                                    @case('bulanan')
                                    <span class="badge badge-info">Bulanan</span>
                                    @break
                                    @case('tahunan')
                                    <span class="badge badge-warning">Tahunan</span>
                                    @break
                                    @case('sekali')
                                    <span class="badge badge-success">Sekali</span>
                                    @break
                                    @default
                                    <span class="badge badge-secondary">Tidak Diketahui</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('jenis.edit', $item->id_jenisbiaya) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection