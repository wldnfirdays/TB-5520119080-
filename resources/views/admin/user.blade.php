@extends('adminlte::page')

@section('title', 'USER')

@section('content_header')
<h1 class="text-center text-bold">User</h1>
@stop

@section('content')
<div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">{{ __('Pengelolaan USER') }}</div> -->

                    <div class="card-body table-responsive" >
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i>Tambah User</button>
                        <hr/>
                        <table id="table-data" class="table table-borderer">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th>USERNAME</th>
                                    <th>EMAIL</th>
                                    {{-- <th>PASSWORD</th> --}}
                                    <th>HAK AKSES</th>
                                    <th>PHOTO</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        {{-- <td>
                                            <!-- <input type="text" value="{{ $user->password }}"/> -->
                                            {{ dcrypt($user->password) }}
                                        </td> --}}
                                        <td>{{ $user->roles->name}}</td>
                                        <td>
                                            @if ($user->photo !== null)
                                                <img src="{{ asset('storage/photo_user/'.$user->photo) }}" width="50px">
                                            @else
                                                [Gambar tidak tersedia]
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <button type="button" id="btn-edit-user" class="btn btn-success" data-toggle="modal" data-target="#editUserModal" data-id="{{ $user->id }}">Edit</button>
                                                <button type="button" id="btn-delete-user" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-id="{{ $user->id }}">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- delete data brand --}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Produk</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Data --}}
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">NAME</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">USERNAME</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="roles_id">HAK AKSES</label>
                            <select id="roles_id" class="form-control" name="roles_id">
                                @foreach($roles as $role)
                                <option name="roles_id" value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="photo">PHOTO</label>
                            <input type="file" class="form-control" name="photo" id="photo" required>
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
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-name">NAME</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-username">USERNAME</label>
                            <input type="text" class="form-control" name="username" id="edit-username" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-email">EMAIL</label>
                            <input type="email" class="form-control" name="email" id="edit-email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-password">PASSWORD</label>
                            <input type="password" class="form-control" name="password" id="edit-password" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-roles_id">HAK AKSES</label>
                            <select id="edit-roles_id" class="form-control" name="roles_id">
                                @foreach($roles as $role)
                                <option name="roles_id" value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group" id="image-area"></div>
                            <div class="form-group">
                                <label for="edit-photo">Photo</label>
                                <input type="file" class="form-control" name="photo" id="edit-photo">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <br>
                    <input type="hidden" name="id" id="edit-id">
                    <input type="hidden" name="old_photo" id="edit-old-photo">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
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
            $(document).on('click', '#btn-edit-user', function(){
                let id = $(this).data('id');
                $('#image-area').empty();
                $.ajax({
                    type: "get",
                    url: baseurl+'/ajax/dataUser/'+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-id').val(res.id);
                        $('#edit-name').val(res.name);
                        $('#edit-username').val(res.username);
                        $('#edit-email').val(res.email);
                        $('#edit-password').val(res.password);
                        $('#edit-roles_id').val(res.roles_id);
                        $('#edit-old-photo').val(res.photo);
                        if (res.photo !== null){
                            $('#image-area').append(`<img src="${baseurl}/storage/photo_user/${res.photo}" width="150px"/>`);
                        } else {
                            $('#image-area').append('[Gambar tidak Tersedia]');
                        }
                    },
                });
            });
        });
        $(document).on('click', '#btn-delete-user', function(){
            let id = $(this).data('id');
            $('#delete-id').val(id);
        });
</script>
@stop