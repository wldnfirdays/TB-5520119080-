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
                    <!-- <div class="card-header">{{ __('  ') }}</div> -->

                    <div class="card-body">
                    <a href="{{ route('admin.print_masuk') }}" target="_blank" class="btn btn-secondary float-right"><i class="fa fa-print"></i> Cetak PDF</a>
                        <hr/>
                        <hr/>
                        <table id="table-data" class="table table-borderer">
                        <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th>QTY</th>
                                    <th>TANGGAL MASUK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($masuks as $masuk)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $masuk->name }}</td>
                                        <td>{{ $masuk->qty }}</td>
                                        <td>{{ $masuk->created_at}}</td>
                                        
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        
    </script>
@stop 