@extends('admin.admin_master')
@section('title','Tambah Kegiatan')
@section('admin')

<div class="d-flex justify-content-center mt-4">
    <div class="card shadow mb-4" style="width:100%; max-width:700px;">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus-square"></i> Tambah Kegiatan
            </h6>
        </div>
        <div class="card-body" style="background: #f8f9fc;">
            <form action="{{ route('kegiatan.store') }}" method="POST">
                @csrf
                <div class="form-row align-items-center mb-3">
                    <label class="col-md-3 col-form-label font-weight-bold text-md-right">Kode Kegiatan</label>
                    <div class="col-md-9">
                        <input type="text" name="kode" class="form-control form-control-sm mb-1" placeholder="Kode Kegiatan [4 Digit]" maxlength="4" required>
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
                        <input type="text" name="kegiatan" class="form-control form-control-sm" placeholder="Uraian Kegiatan" required>
                    </div>
                </div>
                <div class="form-row align-items-center mb-3">
                    <label class="col-md-3 col-form-label font-weight-bold text-md-right">Kategori</label>
                    <div class="col-md-9">
                        <select name="kategori_id_kategori" class="form-control form-control-sm" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori->id_kategori }}" style="color:#000; background-color:#fff;">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save"></i> Simpan
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