@extends('layouts.backend')

@section('title', $data['title'])

@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Siswa  /</span> Edit <span class="text-muted"></span>
    </h4>

    <div class="card mb-4">
      <h6 class="card-header">
        <i class="fas fa-plus"></i> Edit Siswa 
      </h6>
      <div class="card-body">
      
      <form enctype="multipart/form-data" action="{{ route('siswa.update', ['id' => $data['siswa']['id']]) }}" method="POST">
            @csrf
            @method('PUT')
          
            
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">No Induk</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('no_induk') is-invalid @enderror" value="{{ $data['siswa']['no_induk'] }}" id="no_induk" name="no_induk" required>
             
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">NISN</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nisn') is-invalid @enderror" value="{{ $data['siswa']['nisn'] }}" id="nisn" name="nisn" required>
             
            </div>
          </div>
        
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $data['siswa']['nama'] }}" id="nama" name="nama" required>
             
            </div>
          </div>

          
          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Jenis Kelamin</label>
            <div class="col-sm-10">
            <select required class="form-control selectpicker show-tick @error('jk') is-invalid @enderror" name="jk" data-style="btn-default">      
                <option value="L" {{  $data['siswa']['jk'] == "L" ? 'selected' : '' }}> Laki-Laki</option>
                <option value="P" {{  $data['siswa']['jk'] == "P" ? 'selected' : '' }}> Perempuan</option>
            </select>  
                    
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Foto</label>
            <div class="col-sm-10">
              <input type="file" class="form-control filestyle @error('foto') is-invalid @enderror" id="foto" name="foto">
              <input type="hidden" name="foto_dulu" value="{{ $data['siswa']['foto'] }}">
              
            </div>
          </div>



          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tempat Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ $data['siswa']['tempat_lahir'] }}" required id="tempat_lahir" name="tempat_lahir">
             
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" required id="tgl_lahir" value="{{ $data['siswa']['tgl_lahir'] }}" name="tgl_lahir">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Umur</label>
            <div class="col-sm-10">
              <input type="text" value="{{ $data['siswa']['umur'] }}" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" required>
             
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Agama</label>
            <div class="col-sm-10">
            <select required class="form-control selectpicker show-tick @error('agama') is-invalid @enderror" name="agama" data-style="btn-default">      
            <option value="Islam" {{  $data['siswa']['agama'] == "Islam" ? 'selected' : '' }}> Islam</option>
                <option value="Kristen" {{  $data['siswa']['agama'] == "Kristen" ? 'selected' : '' }}> Kristen</option>
                <option value="Katolik" {{  $data['siswa']['agama'] == "Katolik" ? 'selected' : '' }}> Katolik</option>
                <option value="Hindu" {{  $data['siswa']['agama'] == "Hindu" ? 'selected' : '' }}> Hindu</option>
                <option value="Buddha" {{  $data['siswa']['agama'] == "Buddha" ? 'selected' : '' }}> Buddha</option>
                <option value="Konghucu" {{  $data['siswa']['agama'] == "Konghucu" ? 'selected' : '' }}> Konghucu</option>
            </select>  
                    
            </div>
          </div>

         <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat">{{ $data['siswa']['alamat'] }}</textarea>
                </div>
         </div> 


         <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Nama Ortu</label>
            <div class="col-sm-10">
              <input type="text"  value="{{ $data['siswa']['nama_ortu'] }}" class="form-control @error('nama_ortu') is-invalid @enderror" id="nama_ortu" name="nama_ortu" required>
             
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Pendidikan Ortu</label>
            <div class="col-sm-10">
            <select required class="form-control selectpicker show-tick @error('pendidikan_ortu') is-invalid @enderror" name="pendidikan_ortu" data-style="btn-default">      
                <option value="SMP" {{  $data['siswa']['pendidikan_ortu'] == "SMP" ? 'selected' : '' }}> SMP</option>
                <option value="SMA" {{  $data['siswa']['pendidikan_ortu'] == "SMA" ? 'selected' : '' }}> SMA / Sederajat</option>
                <option value="D3" {{  $data['siswa']['pendidikan_ortu'] == "D4" ? 'selected' : '' }}> D3</option>
                <option value="D4" {{  $data['siswa']['pendidikan_ortu'] == "D4" ? 'selected' : '' }}> D4</option>
                <option value="S1" {{  $data['siswa']['pendidikan_ortu'] == "S1" ? 'selected' : '' }}> S1</option>
                <option value="S2" {{  $data['siswa']['pendidikan_ortu'] == "S2" ? 'selected' : '' }}> S2</option>
                <option value="S3" {{  $data['siswa']['pendidikan_ortu'] == "S3" ? 'selected' : '' }}> S3</option>
            </select>  
                    
            </div>
          </div>


          <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Alamat Ortu</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat_ortu" required>{{ $data['siswa']['alamat_ortu'] }}</textarea>
                </div>
         </div> 


         <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Keterangan</label>
                <div class="col-sm-10">
                    <textarea class="form-control summernote" name="keterangan">{{ $data['siswa']['keterangan'] }}</textarea>
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
