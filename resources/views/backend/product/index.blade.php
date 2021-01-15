@extends('layouts.backend')

@section('title', $data['title'])


@section('css')
<link href="{{ asset('asset/temp_backend/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('asset/temp_backend/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />

@endsection

@section('content')
<!-- Content -->
<div class="container-fluid  container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Setting / </span>{{ $data['title'] }}
    </h4>

    <div class="card">
      <h6 class="card-header">
        <i class="fas fa-edit"></i> Form Setting
      </h6>
      <div class="card-body">
        <hr class="border-light m-0">
        <br>

         <div class="nav-tabs-top">
         
            
            <div class="tab-content">

            <div class="tab-pane fade show active" id="web">
                <div class="card">
                    <div class="card-body">
                      <form action="{{ route('product.update', ['id' => 1]) }}" method="POST" id="form_all">
                      @csrf
                      @method('PUT')
                       
                          <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-left">Iframe Harga </label>
                            <div class="col-sm-10">
                           
                              <textarea type="text" class="form-control" name="iframe"  placeholder="enter value..." cols="2" rows="4"> {{ $data['web']->iframe }}</textarea>
                           
                            </div>
                          </div>
                    

                      

                          <div class="form-group row mt-2">
                          <div class="col-sm-10 ml-sm-auto">
                            <button id="btn-sub" type="submit" class="btn btn-primary pull-right">Simpan </button>
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
<script src="{{ asset('asset/temp_backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ asset('asset/temp_backend/js/pages/form-advanced.init.js')}}"></script>


<script>

      $('#btn-sub').click(function() {
          $('#form_all').submit();
      });



</script>
@endsection




