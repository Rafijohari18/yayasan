@extends('layouts.backend')

@section('title', 'Playlist - '.$data['title'])

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Module / Playlist /</span> {{ $data['title'] }} <span class="text-muted">{{ (isset($data['album'])) ? '#'.$data['album']['id'] : '' }}</span>
    </h4>

    <a href="{{ route('gallery.playlist.index') }}" class="btn btn-sm btn-secondary"><i class="ion ion-ios-arrow-back"></i> Back</a><br><br>

    <form action="{{ (isset($data['album'])) ? route('gallery.playlist.update', ['id' => $data['album']['id']]) : route('gallery.playlist.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($data['album']))
        @method('PUT')
        @endif
    
        <div class="nav-tabs-top">
          <ul class="nav nav-tabs">
            
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#def">Default</a>
              </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="def">
      
              <div class="card-body pb-2">
                <div class="form-group row">
                  <label class="col-form-label col-sm-2 text-sm-left">Name</strong></label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control @error('name_def') is-invalid @enderror" name="name_def" value="{!! (isset($data['album']))?old('name_def',$data['album']->name):old('name_def') !!}" placeholder="Enter name...">
                  @error('name_def')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-left">Description</strong></label>
                    <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="description_def" placeholder="Enter description...">{!! (isset($data['album']))?old('description_def',$data['album']->description):old('description_def') !!}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-left">Banner</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                        <input type="file" class="form-control" id="image1" aria-label="Image" aria-describedby="button-image" placeholder="No File Selected" name="banner_img" value="{{ isset($data['album']) ? old('banner_img', $data['album']['banner']['banner_img']) : old('banner_img') }}">
                        @if(isset($data['album']))
                        <input type="hidden" name="cover_lama" value="{{  $data['album']['banner'] }}">
                        @endif
                        </div>
                        
                        
                    </div>
                  </div>
              </div>
      
            </div>
      
          
          </div>
        </div>
      
        <div class="text-right mt-3">
          <button type="submit" class="btn btn-primary">{{ (isset($data['album'])) ? 'Save changes' : 'Save' }}</button>&nbsp;
          <button type="button" class="btn btn-default">Cancel</button>
        </div>
    </form>

</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('jsbody')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

{{-- Filemanager --}}

@endsection