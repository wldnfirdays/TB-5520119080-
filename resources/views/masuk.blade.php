@extends('adminlte::page')

@section('title', 'LAPORAN')

@section('content_header')
    <h1 class="text-center text-bold">Laporan Barang Masuk</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Laporan Barang Masuk') }}</div>

                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMasukModal"><i class="fa fa-plus"></i>Tambah Data</button>
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
                                @foreach($masuks as $masuk)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $masuk->name }}</td>
                                        <td>{{ $masuk->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <button type="button" id="btn-edit-masuk" class="btn btn-success" data-toggle="modal" data-target="#editMasukModal" data-id="{{ $masuk->id }}">Edit</button>
                                                <button type="button" id="btn-delete-masuk" class="btn btn-danger" data-toggle="modal" data-target="#deleteMasukModal" data-id="{{ $masuk->id }}">Hapus</button>
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

    {{-- Tambah Data --}}
    <div class="modal fade" id="tambahMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masuk.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">NAMA</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">KETERANGAN</label>
                            <input type="text" class="form-control" name="description" id="description" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Data --}}
    <div class="modal fade" id="editMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Masuk Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('masuk.update') }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-name">NAMA</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">KETERANGAN</label>
                            <input type="text" class="form-control" name="description" id="edit-description" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="edit-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- delete data masuk --}}
    <div class="modal fade" id="deleteMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data tersebut?
                    <form action="{{ route('masuk.delete') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="delete-id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function(){
             // update masuk
            $(document).on('click', '#btn-edit-masuk', function(){
                let id = $(this).data('id');

                $.ajax({
                    type: "get",
                    url: baseurl+'/ajax/dataMasuk/'+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-id').val(res.id); //harus tambah id
                        $('#edit-name').val(res.name);
                        $('#edit-description').val(res.description);
                    },
                });
            });
            // delete masuk
            $(document).on('click', '#btn-delete-masuk', function(){
                let id = $(this).data('id');

                $('#delete-id').val(id);
            });
        });
    </script>
@stop