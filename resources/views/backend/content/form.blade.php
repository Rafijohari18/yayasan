@extends('layouts.backend')

@section('title', $data['title'])

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Kategori Konten / {{ ucfirst(Request::segment(2)) }} /</span> {{ $data['title'] }} <span class="text-muted"></span>
    </h4>

    <div class="card mb-4">
      <h6 class="card-header">
        <i class="fas fa-{{ $data['type'] == 'create' ? 'plus' : 'edit' }}"></i> {{ $data['type'] == 'create' ? 'Tambah Kategori Konten' : 'Edit Kategori Konten' }} 
      </h6>
      <div class="card-body">
        <form action="{{ $data['type'] == 'create' ? route('category.content.store') : route('category.content.update', ['id' => $data['content']['id']]) }}" method="POST">
            @csrf
            @if ($data['type'] == 'edit')
            @method('PUT')
            @endif
          
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $data['type'] == 'create' ? old('name') : old('name', $data['content']['name']) }}" placeholder="enter name...">
              @error('name')
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
  $('#name').bind("change keyup",function(){
        $("#slug").val($(this).val().toLowerCase().replace(/\s+/g, "-").replace(/\/+/g, "-"));
    });


</script>
@endsection
