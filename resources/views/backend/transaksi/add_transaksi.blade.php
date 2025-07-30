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
                        @csrf

                        {{-- MODE KAS --}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Mode Kas</label>
                            <div class="col-md-8">
                                <select class="form-control" name="mode_kas_id" id="modeKasSelect">
                                    <option value="">--Pilih Mode--</option>
                                    @foreach($modeKasList as $kas)
                                    <option value="{{ $kas->id_mode }}">{{ $kas->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- KATEGORI --}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Kategori Transaksi</label>
                            <div class="col-md-8">
                                <select class="form-control" name="kategori_kas_id" id="kategoriTransaksiSelect">
                                    <option value="">--Pilih Kategori--</option>
                                    @foreach($kategoriKasList as $kategori)
                                    <option value="{{ $kategori->id_kategorikas }}">{{ $kategori->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- JENIS --}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Jenis Transaksi</label>
                            <div class="col-md-8">
                                <select class="form-control" name="jenis_transaksi_id" id="jenisTransaksiSelect">
                                    <option value="">--Pilih Jenis--</option>
                                    @foreach($jenisTransaksiList as $jenis)
                                    <option value="{{ $jenis->id_transaksi }}">{{ $jenis->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">Data Anggaran</label>
                            <div class="col-md-8 d-flex align-items-center">
                                <select name="dataanggaran" class="form-control" id="dataAnggaranSelect">
                                    <option value="">--Pilih Kategori Terlebih Dahulu--</option>
                                </select>
                                <span class="text-danger ml-2">Akun Belum dipilih</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">No Bukti & Tanggal</label>
                            <div class="col-md-4">
                                <input type="text" name="no_bukti" class="form-control" placeholder="No Bukti">
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="tanggal" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Jumlah</label>
                            <div class="col-md-8">
                                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Uraian</label>
                            <div class="col-md-8">
                                <input type="text" name="uraian" class="form-control" placeholder="Uraian Transaksi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Penerima Uang</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Penerima Uang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Jabatan Penerima Uang</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Jabatan Penerima Uang">
                            </div>
                        </div>


                        {{-- BUTTONS --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mr-2">
                                    LANJUT <i class="fas fa-angle-double-right"></i>
                                </button>
                                <a href="{{ route('transaksi.add') }}" class="btn btn-info">
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event ketika Mode Kas diubah
        $('#modeKasSelect').on('change', function() {
            var modeKasId = $(this).val();

            // Kosongkan dropdown
            $('#kategoriTransaksiSelect').html('<option value="">--Pilih Kategori--</option>');
            $('#jenisTransaksiSelect').html('<option value="">--Pilih Jenis--</option>');
            $('#dataAnggaranSelect').html('<option value="">--Pilih Kategori Terlebih Dahulu--</option>');

            if (modeKasId) {
                // Ambil kategori berdasarkan Mode Kas
                $.get('/transaksi/get-kategori-by-mode/' + modeKasId, function(data) {
                    $.each(data, function(i, kategori) {
                        $('#kategoriTransaksiSelect').append('<option value="' + kategori.id_kategorikas + '">' + kategori.keterangan + '</option>');
                    });
                });

                // Ambil semua jenis transaksi
                $.get('/transaksi/get-jenis-transaksi', function(data) {
                    $.each(data, function(i, jenis) {
                        $('#jenisTransaksiSelect').append('<option value="' + jenis.id_transaksi + '">' + jenis.keterangan + '</option>');
                    });
                });
            }
        });

        // Event ketika Kategori Transaksi diubah
        $('#kategoriTransaksiSelect').on('change', function() {
            var kategoriId = $(this).val();
            var $dataAnggaranSelect = $('#dataAnggaranSelect');

            $dataAnggaranSelect.html('<option value="">--Memuat Data--</option>');

            if (kategoriId) {
                $.get('/transaksi/get-dataanggaran-by-kategori/' + kategoriId, function(data) {
                    $dataAnggaranSelect.html('<option value="">--Pilih Data Anggaran--</option>');
                    $.each(data, function(i, item) {
                        $dataAnggaranSelect.append('<option value="' + item.id_anggaran + '">' + item.uraian + '</option>');
                    });
                });
            } else {
                $dataAnggaranSelect.html('<option value="">--Pilih Kategori Terlebih Dahulu--</option>');
            }
        });
    });
</script>
@endsection