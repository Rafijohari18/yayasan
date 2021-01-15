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
        <i class="fas fa-{{ $data['type'] == 'create' ? 'plus' : 'edit' }}"></i> {{ $data['type'] == 'create' ? 'Tambah Produk' : 'Edit Produk' }} 
      </h6>
      <div class="card-body">
        <form enctype="multipart/form-data" action="{{ $data['type'] == 'create' ? route('product.store') : route('product.update', ['id' => $data['content']['id']]) }}" method="POST">
            @csrf
            @if ($data['type'] == 'edit')
            @method('PUT')
            @endif
          
          <input type="hidden" name="category_product_id" value="{{ Request::segment('4') }}">
          <input type="hidden" name="category_product_edit" value="{{ Request::segment('3') }}">
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Kode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ $data['type'] == 'create' ? old('kode') : old('kode', $data['content']['kode']) }}" placeholder="enter kode...">
              @error('kode')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Keterangan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ $data['type'] == 'create' ? old('keterangan') : old('keterangan', $data['content']['keterangan']) }}" placeholder="enter keterangan...">
              @error('keterangan')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>



          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Status</label>
            <div class="col-sm-10">
                <select class="form-control selectpicker show-tick @error('status') is-invalid @enderror" id="level" name="status" data-style="btn-default">
                    <option value="">Select Status</option>
                    <option value="open" {{ $data['type'] == 'create' ? old('status') == "open" ? 'selected' : ''  : old('status', $data['content']['status']) == "open" ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ $data['type'] == 'create' ? old('status') == "closed" ? 'selected' : ''  : old('status', $data['content']['status']) == "closed" ? 'selected' : '' }}>Closed</option>
                </select>  
                @error('level')
                <div style="color:red;">{{ $message }}</div>
                @enderror
              </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Harga</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $data['type'] == 'create' ? old('harga') : old('harga', $data['content']['harga']) }}" placeholder="enter harga...">
              @error('harga')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
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

</script>   
<script src="{{ asset('asset/temp_backend/libs/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-editor.init.js')}}"></script>
  
 
<script src="{{ asset('asset/temp_backend/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-advanced.init.js')}}"></script>
@endsection
