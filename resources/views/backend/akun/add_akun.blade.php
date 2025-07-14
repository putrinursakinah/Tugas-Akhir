@extends('admin.admin_master')
@section('title','Tambah Akun')
@section('admin')

<div class="d-flex justify-content-center mt-4">
    <div class="card shadow mb-4" style="width:100%; max-width:700px;">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus-square"></i> Tambah Akun
            </h6>
        </div>
        <div class="card-body" style="background: #f8f9fc;">
            <form action="{{ route('akun.store') }}" method="POST">
                @csrf
                <div class="form-row align-items-center mb-3">
                    <label class="col-md-3 col-form-label font-weight-bold text-md-right">Kode Akun</label>
                    <div class="col-md-9">
                        <input type="text" name="kode" class="form-control form-control-sm mb-1" placeholder="Kode Akun [6 Digit]" maxlength="6" required>
                        <small>
                            Kode Kegiatan untuk Kategori
                            <span class="text-success font-weight-bold">Pendapatan : 100000 - 199999</span><br>
                            Kode Kegiatan untuk Kategori
                            <span class="text-danger font-weight-bold">Belanja : 200000 - 299999</span>
                        </small>
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label class="col-md-3 col-form-label font-weight-bold text-md-right">Uraian Kegiatan</label>
                    <div class="col-md-9">
                        <input type="text" name="kegiatan" class="form-control form-control-sm" placeholder="Uraian Akun" required>
                    </div>
                </div>
                <div class="form-row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('akun.view') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection