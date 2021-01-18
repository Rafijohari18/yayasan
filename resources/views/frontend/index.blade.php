@extends('layouts.frontend')
@section('title','Home - Yayasan Nurul Ilmi')
@section('css')
<style>

/*/ mobile /*/
@media screen and (max-width: 768px) {
	#logo-yayasan{
		width:50px;
		height:40px;
		border-radius:100%;
		-ms-transform: translateY(50%);
		transform: translateY(50%);
	}
	.card-title{
  		-ms-transform: translateX(40%);
  		transform: translateX(40%);
		margin-top:-10px;
	}
	#lable-sekolah{
		margin-top:15px;
		border-top-left-radius: 20px 20px;
		border-bottom-right-radius: 20px 20px;
		height:70px;

	}

	.counter-entry {
		bottom: 10px;
		margin-left: 80px;
	}

}
/*tablet*/

@media screen and (min-width: 769px) and (max-width: 1024px)  {
	#logo-yayasan{
		width:50px;
		heigth:auto;
		border-radius:100%;
		-ms-transform: translateY(50%);
		transform: translateY(50%);
	}
	.card-title{
  		-ms-transform: translateX(40%);
  		transform: translateX(40%);
		margin-top:-10px;
	}
	#lable-sekolah{
		margin-top:15px;
		border-top-left-radius: 20px 20px;
		border-bottom-right-radius: 20px 20px;
		height:70px;

	}
}

@media screen and (min-width: 1025px) and (max-width: 1280px)  {
	#logo-yayasan{
		width:50px;
		height:40px;
		border-radius:100%;
		-ms-transform: translateY(35%);
		transform: translateY(35%);
	}
	.card-title{
  		-ms-transform: translateX(5%);
  		transform: translateX(5%);
		margin-top:23px;
		font-size: 14px;
	}
	#lable-sekolah{
		margin-top:15px;
		border-top-left-radius: 20px 20px;
		border-bottom-right-radius: 20px 20px;
		height:70px;
		margin-left: 40px;
    	left: 5%;

	}
}

/*desktop*/
@media screen and (min-width: 1281px) {

	#lable-sekolah{
		border-top-left-radius: 20px 20px;
		border-bottom-right-radius: 20px 20px;
		height:80px;
		margin-left:20px;
		transform: translateX(30%);


	}
	.card-title{
  		-ms-transform: translateY(100%);
  		transform: translateY(100%);
	}
	#logo-yayasan{
		width:60px;
		height:50px;
		border-radius:100%;
		-ms-transform: translateY(35%);
		transform: translateY(35%);

	}
}


#lable-sekolah{
	background:#163FAC;
}
#lable-sekolah:hover{
	background:#0081C1;
}

.owl-carousel .owl-video-tn {
  background-size: cover;
  padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
}

.owl-video-frame {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
}
.owl-video-frame iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

.owl-dots {
  text-align: center;
  margin-top: 20px;
}

.owl-dot {
  display: inline-block;
}

.owl-dot span {
  width: 11px;
  height: 11px;
  background-color: #ccc;
  border-radius: 50%;
  display: block;
  margin: 0px 0px 10px 0px;
}

.owl-dot.active span {
  background-color: #000;
}

.colorlib-classes .owl-theme .owl-controls{
	bottom : -100px;
}
.colorlib-classes .owl-theme .owl-controls {
	margin-bottom:100px;
}

/* Team Section V2 */

.team-figure{ position: relative; text-align: center; padding: 30px 0 0;}
.team-figure::before{ content: ""; position: absolute; left: 0; z-index: -1; bottom: 0; background: #f2f2f2; height: 0; width: 100%;}
.employee-detail{ position: absolute; top: 0; height: 100%; width: 100%; left: 0;}
.team-figure:hover::before{ height: 100%;}
.employee-desination{ text-align: center; padding: 30px 0; opacity: 0;background:#4586FF;}
.team-figure:hover .employee-desination{ opacity: 1;  margin: 200px 0 0;}
.employee-desination h5 a{ color: #fff;}
.employee-desination span{ display: block; color: #fff; font-size: 18px;}

.tc-display-table{ width: 100%; height: 100%; display: table;}
.tc-display-table-cell{ display: table-cell; vertical-align: middle; width: 100%; height: 100%;}

/* Facts
================================================== */


.facts-wrapper{
    text-align: center;
}

.facts-wrapper .ts-facts {
    color: #fff;
}

.ts-facts .ts-facts-icon i {
    font-size: 42px;
    color: #ffb600;
}

.ts-facts .ts-facts-content .ts-facts-num {
    color: #fff;
    font-size: 44px;
    margin: 30px 0 20px;
}

.ts-facts .ts-facts-content .ts-facts-title {
    font-size: 20px;
    color: white;
    margin: 0;
}
.dark-bg{
    background: #4686FF;
    color: #fff;
}

.dark-bg h2, 
.dark-bg h3{
    color: #fff;
}

section, .section-padding {
    padding: 70px 0;
    position: relative;
}

.isotope-nav {
    display: inline-block;
    margin: 20px 0 50px;
    width: 100%;
}

.isotope-nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    border-bottom: 3px solid #4686FF;
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
    background: #4686FF;
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
    background: #4686FF;
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
    background: #4686FF;
    display: inline-block;
    padding: 2px 8px;
    font-weight: 700;
    color: #fff;
    font-size: 10px;
    text-transform: uppercase;
}


</style>


<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/colorbox.css')}}">

@endsection

@section('content')

<aside id="colorlib-hero">
	<div class="flexslider">
		<ul class="slides">
			@foreach($slider as $slid)
				<li style="background-image: url({{ asset($slid->image) }});">
					<div class="overlay"></div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-8 col-sm-12 col-md-offset-2 col-xs-12 col-md-pull-1 slider-text">
								<div class="slider-text-inner">
									<div class="desc">
										<h2>{{ $slid->title }}</h2>
										<h1>{{ strip_tags($slid->content) }}</h1>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
			@endforeach
			
		</ul>
	</div>
</aside>

<div class="colorlib-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12 search-wrap">
				<div class="search-wrap-2">
	
					<div class="row justify-content-center align-items-center">
						@foreach($sekolah_yayasan as $sekyayasan)
						<a href="{{ strip_tags($sekyayasan->content) }}">
						<div class="col-md-3 bg-primary mb-3" id="lable-sekolah"> 
							<div class="card">
								
								<div class="col-md-4">
									<img src="{{ asset($sekyayasan->cover)}}" alt="logo-sd" id="logo-yayasan">
								</div>
								<div class="col-md-8 ">
									<h4 class="card-title" style="color:white;">{{ $sekyayasan->title }}</h4>

								</div>
									
							</div>
						</div>
						</a>
						@endforeach
						
					
						
					</div>
					
				
			</div>
		</div>
	</div>



</div>

<div id="colorlib-services">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center animate-box mt-3">
					<p>
						<a href="" class="btn btn-primary btn-outline btn-lg btn-discover">
							PPDB YPI BM MUDA NURUL 'ILMI
						</a>

						<a href="" class="btn btn-primary btn-outline btn-lg btn-discover">
							<span class="icon">
								<i class="fas fa-plus"></i>
							</span>
							INFORMASI LAINNYA
						</a>

					</p>
			</div>
		</div>
	</div>
</div>


<div id="colorlib-services">
	<div class="container">
		<div class="row">
			<div class="col-md-12 colorlib-heading center-heading text-center animate-box">
				<h1 class="heading-big">Keunggulan Kami</h1>
				<h2>{{ $tit_keunggulan->title }}</h2>
			</div>

			<div class="col-md-12 services-wrap">
				<div class="row">
					@foreach($keunggulan as $unggulan)
					<div class="col-md-4 col-sm-12 text-center animate-box">
						<a href="" class="services">
							<span class="icon">
								<i class="flaticon-desktop"></i>
							</span>
							<div class="desc">
								<h3>{{ $unggulan->title }}</h3>
								<p style="color:black;font-size:14px;">{{ strip_tags($unggulan->content) }}</p>
							</div>
						</a>
					</div>
					@endforeach
					
				</div>
			</div>
		
		</div>
	</div>
</div>

<div id="colorlib-counter" class="colorlib-counters">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="about-desc">
                            @foreach($foto_ketua as $key => $foto)
							<div class="about-img-1 animate-box" style="background-image: url({{ asset($foto->file) }});"></div>
							@endforeach
						</div>
					</div>
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-12 colorlib-heading animate-box">
								<h1 class="heading-big">{{ $sambutan->title }}</h1>
								<h2>{{ $sambutan->title }} </h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 animate-box">
								{!! $sambutan->content !!}
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>

		<section class="team-holder section-padding-top overlay-blue">
			<div class="container">
				
				<div class="row">
					<div class="col-md-12 colorlib-heading center-heading text-center animate-box">
						<h1 >Profil Pengurus Yayasan</h1>
						<span style="font-size:26px;">Terdiri Dari Pengurus Yang Berpengalaman</span>
					</div>
				</div>
				<!-- Main Heading -->
				
				<!-- Main Heading -->

				<!-- Team Slider -->
				<div class="col-md-12 animate-box">

					<div class="owl-carousel owl-theme" id="owl-guru-carousel"> 
						@foreach($guru as $gurus)
							<div class="item">
								<figure class="team-figure">

								<img src="{{ asset($gurus->cover) }}" alt="">
									<figcaption class="employee-detail">
										<div class="tc-display-table">
											<div class="tc-display-table-cell">
												<div class="employee-desination">
													<h5><a href="#">{{ $gurus->title }}</a></h5>
													<span>{{ strip_tags($gurus->content) }}</span>
												</div>
											</div>
										</div>
									</figcaption>
								</figure>

							</div>
						@endforeach
					</div>
				</div>

				
				<!-- Team Slider -->

			</div>
		</section>

		<section id="facts" class="facts-area dark-bg">
			<div class="container">
				<div class="row">
					<div class="facts-wrapper">
						
						@foreach($jumlah_yayasan as $yayasan)
						<div class="col-sm-4 ts-facts">
							
							<div class="ts-facts-content">
								<h2 class="ts-facts-num">
									<span class="colorlib-counter js-counter" data-from="0" data-to="{{ strip_tags($yayasan->content) }}" data-speed="5000" data-refresh-interval="50"></span>
								</h2>
								<h3 class="ts-facts-title">{{ $yayasan->title }}</h3>
							</div>
						</div><!-- Col end -->
						@endforeach
						

					</div> <!-- Facts end -->
				</div>
				<!--/ Content row end -->
			</div>
			<!--/ Container end -->
		</section><!-- Facts end -->

		<section id="main-container" class="main-container" style="margin-bottom:100px;">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="isotope-nav" data-isotope-nav="isotope">
                  <ul>
                     <li><a href="#" class="active" data-filter="*">Show All</a></li>
                     @foreach($album_unggulan as $albums)
                     <li><a href="#" data-filter=".{{ $albums->id }}">{{ $albums->name }}</a></li>
                     @endforeach
                   
                  </ul>
               </div><!-- Isotope filter end -->
            </div><!-- Filter col end -->
         </div><!-- Filter row end -->

         <div id="isotope" class="isotope">
                @foreach($photo_unggulan as $photos)
               
               <div class="col-md-3 col-sm-6 col-xs-12 {{ $photos->album->id }} isotope-item">
                  <div class="isotope-img-container">
                     <a class="gallery-popup" href="{{ asset('userfile/album/'.$photos->album_id.'/'.$photos->file) }}">
                        <img class="img-responsive" src="{{ asset('userfile/album/'.$photos->album_id.'/'.$photos->file) }}" alt="">
                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                     </a>
                     <div class="project-item-info">
                        <div class="project-item-info-content">
                           <h3 class="project-item-title">
                           <a href="">{{ $photos->title }}</a>
                           </h3>
                           <p class="project-cat">{{ $photos->album->name  }}</p>
                        </div>
                     </div>
                  </div>
               </div><!-- Isotope item 1 end -->

               @endforeach
             

             

            
            </div><!-- Isotop end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->



<div class="colorlib-classes">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 colorlib-heading center-heading text-center animate-box">
				<h1 class="heading-big">Artikel & Berita Terbaru</h1>
				<h2>Artikel & Berita Terbaru</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 animate-box">
				<div class="owl-carousel">
					@foreach($berita_terbaru as $berita)
					<div class="item">
						<div class="classes">
							<div class="classes-img" style="background-image: url({{ asset($berita->cover)}});">
							</div>
							<div class="wrap">
								<div class="desc">
									<span class="teacher">{{ $berita->user->name }}</span>
									<h3><a href="#">{{ $berita->title }}</a></h3>
								</div>
								<div class="pricing">
									<p><a href="{{ route('berita.detail',['slug' => $berita->slug]) }}" class="btn btn-primary">Baca Selengkapnya</a> <span class="more"><a href="#"><i class="icon-link"></i></a></span></p>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>



<div class="container">
	<div class="row">
		<div class="col-md-12 colorlib-heading center-heading text-center animate-box">
			<h1 class="heading-big">Gallery Video</h1>
			<h2>Gallery Video YPI BM Muda Nurul Ilmi</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 animate-box">
			<div class="owl-carousel owl-theme" id="owl-video-carousel"> 
				@foreach($video as $videos)
					<div class="item-video" data-merge="2">
						<a class="owl-video" href="{{ $videos->youtube_id }}"></a>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>




@endsection

@section('js')
<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/isotope.js')}}"></script>
<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/ini.isotope.js')}}"></script>

<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/jquery.colorbox.js')}}"></script>

<script type="text/javascript" src="{{ asset('asset/temp_frontend/js/custom.js')}}"></script>
<script>
$('#owl-video-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:true
        }
    }
})


$('#owl-guru-carousel').owlCarousel({
    center: true,
    items:2,
    loop:true,
    margin:10,
    responsive:{
        600:{
            items:4
        }
    }
});


$('#myCarousel').carousel({
    interval: false
});

//scroll slides on swipe for touch enabled devices

$("#myCarousel").on("touchstart", function(event){

    var yClick = event.originalEvent.touches[0].pageY;
    $(this).one("touchmove", function(event){

        var yMove = event.originalEvent.touches[0].pageY;
        if( Math.floor(yClick - yMove) > 1 ){
            $(".carousel").carousel('next');
        }
        else if( Math.floor(yClick - yMove) < -1 ){
            $(".carousel").carousel('prev');
        }
    });
    $(".carousel").on("touchend", function(){
        $(this).off("touchmove");
    });
});


function counter() {
		var oTop;
		if ($('.counterUp').length !== 0) {
			oTop = $('.counterUp').offset().top - window.innerHeight;
		}
		if ($(window).scrollTop() > oTop) {
			$('.counterUp').each(function () {
				var $this = $(this),
					countTo = $this.attr('data-count');
				$({
					countNum: $this.text()
				}).animate({
					countNum: countTo
				}, {
					duration: 1000,
					easing: 'swing',
					step: function () {
						$this.text(Math.floor(this.countNum));
					},
					complete: function () {
						$this.text(this.countNum);
					}
				});
			});
		}
	}
	$(window).on('scroll', function () {
		counter();
	});


</script>
@endsection

	