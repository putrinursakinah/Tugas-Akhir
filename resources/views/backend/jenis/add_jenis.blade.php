@extends('admin.admin_master')
@section('title', 'Tambah Jenis Biaya')
@section('admin')

<div class="container-fluid">

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus"></i> Tambah Jenis Biaya
            </h6>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jenis.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Biaya</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" value="{{ old('nominal') }}" required>
                </div>

                <div class="form-group">
                    <label for="periode_pembayaran">Periode Pembayaran</label>
                    <select name="periode_pembayaran" id="periode_pembayaran" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Periode --</option>
                        <option value="bulanan" {{ old('periode_pembayaran') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ old('periode_pembayaran') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        <option value="sekali" {{ old('periode_pembayaran') == 'sekali' ? 'selected' : '' }}>Sekali</option>
                    </select>
                </div>

                <div class="form-group mt-4">
                    <a href="{{ route('jenis.view') }}" class="btn btn-secondary">
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
