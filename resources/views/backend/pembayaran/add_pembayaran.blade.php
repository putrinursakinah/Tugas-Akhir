@extends('admin.admin_master')
@section('title', 'Tambah Pembayaran')
@section('admin')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus"></i> Tambah Pembayaran
            </h6>
        </div>

        <div class="card-body">
            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf

                <input type="hidden" name="siswa_id" value="{{ $siswa->id_siswa }}">

                <div class="mb-3">
                    <label for="tagihan" class="form-label">Tanggungan / Tagihan</label>
                    <select name="tagihan_id" id="tagihan" class="form-control" required>
                        <option value="">-- Pilih Tanggungan --</option>
                        @foreach($tagihanSiswa as $tagihan)
                        <option value="{{ $tagihan->id_tagihan }}">
                            {{ $tagihan->jenisBiaya->nama }} -
                            Rp {{ number_format($tagihan->jenisBiaya->nominal,0,',','.') }}
                            @if($tagihan->status == 'Lunas') [LUNAS] @endif
                        </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal Bayar</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal bayar" required>
                </div>


                <div class="form-group mt-4">
                    <a href="{{ route('pembayaran.view') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection