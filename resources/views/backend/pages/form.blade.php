@extends('layouts.backend')

@section('title', $data['title'])
@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Data Master / Pages /</span> {{ $data['title'] }} <span class="text-muted">{{  isset($data['page']) ? '#'.$data['page']['id'] : '' }}</span>
    </h4>

    <div class="card mb-4">
      
      <div class="card-body">
        <form action="{{ isset($data['page']) ? route('pages.update', ['id' => $data['page']['id']]) : route('pages.store', 'parent='.request()->get('parent')) }}" method="POST">
            @csrf
            @if (isset($data['page']))
            @method('PUT')
            @endif

            @if (isset($data['page']))
              <input type="hidden" name="id_def" value="{{ $data['page']->getFieldLang()->id }}">
            @endif

          <div class="form-group row">
            <label class="col-form-label col-sm-1 text-sm-left">Judul</label>
            <div class="col-sm-10">
              <input type="text" class="form-control gen_slug @error('title_def') is-invalid @enderror" lang="id" name="title_def" value="{!! isset($data['page'])?old('title_def',$data['page']->getFieldLang()->title):old('title_def') !!}">
              @error('title_def')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>


          <div class="form-group row">
                <label class="col-form-label col-sm-1 text-sm-left">Slug</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control slug_spot @error('slug') is-invalid @enderror" lang="id" name="slug" maxlength="50" value="{{ isset($data['page']) ? old('slug', $data['page']['slug']) : old('slug') }}" placeholder="slug...">
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-sm-1 text-sm-left">Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control summernote" name="content_def">{!! isset($data['page']) ? old('content_def', $data['page']->getFieldLang()->content) : old('content_def') !!}</textarea>
                </div>
            </div>

          <div class="form-group row">
            <div class="col-sm-10 ml-sm-auto">
              <button type="submit" class="btn btn-primary">{{ isset($data['page']) ? 'Save changes' : 'Save'  }}</button>
              <a href="{{ route('pages.index') }}" class="btn btn-default">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>

</div>
<!-- / Content -->
@endsection

@section('jsfoot')
    <script src="{{ asset('asset/temp_backend/js/admin.js') }}"></script>

    <script src="{{ asset('asset/temp_backend/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ asset('asset/temp_backend/js/pages/form-editor.init.js')}}"></script>

@endsection
