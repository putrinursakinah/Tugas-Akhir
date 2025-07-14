@extends('admin.admin_master')
@section('title','Rekam Transaksi')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus-square"></i> Rekam Transaksi
            </h6>
        </div>
        <div class="card-body">
            <div class="card mx-auto" style="max-width: 900px;">
                <div class="card-body">
                    <button class="btn btn-secondary mb-4" disabled style="cursor:default;">INPUT DATA TRANSAKSI</button>
                    <form>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-bold">Kategori</label>
                            <div class="col-md-9 d-flex align-items-center">
                                <span class="text-primary font-weight-bold">A1 : Penerimaan Tunai</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-bold">Jenis Transaksi</label>
                            <div class="col-md-9 d-flex align-items-center">
                                <span class="text-primary font-weight-bold">11 : Penerimaan ke Tunai</span>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-3 col-form-label font-weight-bold">Pagu Anggaran</label>
                            <div class="col-md-9 d-flex align-items-center">
                                <a href="{{ route('transaksi.pagu') }}" class="btn btn-primary btn-sm mr-2">
                                    <i class="fas fa-bookmark"></i> PILIH PAGU
                                </a>
                                <span class="text-danger ml-2">Akun Belum dipilih</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-bold">No Bukti & Tanggal</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="3" readonly>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" value="2025-06-15" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-bold">Jumlah</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" placeholder="Jumlah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-bold">Uraian</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="4" style="background:#edeff2"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-bold">Penerima Uang</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Penerima Uang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-bold">Jabatan Penerima Uang</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Jabatan Penerima Uang">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-left">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fas fa-save"></i> SIMPAN
                                </button>
                                <a href="{{ route('transaksi.view') }}" class="btn btn-primary">
                                    <i class="fas fa-times"></i> CANCEL
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection