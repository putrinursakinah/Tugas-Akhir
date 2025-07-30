@extends('admin.admin_master')
@section('title','Kode Kegiatan')
@section('admin')

<form action="{{ route('set-tahun') }}" method="POST">
    @csrf
    <label for="sidebarTahun" class="text-white small">Tahun Ajaran</label>
    <select name="tahun" id="sidebarTahun" class="form-control form-control-sm">
        @foreach ($tahunAjaranList as $item)
        <option value="{{ $item->tahun }}" {{ session('tahun_aktif') == $item->tahun ? 'selected' : '' }}>
            {{ $item->tahun }}
        </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan</button>
</form>

@endsection