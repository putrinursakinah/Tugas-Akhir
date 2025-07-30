@extends('admin.admin_master')
@section('title', 'Daftar Tagihan Siswa')
@section('admin')

<div class="container-fluid">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-table"></i> Daftar Tagihan Siswa
            </h6>
            <a href="{{ route('tagihan.generate.page') }}" class="btn btn-sm btn-light shadow-sm">
                <i class="fas fa-sync fa-sm text-gray-800"></i> Generate Tagihan
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jenis Biaya</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Tanggal Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kelasHasSiswa->siswa->nama ?? '-' }}</td>
                            <td>{{ $item->kelasHasSiswa->kelas->nama ?? '-' }}</td>
                            <td>{{ $item->jenisBiaya->nama }}</td>
                            <td>Rp {{ number_format($item->jenisBiaya->nominal, 0, ',', '.') }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->tgl_tagihan }}</td>
                            <td>
                                <form action="{{ route('tagihan.delete', $item->id_tagihan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada tagihan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
