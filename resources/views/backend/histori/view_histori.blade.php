@extends('admin.admin_master')
@section('title','Histori')
@section('admin')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-list"></i> History [Revisi] RKAS/M
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-3">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Revisi</th>
                            <th>Tanggal</th>
                            <th>Waktu Pembuatan</th>
                            <th>Hapus History</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($histori as $item)
                        <tr>
                            <td>{{ $item->revisi }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s') }}</td>
                            <td>
                                @if($item->revisi != 0)
                                <form action="{{ route('histori.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-trash"></i> HAPUS HISTORY REVISI {{ $item->revisi }}
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ route('histori.store') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id_anggaran" value="{{ $dataAnggaran->id_anggaran }}">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-copy"></i> BUAT HISTORY REVISI {{ $nextRevisi }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection