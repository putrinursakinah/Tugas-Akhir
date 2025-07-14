@extends('admin.admin_master')
@section('title','Kode Kegiatan')
@section('admin')

<form action="{{ route('tahun-ajaran.index') }}" method="POST">
    @csrf
    <label for="sidebarTahun" class="text-white small">Tahun Ajaran</label>
    <select name="tahun" id="sidebarTahun" class="form-control form-control-sm">
        @foreach (range(date('Y'), date('Y') + 5) as $tahun)
            <option value="{{ $tahun }}">{{ $tahun }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan</button>
</form>

@endsection