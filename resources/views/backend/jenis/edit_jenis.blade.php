@extends('admin.admin_master')
@section('title', 'Edit Jenis Biaya')
@section('admin')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header bg-warning py-3">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-edit"></i> Edit Jenis Biaya
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

            <form action="{{ route('jenis.update', $jenis->id_jenisbiaya) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Biaya</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $jenis->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" value="{{ old('nominal', $jenis->nominal) }}" required>
                </div>

                <div class="form-group">
                    <label for="periode_pembayaran">Periode Pembayaran</label>
                    <select name="periode_pembayaran" id="periode_pembayaran" class="form-control" required>
                        <option value="bulanan" {{ $jenis->periode_pembayaran === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ $jenis->periode_pembayaran === 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        <option value="sekali" {{ $jenis->periode_pembayaran === 'sekali' ? 'selected' : '' }}>Sekali</option>
                    </select>
                </div>

                <div class="form-group mt-4">
                    <a href="{{ route('jenis.view') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
