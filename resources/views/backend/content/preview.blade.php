@extends('layouts.backend')

@section('title', $data['title'])

@section('content')

 <!-- start page title -->
 <div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Content</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                <li class="breadcrumb-item active">Content</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
                <a href="{{ route('content.create',['category_content_id' => Request::segment(3) ]) }}" class="btn btn-primary dropdown-toggle waves-effect waves-light">
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
            
                <h4 class="card-title">Data Content</h4>
               
               
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Cover</th>
                      <th>Judul</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($data['category'] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                           
                            <img src="{{ asset($item->cover) }}" alt="" class="img-thumbnail" style="width:120px;height:auto;">
                           
                        </td>
                        <td>{{ $item->title }}</td>
                        
                        <td>
                          
                            <a href="{{ route('content.edit', ['category_content_id' => Request::segment(3) ,'id' => $item['id'] ]) }}" class="btn icon-btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Klik untuk edit content">
                                <i class="ion ion-md-create"></i>
                            </a>
                            @if(Request::segment(3) == 4)

                            @else
                            <a href="{{ route('content.destroy', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-danger delete" onclick="return confirm('Anda Yakin ?')" data-toggle="tooltip" data-original-title="Klik untuk delete content"><i class="ion ion-md-trash"></i>
                            @endif 
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