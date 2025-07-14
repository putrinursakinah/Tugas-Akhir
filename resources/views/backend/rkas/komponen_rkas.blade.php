@extends('admin.admin_master')
@section('title','Tambah Komponen')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4" style="max-width:1100px; margin:auto;">
        <div class="card-header py-2 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-file-alt"></i> Tambah Komponen
            </h6>
        </div>
        <div class="card-body" style="background:#f8f9fc;">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <b>KATEGORI</b> : <span class="font-weight-bold">
                            {{ strtolower($rkas->jenis ?? $kegiatan->kategori ?? '') == 'belanja' ? 'B' : 'A' }} - {{ strtoupper($rkas->jenis ?? $kegiatan->kategori ?? '') }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <b>KEGIATAN</b> : <span class="font-weight-bold">
                            {{ $rkas->kode_akun ?? $kegiatan->kode ?? '' }} - {{ $rkas->uraian ?? $kegiatan->kegiatan ?? '' }}
                        </span>
                    </div>
                </div>
            </div>
            <form action="{{ route('rkas.komponenStore', $rkas->id) }}" method="POST">
                @csrf
                <label class="font-weight-bold mb-2">Tambah Komponen</label>
                <div class="form-row mb-2">
                    <div class="col-md-2">
                        <input type="text" name="kode" class="form-control" placeholder="Kode" maxlength="3" required>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="uraian" class="form-control" placeholder="Uraian Komponen" required>
                    </div>
                </div>
                <small class="text-muted">
                    Komponen adalah Kodifikasi berupa Huruf/Abjad, terdiri 1 - 3 digit. Misal : A, B, AA, ABC
                </small>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary btn-sm font-weight-bold">
                        <i class="fas fa-user-plus"></i> SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection