@extends('admin.admin_master')
@section('title','Edit Kegiatan')
@section('admin')

<div class="d-flex justify-content-center mt-4">
    <div class="card shadow mb-4" style="width:100%; max-width:700px;">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-edit"></i> Edit Kegiatan
            </h6>
        </div>
        <div class="card-body" style="background: #f8f9fc;">
            <form action="{{ route('kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row align-items-center mb-3">
                    <label class="col-md-3 col-form-label font-weight-bold text-md-right">Kode Kegiatan</label>
                    <div class="col-md-9">
                        <input type="text" name="kode" class="form-control form-control-sm mb-1" value="{{ old('kode', $kegiatan->kode) }}" maxlength="4" required>
                        <small>
                            Kode Kegiatan untuk Kategori
                            <span class="text-success font-weight-bold">Pendapatan : 1000 - 1999</span><br>
                            Kode Kegiatan untuk Kategori
                            <span class="text-danger font-weight-bold">Belanja : 2000 - 2999</span>
                        </small>
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label class="col-md-3 col-form-label font-weight-bold text-md-right">Uraian Kegiatan</label>
                    <div class="col-md-9">
                        <input type="text" name="kegiatan" class="form-control form-control-sm" value="{{ old('kegiatan', $kegiatan->kegiatan) }}" required>
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label class="col-md-3 col-form-label font-weight-bold text-md-right">Kategori</label>
                    <div class="col-md-9">
                        <select name="kategori" class="form-control form-control-sm" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pendapatan" {{ old('kategori', $kegiatan->kategori)=='Pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                            <option value="Belanja" {{ old('kategori', $kegiatan->kategori)=='Belanja' ? 'selected' : '' }}>Belanja</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('kegiatan.view') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection