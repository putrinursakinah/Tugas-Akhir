@extends('admin.admin_master')
@section('title','Kode Kegiatan')
@section('admin')

<div class="container-fluid">
    <h4 class="mb-3">Daftar Tahun Ajaran</h4>

    <form action="{{ route('tahun.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="input-group w-25">
            <input type="text" name="tahun" class="form-control" placeholder="Masukkan Tahun">
            <button class="btn btn-primary" type="submit">Tambah Data</button>
        </div>
    </form>

    <table class="table table-bordered table-sm">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->tahun }}</td>
                <td class="text-center">
                    <form action="{{ route('tahun.set-aktif', ['id' => $item->id_tahun_ajaran]) }}" method="POST">
                        @csrf
                        <input type="checkbox" onchange="this.form.submit()" {{ $item->is_active ? 'checked' : '' }}>
                    </form>
                </td>
                <td>
                    {{-- Tambahkan tombol edit/hapus jika diperlukan --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection