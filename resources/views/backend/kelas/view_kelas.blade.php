@extends('admin.admin_master')
@section('title','Histori')
@section('admin')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kelas</h1>
        <a href="{{ route('kelas.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
        </a>
    </div>

    <!-- Tabel Data Kelas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tingkat</th>
                            <th>Jurusan</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tingkat }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td>{{ $item->tahun_ajaran }}</td>
                            <td>
                                <a href="{{ route('kelas.peserta', $item->id_kelas) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-users"></i> Lihat Peserta
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @if($kelas->isEmpty())
                            <tr><td colspan="6" class="text-center">Belum ada data kelas.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
