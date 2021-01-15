@extends('layouts.backend')

@section('title', $data['title'])

@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Alumni  /</span> Edit <span class="text-muted"></span>
    </h4>

    <div class="card mb-4">
      <h6 class="card-header">
        <i class="fas fa-plus"></i> Edit Alumni 
      </h6>
      <div class="card-body">
      
      <form enctype="multipart/form-data" action="{{ route('alumni.update', ['id' => $data['alumni']['id']]) }}" method="POST">
            @csrf
            @method('PUT')
          
            
      
        
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $data['alumni']['nama'] }}" id="nama" name="nama" required>
             
            </div>
          </div>

          
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Jenis Kelamin</label>
            <div class="col-sm-10">
            <select required class="form-control selectpicker show-tick @error('jk') is-invalid @enderror" name="jk" data-style="btn-default">      
                <option value="L" {{  $data['alumni']['jk'] == "L" ? 'selected' : '' }}> Laki-Laki</option>
                <option value="P" {{  $data['alumni']['jk'] == "P" ? 'selected' : '' }}> Perempuan</option>
            </select>  
                    
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Foto</label>
            <div class="col-sm-10">
              <input type="file" class="form-control filestyle @error('foto') is-invalid @enderror" id="foto" name="foto">
              <input type="hidden" name="foto_dulu" value="{{ $data['alumni']['foto'] }}">
              
            </div>
          </div>



          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tempat Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ $data['alumni']['tempat_lahir'] }}" required id="tempat_lahir" name="tempat_lahir">
             
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" required id="tgl_lahir" value="{{ $data['alumni']['tgl_lahir'] }}" name="tgl_lahir">
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">No Handphone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $data['alumni']['no_hp'] }}" id="no_hp" name="no_hp" required>
             
            </div>
          </div>


        
         <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat">{{ $data['alumni']['alamat'] }}</textarea>
                </div>
         </div> 


         <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Masuk Tahun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('masuk_tahun') is-invalid @enderror" value="{{ $data['alumni']['masuk_tahun'] }}" id="masuk_tahun" name="masuk_tahun" required>
             
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tamat Tahun</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tamat_tahun') is-invalid @enderror" value="{{ $data['alumni']['tamat_tahun'] }}" id="tamat_tahun" name="tamat_tahun" required>
             
            </div>
          </div>


         <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tingkat Sekolah / Pekerjaan Saat Ini</label>
            <div class="col-sm-10">
              <input type="text"  value="{{ $data['alumni']['sekolah_ke'] }}" class="form-control @error('sekolah_ke') is-invalid @enderror" id="sekolah_ke" name="sekolah_ke" required>
             
            </div>
          </div>





   
        
      



       

          <div class="form-group row">
            <div class="col-sm-10 ml-sm-auto">
              <button type="submit" class="btn btn-primary">Simpan</button>
              
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
