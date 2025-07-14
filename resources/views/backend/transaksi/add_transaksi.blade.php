@extends('admin.admin_master')
@section('title','Tambah Transaksi')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus-square"></i> Rekam Transaksi
            </h6>
        </div>
        <div class="card-body">
            <div class="card mx-auto" style="max-width: 700px;">
                <div class="card-body">
                    <button class="btn btn-secondary mb-4" disabled style="cursor:default;">FILTER KATEGORI TRANSAKSI</button>
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Mode Kas</label>
                            <div class="col-md-8">
                                <select class="form-control" name="mode_kas">
                                    <option>--Pilih Model--</option>
                                    @foreach($modeKas as $kas)
                                    <option value="{{ $kas->id_mode }}">{{ $kas->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Kategori Transaksi</label>
                            <div class="col-md-8">
                                <select class="form-control" name="kategori_transaksi">
                                    <option>--Pilih Kategori--</option>
                                    <option>Penerimaan ke Tunai</option>
                                    <option>Pengeluaran ke Tunai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Jenis Transaksi</label>
                            <div class="col-md-8">
                                <select class="form-control" name="jenis_transaksi">
                                    <option>--Pilih Jenis--</option>
                                    <option>Penerimaan ke Tunai</option>
                                    <option>Pungutan Pajak Tunai</option>
                                    <option>Pengembalian Belanja Tunai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mr-2">
                                    LANJUT <i class="fas fa-angle-double-right"></i>
                                </button>
                                <a href="{{ route('transaksi.create') }}" class="btn btn-info">
                                    <i class="fas fa-times"></i> Cancel
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