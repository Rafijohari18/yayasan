@extends('layouts.backend')

@section('title', $data['title'])
@section('css')
<link rel="stylesheet" href="{{ asset('asset/temp_backend/css/file-manager.css')}}">

@endsection
@section('content')

<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Module / Page / </span>{{ $data['title'] }} <span class="text-muted">{{ isset($data['page']) ? '#'.$data['page']['id'] : '' }}</span>
    </h4>

    <a href="{{ route('pages.index') }}" class="btn btn-sm btn-secondary"><i class="ion ion-ios-arrow-back"></i> Back</a><br><br>

    <!-- Filters -->
    <div class="ui-bordered px-4 pt-4 mb-4">
        <form enctype="multipart/form-data" action="{{ route('pages.media.store', ['pageId' => $data['page']['id']]) }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-5">
                    <div class="input-group">
                        <input type="file" class="filestyle form-control @error('file') is-invalid @enderror"  placeholder="No File Selected" name="file" value="{{ old('file') }}">
                        
                        @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-danger small mt-1">Allowed : <strong>JPG, JPEG, PNG, SVG, MP4, 3GP, MKV, PDF, DOC, DOCX, XLS, PPTX</strong></div>
                   
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" placeholder="Judul" name="title" value="{{ old('title') }}" required>
                </div>
                
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
    <!-- / Filters -->
      
    <!-- list -->
    <div class="container-m-nx container-m-ny bg-lightest mb-3">

        <ol class="breadcrumb text-big container-p-x py-3 m-0">
            
        </ol>

        <hr class="m-0">

        <div class="file-manager-actions container-p-x py-2">
          <div>
            
          </div>
          <div>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-default icon-btn md-btn-flat active">
                <input type="radio" name="file-manager-view" value="file-manager-col-view" checked> <span class="ion ion-md-apps"></span>
              </label>
              <label class="btn btn-default icon-btn md-btn-flat">
                <input type="radio" name="file-manager-view" value="file-manager-row-view"> <span class="ion ion-md-menu"></span>
              </label>
            </div>
          </div>
        </div>

        <hr class="m-0">
    </div>
    <div class="file-manager-container file-manager-col-view">

        <div class="file-manager-row-header">
            <div class="file-item-name pb-2">Filename</div>
            {{-- <div class="file-item-changed pb-2">Action</div> --}}
        </div>
        <div class="row drag">
            @foreach ($data['media'] as $item)
            <div class="file-item">
                <div class="file-item-icon file-item-level-up fas fa-level-up-alt text-secondary"></div>
                <a href="javascript:void(0)" class="file-item-name">
                  ..
                </a>
              </div>

              <div class="file-item">
                <div class="file-item-select-bg bg-primary"></div>
                <label class="file-item-checkbox custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input">
                  <span class="custom-control-label"></span>
                </label>
                <div class="file-item-icon far fa-folder text-secondary"></div>
                <a href="javascript:void(0)" class="file-item-name">
                  {{ $item->title }}
                </a>
                <div class="file-item-changed"></div>
                <div class="file-item-actions btn-group">
                  <button type="button" class="btn btn-default btn-sm rounded-pill icon-btn borderless md-btn-flat hide-arrow dropdown-toggle" data-toggle="dropdown"><i class="ion ion-ios-more"></i></button>
                  <div class="dropdown-menu dropdown-menu-right">
                  
                    <a class="dropdown-item delete" href="{{ route('pages.media.destroy', ['id' => $item['id']]) }}" onclick="return confirm('Anda Yakin ?')"  data-toggle="tooltip" data-original-title="click to delete">
                        <i class="ion ion-md-trash text-danger"></i> Hapus
                        
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    </div>

    {{-- pagination --}}
    {{ $data['media']->links() }}

</div>

@endsection

@section('jsfoot')

  
 
<script src="{{ asset('asset/temp_backend/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-advanced.init.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/pages_file-manager.js')}}"></script>

@endsection
