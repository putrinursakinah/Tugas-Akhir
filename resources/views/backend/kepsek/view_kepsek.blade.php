@extends('admin.admin_master')
@section('admin')

<div class="container">
    <h4>Dashboard Kepala Sekolah</h4>
    <div class="card">
        <div class="card-body">
            {{-- Isi tampilan dashboard kepala sekolah di sini --}}
            <p>Selamat datang, {{ auth()->user()->name }}</p>
        </div>
    </div>
</div>
@endsection