@extends('admin.admin_master')
@section('title','Edit Akun')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4" style="max-width:1100px; margin:auto;">
        <div class="card-header py-2 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-edit"></i> Edit Akun
            </h6>
        </div>
        <div class="card-body" style="background:#e0e0e0;">
            <form action="{{ route('akun.update', $akun->id_akun) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label font-weight-bold text-md-right">Kode Akun</label>
                    <div class="col-md-10">
                        <input type="text" name="kode" class="form-control" value="{{ old('kode', $akun->kode) }}" maxlength="20" required>
                        <small>
                            Kode Akun untuk Kategori
                            <span class="text-success font-weight-bold">Pendapatan : 100000 - 199999</span><br>
                            Kode Akun untuk Kategori
                            <span class="text-danger font-weight-bold">Belanja : 200000 - 299999</span>
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label font-weight-bold text-md-right">Uraian Akun</label>
                    <div class="col-md-10">
                        <input type="text" name="kegiatan" class="form-control" value="{{ old('kegiatan', $akun->kegiatan) }}" required>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-10 offset-md-2">
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