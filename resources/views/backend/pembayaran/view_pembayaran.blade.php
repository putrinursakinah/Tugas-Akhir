@extends('admin.admin_master')
@section('title', 'Pembayaran Tagihan')
@section('admin')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-money-check-alt"></i> Pembayaran Tagihan
            </h6>
        </div>

        <div class="card-body">

            {{-- Flash Message --}}
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
            @endif

            {{-- Form pencarian NIS --}}
            <form action="{{ route('pembayaran.view') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS" value="{{ request('nis') }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>

            @if(isset($siswa))
            {{-- Data siswa ditemukan --}}
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h5>Nama Siswa: <strong>{{ $siswa->nama }}</strong> |
                    Kelas: {{ $siswa->kelas ?? '-' }}
                </h5>

                {{-- Tombol Tambah Pembayaran --}}

            </div>

            {{-- Total Record --}}
            <div class="alert alert-info py-2">
                Total Tagihan: <strong>{{ $tagihanSiswa->count() }}</strong>
            </div>

            {{-- Tabel tagihan --}}
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tagihan</th>
                            <th>Nominal</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihanSiswa as $index => $tagihan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $tagihan->jenisBiaya->nama }}</td>
                            <td>Rp {{ number_format($tagihan->jenisBiaya->nominal, 0, ',', '.') }}</td>
                            <td>{{ $tagihan->status }}</td>
                            <td class="text-right">
                                <a href="{{ route('pembayaran.add', ['siswa_id' => $siswa->id_siswa]) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Bayar
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center align-middle" style="height: 100px;">
                                Tidak ada tagihan ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Riwayat Pembayaran --}}
            @if($pembayaranSiswa->count())
            <h6 class="mt-4">Riwayat Pembayaran</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tagihan</th>
                            <th>Nominal Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaranSiswa as $index => $pembayaran)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pembayaran->tagihanSiswa->jenisBiaya->nama ?? '-' }}</td>
                            <td>
                                Rp {{ number_format($pembayaran->transaksi->debet ?? 0, 0, ',', '.') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($pembayaran->tgl_pembayaran)->format('d-m-Y') }}
                            </td>
                            <td>
                                {{ $pembayaran->tagihanSiswa->status ?? 'Lunas' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @endif
        </div>
    </div>

</div>

@endsection