@extends('admin.admin_master')
@section('title','Spp')
@section('admin')

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Kelola SPP</h1>
            </div>
            <div class="co text-end mb-2">
                <a href="{{route('spp.add')}}"><button type="button" class="btn btn-primary">Tambah Data</button></a>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="80%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><center>Kode Akun</center></th>
                            <th><center>Uraian</center></th>
                            <th><center>Vol</center></th>
                            <th><center>Satuan</center></th>
                            <th><center>Harga satuan</center></th>
                            <th><center>Jumlah</center></th>
                            <th><center>Aksi</center></th>
                        </tr>
                    </thead>

                        @foreach ($data as $item =>$spp) 
                    <tbody>
                        <tr>

                            <td>{{spp->kode_akun}}</td>
                            <td>{{spp->uraian}}</td>
                            <td>{{spp->vol}}</td>
                            <td>{{spp->satuan}}</td>
                            <td>{{spp->harga_satuan}}</td>
                            <td>{{spp->jumlah}}</td>
                            <td><center>
                                <a href="{{route('spp.edit', $spp)}}"><button type="button" class="btn btn-warning btn-sm">Edit<i class="fa fa-upload"></i></button></a>
                                <a href="{{route('spp.delete', $spp)}}" class="btn btn-danger btn-sm">Delete<i class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection