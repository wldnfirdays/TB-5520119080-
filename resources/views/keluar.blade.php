@extends('adminlte::page')

@section('title', 'LAPORAN')

@section('content_header')
    <h1 class="text-center text-bold">Laporan Barang Keluar</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Laporan Barang Keluar') }}</div>

                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBrandModal"><i class="fa fa-plus"></i>Tambah Data</button>
                        <hr/>
                        <table id="table-data" class="table table-borderer">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>KETERANGAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($keluars as $keluar)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $keluar->name }}</td>
                                        <td>{{ $keluar->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <button type="button" id="btn-edit-keluar" class="btn btn-success" data-toggle="modal" data-target="#editKeluarModal" data-id="{{ $keluar->id }}">Edit</button>
                                                <button type="button" id="btn-delete-keluar" class="btn btn-danger" data-toggle="modal" data-target="#deleteKeluarModal" data-id="{{ $keluar->id }}">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop