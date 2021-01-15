@extends('layouts.backend')

@section('title', $data['title'])

@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Profil Alumni  /</span> Tambah <span class="text-muted"></span>
    </h4>

    <div class="card mb-4">
      <h6 class="card-header">
        <i class="fas fa-plus"></i> Tambah Profil Alumni 
      </h6>
      <div class="card-body">
        <form enctype="multipart/form-data" action="{{ route('profil.alumni.store') }}" method="POST">
            @csrf
            

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required>
             
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Foto</label>
            <div class="col-sm-10">
              <input type="file" class="form-control filestyle @error('foto') is-invalid @enderror" id="foto" name="foto">
              
            </div>
          </div>



          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Pekerjaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" required id="pekerjaan" name="pekerjaan">
             
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Angkatan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('angkatan') is-invalid @enderror" required id="angkatan" name="angkatan">
            </div>
          </div>



         <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" required></textarea>
                </div>
         </div> 



         <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Moto Hidup</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('moto_hidup') is-invalid @enderror" required id="moto_hidup" name="moto_hidup">
            </div>
          </div>


      

         <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Pesan dan Kesan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="pesan_kesan" required></textarea>
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
