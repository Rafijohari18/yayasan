@extends('layouts.backend')

@section('title', $data['title'])

@section('content')

 <!-- start page title -->
 <div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Album</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Modul</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Gallery</a></li>
                <li class="breadcrumb-item active">Album</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
                <a href="{{ route('gallery.album.create') }}" class="btn btn-primary dropdown-toggle waves-effect waves-light">
                    <i class="mdi mdi-plus"></i> Tambah
                </a>
        </div>
    </div>
</div>     
                        <!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            
            <div class="card-body">
            
                <h4 class="card-title">Data Album</h4>
               
               
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                      
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($data['album'] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{!! Str::limit($item->name, 80) !!}</td>
                        <td>
                            <a href="{{ route('gallery.album.photo', ['albumId' => $item['id']]) }}" class="btn icon-btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Klik untuk  preview album">
                                <i class="ion ion-md-images"></i>
                            </a>
                            <a href="{{ route('gallery.album.edit', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Klik untuk edit album">
                                <i class="ion ion-md-create"></i>
                            </a>
                            
                            <a href="{{ route('gallery.album.destroy', ['id' => $item['id']])}}" class="btn icon-btn btn-sm btn-danger delete" onclick="return confirm('Anda Yakin ?')" data-toggle="tooltip" data-original-title="Klik untuk delete album"><i class="ion ion-md-trash"></i>
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


@endsection


@section('jsbody')

@endsection