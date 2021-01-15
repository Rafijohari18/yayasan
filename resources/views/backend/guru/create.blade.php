@extends('layouts.backend')

@section('title', $data['title'])

@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Guru  /</span> Tambah <span class="text-muted"></span>
    </h4>

    <div class="card mb-4">
      <h6 class="card-header">
        <i class="fas fa-plus"></i> Tambah Guru 
      </h6>
      <div class="card-body">
        <form enctype="multipart/form-data" action="{{ route('guru.store') }}" method="POST">
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
            <label class="col-form-label col-sm-2 text-sm-left">Tempat Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" required id="tempat_lahir" name="tempat_lahir">
             
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" required id="tgl_lahir" name="tgl_lahir">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Pendidikan</label>
            <div class="col-sm-10">
            <select required class="form-control selectpicker show-tick @error('pendidikan') is-invalid @enderror" name="pendidikan" data-style="btn-default">      
                <option value="SMP"> SMP</option>
                <option value="SMA"> SMA / Sederajat</option>
                <option value="D3"> D3</option>
                <option value="D4"> D4</option>
                <option value="S1"> S1</option>
                <option value="S2"> S2</option>
                <option value="S3"> S3</option>
            </select>  
                    
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Jenis Kelamin</label>
            <div class="col-sm-10">
            <select required class="form-control selectpicker show-tick @error('jk') is-invalid @enderror" name="jk" data-style="btn-default">      
                <option value="L"> Laki-Laki</option>
                <option value="P"> Perempuan</option>
            </select>  
                    
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Agama</label>
            <div class="col-sm-10">
            <select required class="form-control selectpicker show-tick @error('agama') is-invalid @enderror" name="agama" data-style="btn-default">      
                <option value="Islam"> Islam</option>
                <option value="Kristen"> Kristen</option>
                <option value="Katolik"> Katolik</option>
                <option value="Hindu"> Hindu</option>
                <option value="Buddha"> Buddha</option>
                <option value="Konghucu"> Konghucu</option>
            </select>  
                    
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Pelatihan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('pelatihan') is-invalid @enderror" id="pelatihan" name="pelatihan[]">
              <input type="text" class="form-control @error('pelatihan') is-invalid @enderror" id="pelatihan" name="pelatihan[]">
              <input type="text" class="form-control @error('pelatihan') is-invalid @enderror" id="pelatihan" name="pelatihan[]">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Prestasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('prestasi') is-invalid @enderror" id="prestasi" name="prestasi[]">
              <input type="text" class="form-control @error('prestasi') is-invalid @enderror" id="prestasi" name="prestasi[]">
              <input type="text" class="form-control @error('prestasi') is-invalid @enderror" id="prestasi" name="prestasi[]">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Penghargaan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control @error('penghargaan') is-invalid @enderror" id="penghargaan" name="penghargaan[]">
              <input type="text" class="form-control @error('penghargaan') is-invalid @enderror" id="penghargaan" name="penghargaan[]">
              <input type="text" class="form-control @error('penghargaan') is-invalid @enderror" id="penghargaan" name="penghargaan[]">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Jabatan</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
             
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">Tahun Masuk</label>
            <div class="col-sm-10">
              <input type="date" required class="form-control @error('thn_masuk') is-invalid @enderror" id="thn_masuk" name="thn_masuk">
            </div>
          </div>

          <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-left">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control summernote" name="alamat"></textarea>
                </div>
         </div> 

          <div class="form-group row">
            <label class="col-form-label col-sm-2 text-sm-left">TMT</label>
            <div class="col-sm-10">
              <input type="date" required class="form-control @error('tmt') is-invalid @enderror" id="tmt" name="tmt">
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
