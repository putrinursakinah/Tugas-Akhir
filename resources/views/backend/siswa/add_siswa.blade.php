@extends('admin.admin_master')
@section('title', 'Tambah Siswa')
@section('admin')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-user-plus"></i> Tambah Siswa
            </h6>
        </div>

        <div class="card-body">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Siswa" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat" required>
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Masukkan No. Telepon" required>
                </div>
                <div class="form-group">
                    <label for="angkatan">Tahun Angkatan</label>
                    <input type="text" name="angkatan" id="angkatan" class="form-control" placeholder="Contoh: 2023" required>
                </div>
                <div class="form-group mt-4">
                    <a href="{{ route('siswa.view') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection