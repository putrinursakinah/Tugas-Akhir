@extends('admin.admin_master')
@section('title', 'Siswa')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-list"></i> Data Siswa & Tanggungan
            </h6>
        </div>
        <div class="card-body">

            {{-- Flash Message --}}
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('siswa.delete') }}" method="POST" id="deleteForm">
                @csrf

                <div class="mb-3">
                    <a href="{{ route('siswa.add') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> TAMBAH
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus siswa yang dipilih?')">
                        <i class="fas fa-trash"></i> HAPUS
                    </button>
                    <a href="{{ route('siswa.export.excel') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-file-excel"></i> EXCEL
                    </a>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="viewCount" class="form-label">View</label>
                        <select id="viewCount" class="form-select form-select-sm">
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>Edit</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Angkatan Tahun</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswaList as $siswa)
                            <tr>
                                <td><input type="checkbox" name="selected[]" value="{{ $siswa->id_siswa }}"></td>
                                <td>
                                    <a href="{{ route('siswa.edit', $siswa->id_siswa) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->alamat }}</td>
                                <td>{{ $siswa->telepon }}</td>
                                <td>{{ $siswa->angkatan }}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Belum ada data siswa</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <p class="mt-2">Record: {{ $siswaList->count() }}</p>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="selected[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endpush