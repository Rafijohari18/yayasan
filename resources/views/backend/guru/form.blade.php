@extends('layouts.backend')

@section('title', $data['title'])

@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Dosen  /</span> Edit <span class="text-muted"></span>
    </h4>

    <div class="card mb-4">
      <h6 class="card-header">
        <i class="fas fa-{{ $data['type'] == 'create' ? 'plus' : 'edit' }}"></i> {{ $data['type'] == 'create' ? 'Tambah Dosen' : 'Edit Dosen' }} 
      </h6>
      <div class="card-body">
        <form enctype="multipart/form-data" action="{{ $data['type'] == 'create' ? route('dosen.store') : route('dosen.update', ['id' => $data['dosen']['id']] ) }}" method="POST">
            @csrf
            @if ($data['type'] == 'edit')
            @method('PUT')
            @endif
          
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">NIP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ $data['type'] == 'create' ? old('nip') : old('nip', $data['dosen']['nip']) }}" placeholder="enter nip...">
              @error('nip')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">NIDN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ $data['type'] == 'create' ? old('nidn') : old('nidn', $data['dosen']['nidn']) }}" placeholder="enter nidn...">
              @error('nidn')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $data['type'] == 'create' ? old('nama') : old('nama', $data['dosen']['nama']) }}" placeholder="enter nama...">
              @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Foto</label>
            <div class="col-sm-10">
              <input type="file" class="form-control filestyle @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{ $data['type'] == 'create' ? old('foto') : old('foto', $data['dosen']['foto']) }}" placeholder="enter foto...">
              @if( $data['type'] != 'create')
              <input type="hidden" name="image_lama" value="{{ $data['dosen']['foto'] }}">
              @endif
              @error('cover')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tipe Pegawai</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tipe_pegawai') is-invalid @enderror" id="tipe_pegawai" name="tipe_pegawai" value="{{ $data['type'] == 'create' ? old('tipe_pegawai') : old('tipe_pegawai', $data['dosen']['tipe_pegawai']) }}" placeholder="enter tipe_pegawai...">
              @error('tipe_pegawai')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">No Kartu</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('no_kartu') is-invalid @enderror" id="no_kartu" name="no_kartu" value="{{ $data['type'] == 'create' ? old('no_kartu') : old('no_kartu', $data['dosen']['no_kartu']) }}" placeholder="enter no_kartu...">
              @error('no_kartu')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">No WA</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" value="{{ $data['type'] == 'create' ? old('no_wa') : old('no_wa', $data['dosen']['no_wa']) }}" placeholder="enter no_wa...">
              @error('no_wa')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

        

         


          <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control summernote" name="alamat">{!! $data['type'] == 'create' ? old('alamat') : old('alamat', $data['dosen']['alamat']) !!}</textarea>
                </div>
            </div>


            <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tempat Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $data['type'] == 'create' ? old('tempat_lahir') : old('tempat_lahir', $data['dosen']['tempat_lahir']) }}" placeholder="enter tempat_lahir...">
              @error('tempat_lahir')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ $data['type'] == 'create' ? old('tanggal_lahir') : old('tanggal_lahir', $data['dosen']['tanggal_lahir']) }}" placeholder="enter tanggal_lahir...">
              @error('tanggal_lahir')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Jenis Kelamin</label>
            <div class="col-sm-10">
            <select class="form-control selectpicker show-tick @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" data-style="btn-default">      
                    
                <option value="L" {{ $data['type'] == 'create' ? old('jenis_kelamin')   : old('jenis_kelamin', $data['dosen']['jenis_kelamin']) == "L" ? 'selected' : '' }}> Laki-Laki</option>
                <option value="P" {{ $data['type'] == 'create' ? old('jenis_kelamin')   : old('jenis_kelamin', $data['dosen']['jenis_kelamin']) == "P" ? 'selected' : '' }}> Perempuan</option>
            </select>  
                    
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Agama</label>
            <div class="col-sm-10">
            <select class="form-control selectpicker show-tick @error('agama') is-invalid @enderror" name="agama" data-style="btn-default">      
                <option value="Islam" {{ $data['type'] == 'create' ? old('agama')   : old('agama', $data['dosen']['agama']) == "Islam" ? 'selected' : '' }}> Islam</option>
                <option value="Kristen" {{ $data['type'] == 'create' ? old('agama')   : old('agama', $data['dosen']['agama']) == "Kristen" ? 'selected' : '' }}> Kristen</option>
                <option value="Katolik" {{ $data['type'] == 'create' ? old('agama')   : old('agama', $data['dosen']['agama']) == "Katolik" ? 'selected' : '' }}> Katolik</option>
                <option value="Hindu" {{ $data['type'] == 'create' ? old('agama')   : old('agama', $data['dosen']['agama']) == "Hindu" ? 'selected' : '' }}> Hindu</option>
                <option value="Buddha" {{ $data['type'] == 'create' ? old('agama')   : old('agama', $data['dosen']['agama']) == "Buddha" ? 'selected' : '' }}> Buddha</option>
                <option value="Konghucu" {{ $data['type'] == 'create' ? old('agama')   : old('agama', $data['dosen']['agama']) == "Konghucu" ? 'selected' : '' }}> Konghucu</option>
            </select>  
                    
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Status Nikah</label>
            <div class="col-sm-10">
            <select class="form-control selectpicker show-tick @error('status_nikah') is-invalid @enderror" name="status_nikah" data-style="btn-default">
                <option value="SM" {{ $data['type'] == 'create' ? old('status_nikah')   : old('status_nikah', $data['dosen']['status_nikah']) == "SM" ? 'selected' : '' }}> Sudah Menikah</option>
                <option value="BM" {{ $data['type'] == 'create' ? old('status_nikah')   : old('status_nikah', $data['dosen']['status_nikah']) == "BM" ? 'selected' : '' }}> Belum Menikah</option>
            </select>  
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

 
<script src="{{ asset('asset/temp_backend/js/admin.js') }}"></script>

<script src="{{ asset('asset/temp_backend/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-advanced.init.js')}}"></script>


<script src="{{ asset('asset/temp_backend/libs/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-editor.init.js')}}"></script>
@endsection
