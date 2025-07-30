@extends('admin.admin_master')
@section('title','Peserta Kelas')
@section('admin')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Peserta Kelas {{ $kelas->nama }} - {{ $kelas->tahun_ajaran }}</h1>
        <a href="{{ route('kelas.view') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Tabel Peserta -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <!-- Tombol Tambah Peserta -->
            <div class="mb-3">
                <a href="{{ route('kelas.form_tambah_kelas', $kelas->id_kelas) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-user-plus"></i> Tambah Peserta
                </a>
            </div>

            @if ($siswa->isEmpty())
                <div class="alert alert-info">
                    Belum ada siswa terdaftar di kelas ini.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $index => $item)
                            @php
                           // dd($item)
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->nama }}</td>
                          
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
