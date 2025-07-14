@extends('admin.admin_master')
@section('title','Identitas')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4" style="max-width:900px; margin:auto;">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-home"></i> Seting Pengelola
        </div>
        <div class="card-body">
            <form action="{{ route('identitas.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills">
                            <button class="btn btn-light mb-3 active" type="button" style="pointer-events:none;">SETTING PENGEL</button>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">Nama Bendahara</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_bendahara" class="form-control" value="{{ old('nama_bendahara', $identitas->nama_bendahara ?? '') }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">NIP Bendahara</label>
                            <div class="col-sm-8">
                                <input type="text" name="nip_bendahara" class="form-control" value="{{ old('nip_bendahara', $identitas->nip_bendahara ?? '') }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">Nama Pimpinan</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_pimpinan" class="form-control" value="{{ old('nama_pimpinan', $identitas->nama_pimpinan ?? '') }}">
                                <small class="text-muted">Pimpinan/Atasan Bendahara [Seperti Sekolah, Lembaga dll]</small>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">NIP Pimpinan</label>
                            <div class="col-sm-8">
                                <input type="text" name="nip_pimpinan" class="form-control" value="{{ old('nip_pimpinan', $identitas->nip_pimpinan ?? '') }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">Jabatan Pimpinan</label>
                            <div class="col-sm-8">
                                <input type="text" name="jabatan_pimpinan" class="form-control" value="{{ old('jabatan_pimpinan', $identitas->jabatan_pimpinan ?? '') }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">Nama Atasan Pimpinan</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_atasan_pimpinan" class="form-control" value="{{ old('nama_atasan_pimpinan', $identitas->nama_atasan_pimpinan ?? '') }}" placeholder="Nama Atasan Pimpinan">
                                <small class="text-muted">Atasan Pimpinan untuk Mengetahui Laporan [Seperti Ketua Komite, Yayasan dll]</small>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">Jabatan Atasan Pimpinan</label>
                            <div class="col-sm-8">
                                <input type="text" name="jabatan_atasan_pimpinan" class="form-control" value="{{ old('jabatan_atasan_pimpinan', $identitas->jabatan_atasan_pimpinan ?? '') }}" placeholder="Jabatan Atasan Pimpinan">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">Nama Pejabat Komitmen</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_pejabat_komitmen" class="form-control" value="{{ old('nama_pejabat_komitmen', $identitas->nama_pejabat_komitmen ?? '') }}" placeholder="Nama Pejabat Pembuat Komitmen">
                                <small class="text-muted">Jabatan Pembuat Komitmen Pengeluaran Belanja Bendahara</small>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label font-weight-bold">NIP Pejabat Komitmen</label>
                            <div class="col-sm-8">
                                <input type="text" name="nip_pejabat_komitmen" class="form-control" value="{{ old('nip_pejabat_komitmen', $identitas->nip_pejabat_komitmen ?? '') }}" placeholder="NIP Pejabat Pembuat Komitmen">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-4 col-form-label font-weight-bold">Jabatan Pejabat Komitmen</label>
                            <div class="col-sm-8">
                                <input type="text" name="jabatan_pejabat_komitmen" class="form-control" value="{{ old('jabatan_pejabat_komitmen', $identitas->jabatan_pejabat_komitmen ?? '') }}" placeholder="Jabatan Pejabat Pembuat Komitmen">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                                <a href="{{ route('identitas.view') }}" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection