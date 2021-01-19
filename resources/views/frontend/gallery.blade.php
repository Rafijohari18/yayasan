@extends('layouts.frontend')
@section('title','Gallery - Yayasan Nurul Ilmi')

@section('css')

<!-- Colorbox -->
<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/colorbox.css')}}">
<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/custom-rafi.css')}}">

@endsection
@section('content')

<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url({{ asset($background->value) }});">
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-md-offset-3 col-xs-12 slider-text">
                            <div class="slider-text-inner text-center">
                                <h1>Gallery</h1>
                                <h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>Gallery</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<section id="main-container" class="main-container" style="margin-bottom:100px;">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="isotope-nav" data-isotope-nav="isotope">
                  <ul>
                     <li><a href="#" class="active" data-filter="*">Show All</a></li>
                     @foreach($data['album'] as $album)
                     <li><a href="#" data-filter=".{{ $album->id }}">{{ $album->name }}</a></li>
                     @endforeach
                   
                  </ul>
               </div><!-- Isotope filter end -->
            </div><!-- Filter col end -->
         </div><!-- Filter row end -->

         <div id="isotope" class="isotope">
                @foreach($data['photo'] as $photo)
               
               <div class="col-md-3 col-sm-6 col-xs-12 {{ $photo->album->id }} isotope-item">
                  <div class="isotope-img-container">
                     <a class="gallery-popup" href="{{ asset('userfile/album/'.$photo->album_id.'/'.$photo->file) }}">
                        <img class="img-responsive" src="{{ asset('userfile/album/'.$photo->album_id.'/'.$photo->file) }}" alt="">
                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                     </a>
                     <div class="project-item-info">
                        <div class="project-item-info-content">
                           <h3 class="project-item-title">
                           <a href="">{{ $photo->title }}</a>
                           </h3>
                           <p class="project-cat">{{ $photo->album->name  }}</p>
                        </div>
                     </div>
                  </div>
               </div><!-- Isotope item 1 end -->

               @endforeach
             

             

            
            </div><!-- Isotop end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->

@endsection

@section('js')

<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/isotope.js')}}"></script>
<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/ini.isotope.js')}}"></script>

<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/jquery.colorbox.js')}}"></script>

<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/custom.js')}}"></script>

@endsection
