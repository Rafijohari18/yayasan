@extends('layouts.backend')

@section('title', $data['title'])

@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Content  /</span> Edit <span class="text-muted"></span>
    </h4>

    <div class="card mb-4">
      <h6 class="card-header">
        <i class="fas fa-{{ $data['type'] == 'create' ? 'plus' : 'edit' }}"></i> {{ $data['type'] == 'create' ? 'Tambah Konten' : 'Edit Konten' }} 
      </h6>
      <div class="card-body">
        <form enctype="multipart/form-data" action="{{ $data['type'] == 'create' ? route('content.store') : route('content.update', ['id' => $data['content']['id']]) }}" method="POST">
            @csrf
            @if ($data['type'] == 'edit')
            @method('PUT')
            @endif
          
          <input type="hidden" name="category_content_id" value="{{ Request::segment('4') }}">
          <input type="hidden" name="category_content_edit" value="{{ Request::segment('3') }}">
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $data['type'] == 'create' ? old('title') : old('title', $data['content']['title']) }}" placeholder="enter title...">
              @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Slug</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ $data['type'] == 'create' ? old('slug') : old('slug', $data['content']['slug']) }}" placeholder="enter slug...">
              @error('slug')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Cover</label>
            <div class="col-sm-10">
              <input type="file" class="form-control filestyle @error('cover') is-invalid @enderror" id="cover" name="cover" value="{{ $data['type'] == 'create' ? old('cover') : old('cover', $data['content']['cover']) }}" placeholder="enter cover...">
              @if( $data['type'] != 'create')
              <input type="hidden" name="cover_lama" value="{{ $data['content']['cover'] }}">
              @endif
              @error('cover')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

       

          <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control summernote" name="content">{!! $data['type'] == 'create' ? old('content') : old('content', $data['content']['content']) !!}</textarea>
                </div>
            </div>

          <div class="form-group row">
            <div class="col-sm-10 ml-sm-auto">
              <button type="submit" class="btn btn-primary">{{ $data['type'] == 'create' ? 'Simpan' : 'Simpan Perubahan' }}</button>
              
            </div>
          </div>
        </form>
      </div>
    </div>

</div>
<!-- / Content -->
@endsection

@section('jsfoot')
<script>
   $('#title').bind("change keyup",function(){
        $("#slug").val($(this).val().toLowerCase().replace(/\s+/g, "-").replace(/\/+/g, "-"));
    });
</script>   
<script src="{{ asset('asset/temp_backend/libs/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-editor.init.js')}}"></script>
  
 
<script src="{{ asset('asset/temp_backend/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-advanced.init.js')}}"></script>
@endsection
