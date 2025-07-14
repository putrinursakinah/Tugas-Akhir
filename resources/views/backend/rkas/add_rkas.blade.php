@extends('admin.admin_master')
@section('title','Tambah Kegiatan')
@section('admin')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow" style="border-radius:12px;">
                <div class="card-header bg-white" style="border-radius:12px 12px 0 0;">
                    <h4 class="mb-0" style="color:#b23c3c; font-family:monospace; font-weight:bold;">
                        <i class="fas fa-plus-square"></i> TAMBAH KEGIATAN
                    </h4>
                </div>
                <form action="{{ route('rkas.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Pilih Kegiatan</label>
                            <select name="kegiatan_id" class="form-control" required>
                                <option value="">--Pilih Kegiatan--</option>
                                @foreach($kegiatan as $item)
                                    <option value="{{ $item->id_kegiatan }}">{{ $item->kegiatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between" style="border-radius:0 0 12px 12px;">
                        <button type="submit" class="btn btn-primary btn-sm font-weight-bold">
                            <i class="far fa-check-square"></i> SIMPAN
                        </button>
                        <a href="{{ route('rkas.view') }}" class="btn btn-dark btn-sm" style="border-radius:12px; font-family:monospace;">
                            CLOSE
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection