@extends('layouts.backend')

@section('title', $data['title'])

@section('content')

 <!-- start page title -->
 <div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Data Guru</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                <li class="breadcrumb-item active">Data Guru</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
                <a href="{{ route('guru.create') }}" class="btn btn-primary dropdown-toggle waves-effect waves-light">
                    <i class="mdi mdi-plus"></i> Tambah
                </a>

                <a class="btn btn-success text-white" data-toggle="modal" data-target="#importExcel">
                    <i class="mdi mdi-file-excel-outline"></i> Import
                </a>
        </div>
    </div>
</div>     
                        <!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            
            <div class="card-body">
            
                <h4 class="card-title">Data Guru</h4>
               
               
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Guru</th>
                      <th>Foto</th>
                      <th>Jenis Kelamin</th>
                      <th>Jabatan</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($data['guru'] as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>
                        <img src="{{ asset($item->foto) }}" class="img-thumbnail"></td>
                      <td>{{ $item->jk == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
                      <td>{{ $item->jabatan }}</td>

                     <td>
                
                            <a href="{{ route('guru.edit', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-info" data-toggle="tooltip" data-original-title="click to edit guru">
                                <i class="ion ion-md-create"></i>
                            </a>
                            
                            <a href="{{ route('guru.destroy', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-danger delete" onclick="return confirm('Anda Yakin ?')" data-toggle="tooltip" data-original-title="click to delete guru"><i class="ion ion-md-trash"></i>
                                
                            </a>
                   
                        </td>
                    </tr>
                    
                    @endforeach
                    
                    
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('guru.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
            </div>
            <div class="modal-body">

                <p>"Fitur Guru memungkinkan untuk Anda mengupload banyak data dalam bentuk Excel (.xlsx), silakan download FORMAT excel berikut untuk Anda sesuaikan".
                <br><a href="{{ Route('guru.download') }}" class="badge badge-primary mt-2">Download Disini</a>
                <hr>

            <div class="form-group">
                <label>Pilih file excel</label>
                <br>
                <input class="form-control" name="import_file" type="file">
            </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection


@section('jsbody')

@endsection