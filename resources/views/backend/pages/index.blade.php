@extends('layouts.backend')

@section('title', $data['title'])

@section('content')

 <!-- start page title -->
 <div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Pages</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                <li class="breadcrumb-item active">Pages</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
                <a href="{{ route('pages.create', 'parent=0') }}" class="btn btn-primary dropdown-toggle waves-effect waves-light">
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
            
                <h4 class="card-title">Data Pages</h4>
               
               
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Dibuat Oleh</th>
                      <th>Posisi</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($data['pages'] as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{!! Str::limit($item->getFieldLang()->title, 80) !!}</td>
                    
                      <td>{{ $item->userCreated['name'] }}</td>
                      <td>
                      @php
                        $min = $item->where('parent', $item['parent'])->min('position');
                        $max = $item->where('parent', $item['parent'])->max('position');
                        @endphp
                        @if ($min != $item['position'])
                        <a href="javascript:void(0);" onclick="$(this).find('form').submit();" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to up position">
                            <i class="ion ion-md-arrow-round-up"></i>
                            <form action="{{ route('pages.position', ['id' => $item['id'], 'position' => ($item['position'] - 1), 'parent' => $item['parent']]) }}" method="POST">
                                @csrf
                                @method('PUT')                                            
                            </form>
                        </a>
                        @else
                        <button type="button" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to up position" disabled><i class="ion ion-md-arrow-round-up"></i></button>
                        @endif
                        @if ($max != $item['position'])
                        <a href="javascript:void(0);" onclick="$(this).find('form').submit();" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to down position">
                            <i class="ion ion-md-arrow-round-down"></i>
                            <form action="{{ route('pages.position', ['id' => $item['id'], 'position' => ($item['position'] + 1), 'parent' => $item['parent']]) }}" method="POST">
                                @csrf
                                @method('PUT')                                            
                            </form>
                        </a>
                        @else
                        <button type="button" class="btn icon-btn btn-sm btn-secondary" data-toggle="tooltip" data-original-title="click to down position" disabled><i class="ion ion-md-arrow-round-down"></i></button>
                        @endif
                      
                        </td>
                        <td>
                    
                                <a href="{{ route('pages.create', 'parent='.$item['id']) }}" class="btn icon-btn btn-sm btn-success" data-toggle="tooltip" data-original-title="click to add child pages">
                                    <i class="fas fa-plus"></i>
                                </a>
                              
                                <a href="{{ route('pages.media', ['pageId' => $item['id']]) }}" class="btn icon-btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="click to view media">
                                    <i class="fas fa-play-circle"></i>
                                </a>
                              
                                <a href="{{ route('pages.edit', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-info" data-toggle="tooltip" data-original-title="click to edit pages">
                                    <i class="ion ion-md-create"></i>
                                </a>
                              
                                <a href="{{ route('pages.destroy', ['id' => $item['id']]) }}" class="btn icon-btn btn-sm btn-danger delete" onclick="return confirm('Anda Yakin ?')" data-toggle="tooltip" data-original-title="click to delete pages"><i class="ion ion-md-trash"></i>
                                    
                                </a>
                   
                        </td>
                    </tr>
                    @if (count($item->childs))
                      @include('backend.pages.tree', ['childs' => $item->childs])
                    @endif
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