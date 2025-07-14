@extends('admin.admin_master')
@section('title','Siswa')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-list"></i> Data Siswa & Tanggungan
            </h6>
        </div>
        <div class="card-body">
    <div class="mb-3">
        <button class="btn btn-primary btn-sm"><i class="fas fa-user-plus"></i> TAMBAH</button>
        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> HAPUS</button>
        <button class="btn btn-warning btn-sm"><i class="fas fa-eraser"></i> KOSONGKAN DATA</button>
        <button class="btn btn-info btn-sm"><i class="fas fa-edit"></i> EDIT TANGGUNGAN MULTI</button>
    </div>
    

    <div class="row mb-3">
        <div class="col-md-2">
            <label for="viewCount" class="form-label">View</label>
            <select id="viewCount" class="form-select form-select-sm">
                <option value="10">100</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="search" class="form-label">Cari Siswa</label>
            <input type="text" id="search" class="form-control form-control-sm" placeholder="Nama atau NIS">
        </div>
        <div class="col text-end mt-4">
            <button class="btn btn-primary btn-sm"><i class="fas fa-users-cog"></i> KATEGORI SISWA</button>
            <button class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> EXCEL</button>
            <button class="btn btn-primary btn-sm"><i class="fas fa-upload"></i> UPLOAD</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead class="table-light">
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Edit</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Telpon</th>
                    <th>Pilih->Bayar</th>
                    <th>Buku Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                {{-- Kosong, karena belum ada data siswa --}}
            </tbody>
        </table>
        <p class="mt-2">Record : 0</p>
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
            </ul>
        </nav>
        </div>
    </div>
</div>
@endsection