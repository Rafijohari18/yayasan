@extends('layouts.backend')

@section('title', $data['title'])


@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('asset/temp_backend/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
<link href="{{ asset('asset/temp_backend/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />

@endsection

@section('content')
<!-- Content -->
<div class="container-fluid  container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Pengaturan / </span>{{ $data['title'] }}
    </h4>

    <div class="card">
      <h6 class="card-header">
        <i class="fas fa-edit"></i> Form Pengaturan
      </h6>
      <div class="card-body">
        <hr class="border-light m-0">
        <br>

         <div class="nav-tabs-top">
          <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#web">Web Config</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#sosmed">Sosial Media</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#logo">Logo Web</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#background">Background Web</a>
              </li>

              
            </ul>
            
            <div class="tab-content">

            <div class="tab-pane fade show active" id="web">
                <div class="card">
                    <div class="card-body">
                      <form action="{{ route('update.config') }}" method="POST" id="form_all">
                      @csrf
                      @method('PUT')
                        @foreach($data['web'] as $web)
      
                          <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-left">{{ $web['lable'] }} </label>
                            <div class="col-sm-10">
                              @if($web['id'] != 9)
                              <textarea type="text" class="form-control" name="name[{{ $web['name'] }}]"  placeholder="enter value...">{{ old($web['name'], $web['value']) }}</textarea>
                              @else 
                              <div class="input-group colorpicker-default" title="Using format option">
                                <input type="text" class="form-control input-lg" name="name[{{ $web['name'] }}]" value="{{ old($web['name'], $web['value']) }}"/>
                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                              </div>
                              @endif
                            </div>
                          </div>
                        @endforeach

                      

                          <div class="form-group row mt-2">
                          <div class="col-sm-10 ml-sm-auto">
                            <button id="btn-sub" type="submit" class="btn btn-primary pull-right">Simpan </button>
                          </div>
                        </div>
                        </form>


                    </div>
                </div>
            </div>



            <div class="tab-pane fade" id="sosmed"            >
                <div class="card">
                    <div class="card-body">
                     <form action="{{ route('update.config') }}" method="POST" id="form_sosmed">
                      @csrf
                      @method('PUT')
                        @foreach($data['sosmed'] as $sosmed)

                          <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-left">{{ $sosmed['lable'] }} </label>
                            <div class="col-sm-10">
                              <textarea type="text" class="form-control" name="name[{{ $sosmed['name'] }}]" placeholder="enter value...">{{ old($sosmed['name'], $sosmed['value']) }}</textarea>
                            </div>
                          </div>
                        @endforeach

                          <div class="form-group row mt-2">
                          <div class="col-sm-10 ml-sm-auto">
                            <button id="btn-sosmed" type="submit" class="btn btn-primary pull-right">Simpan </button>
                          </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="logo">
                <div class="card">
                    <div class="card-body">
                     <form action="{{ route('update.config.logo') }}" method="POST" enctype="multipart/form-data" id="form_background">
                      @csrf
                      @method('PUT')
                        @foreach($data['logo'] as $web)

                          <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-left">{{ $web['lable'] }} </label>
                            
                            <div class="col-sm-10">
                            <img src="{{ asset($web['value']) }}" alt="IMAGES" class="mb-4" style="width:250px;height:auto;" id="previewimg">

                            
                            <input type="file" class="form-control filestyle file" name="logo" >

                            <input type="hidden" name="logo_lama" value="{{ $web['value'] }}">
                              
                            </div>
                          </div>
                        @endforeach

                          <div class="form-group row mt-2">
                          <div class="col-sm-10 ml-sm-auto">
                            <button id="btn-background" type="submit" class="btn btn-primary pull-right">Simpan </button>
                          </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="background">
                <div class="card">
                    <div class="card-body">
                     <form action="{{ route('update.config.background') }}" method="POST" enctype="multipart/form-data" id="form_background">
                      @csrf
                      @method('PUT')
                        @foreach($data['background'] as $web)

                          <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-left">{{ $web['lable'] }} </label>
                            
                            <div class="col-sm-10">
                            <img src="{{ asset($web['value']) }}" alt="IMAGES" class="mb-4" style="width:250px;height:auto;" id="previewimg">

                            
                            <input type="file" class="form-control filestyle file" name="background" >

                            <input type="hidden" name="background_lama" value="{{ $web['value'] }}">
                              
                            </div>
                          </div>
                        @endforeach

                          <div class="form-group row mt-2">
                          <div class="col-sm-10 ml-sm-auto">
                            <button id="btn-background" type="submit" class="btn btn-primary pull-right">Simpan </button>
                          </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>






          </div>
        </div>



       </div>
    </div>

</div>
<!-- / Content -->

@endsection


@section('jsfoot')
<script src="{{ asset('asset/temp_backend/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        
<script src="{{ asset('asset/temp_backend/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-advanced.init.js')}}"></script>


<script>
  $('.delete').click(function(e)
      {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
          title: 'Hapus Config Penyakit ?',
          text: "Apakah anda yakin!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya !'
        }).then((result) => {
          if (result.value) {
            $(this).find('form').submit();
          }
        })
      });


      $('#btn-sub').click(function() {
          $('#form_all').submit();
      });

      $('#btn-sosmed').click(function() {
          $('#form_sosmed').submit();
      });

      $('#btn-background').click(function() {
          $('#form_background').submit();
      });

      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#previewimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
      }


      $('.file').change(function(){
        readURL(this);
      });


</script>
@endsection




