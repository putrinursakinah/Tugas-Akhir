@extends('admin.admin_master')
@section('title','Kode Kegiatan')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-list"></i> Daftar Kode Kegiatan
            </h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <!-- Tempatkan tombol di sini jika ingin di atas tabel -->
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>Edit</th>
                            <th>Kode</th>
                            <th>Kegiatan</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatan as $item)
                        <tr class="{{ $loop->odd ? 'bg-light' : '' }}">
                            <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                            <td>
                                <a href="{{ route('kegiatan.edit', $item->id_kegiatan) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> EDIT
                                </a>
                            </td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->kategori }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <a href="{{ route('kegiatan.add') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus"></i> TAMBAH
                </a>
                <form action="{{ route('kegiatan.bulkDelete') }}" method="POST" style="display:inline;" id="bulkDeleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')">
                        <i class="fas fa-trash"></i> HAPUS
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection