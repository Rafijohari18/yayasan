@extends('layouts.frontend')
@section('title','Home - Yayasan Nurul Ilmi')
@section('css')

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/colorbox.css')}}">
<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/custom-rafi.css')}}">

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

	