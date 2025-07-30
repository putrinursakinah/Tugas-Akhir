@extends('admin.admin_master')
@section('title','Tambah Data Kelas')
@section('admin')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Kelas</h1>
        <a href="{{ route('kelas.view') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Tambah Data -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Kelas</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" maxlength="10" required>
                </div>

                <div class="form-group">
                    <label for="tingkat">Tingkat</label>
                    <input type="text" name="tingkat" id="tingkat" class="form-control" value="{{ old('tingkat') }}" required>
                </div>

                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                </div>

                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    @php
                        $tahunSekarang = now()->year;
                    @endphp
                    <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" required>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        @for ($tahun = $tahunSekarang; $tahun >= 2015; $tahun--)
                            @php
                                $ta = $tahun . '/' . ($tahun + 1);
                            @endphp
                            <option value="{{ $ta }}" {{ old('tahun_ajaran') == $ta ? 'selected' : '' }}>
                                {{ $ta }}
                            </option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
