@extends('layouts.frontend')
@section('title','Gallery - Yayasan Nurul Ilmi')

@section('css')

<!-- Colorbox -->
<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/colorbox.css')}}">

<style>

.isotope-nav {
    display: inline-block;
    margin: 20px 0 50px;
    width: 100%;
}

.isotope-nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    border-bottom: 3px solid #302a39;
}

.isotope-nav ul li {
    display: inline-block;
    line-height: 40px;
}

.isotope-nav ul li a {
    color: #212121;
    font-size: 14px;
    padding: 12px 25px;
    font-weight: 700;
    text-transform: uppercase;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}

.isotope-nav ul a.active {
    color: white;
    background: #302a39;
}

/* Project Isotope Item */

.isotope-item {
    padding: 0;
}

.isotope-img-container {
    position: relative;
    overflow: hidden;
}

.isotope-img-container img {
    -webkit-transform: perspective(1px) scale3d(1.1, 1.1, 1);
    transform: perspective(1px) scale3d(1.1, 1.1, 1);
    -webkit-transition: all 400ms;
    transition: all 400ms;
}

.isotope-img-container:hover img {
    -webkit-transform: perspective(1px) scale3d(1.15, 1.15, 1);
    transform: perspective(1px) scale3d(1.15, 1.15, 1);
}

.isotope-img-container:after {
    opacity: 0;
    position: absolute;
    content: '';
    top: 0;
    right: auto;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    -webkit-transition: all 400ms;
    transition: all 400ms;
}

.isotope-img-container:hover:after {
    opacity: 1;
}

.gallery-popup .gallery-icon {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 1;
    padding: 5px 12px;
    background: #302a39;
    color: #fff;
    opacity: 0;
    -webkit-transform: perspective(1px) scale3d(0, 0, 0);
    transform: perspective(1px) scale3d(0, 0, 0);
    -webkit-transition: all 400ms;
    transition: all 400ms;
}

.isotope-img-container:hover .gallery-popup .gallery-icon {
    opacity: 1;
    -webkit-transform: perspective(1px) scale3d(1, 1, 1);
    transform: perspective(1px) scale3d(1, 1, 1);
}

.project-item-info {
    position: absolute;
    top: 50%;
    margin-top: -15%;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 0 30px;
    z-index: 1;
}

.project-item-info-content {
    opacity: 0;
    -webkit-transform: perspective(1px) translate3d(0, 15px, 0);
    transform: perspective(1px) translate3d(0, 15px, 0);
    -webkit-transition: all 400ms;
    transition: all 400ms;
}

.isotope-img-container:hover .project-item-info-content {
    opacity: 1;
    -webkit-transform: perspective(1px) translate3d(0, 0, 0);
    transform: perspective(1px) translate3d(0, 0, 0);
}

.project-item-title {
    font-size: 20px;
}

.project-item-title a {
    color: #fff;
}

.project-item-title a:hover {
    color: #ffb600;
}

.project-cat {
    background: #302a39;
    display: inline-block;
    padding: 2px 8px;
    font-weight: 700;
    color: #fff;
    font-size: 10px;
    text-transform: uppercase;
}




</style>

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
