@extends('layouts.frontend')
@section('title','Home - Yayasan Nurul Ilmi')
@section('css')
<style>

/*/ mobile /*/
@media screen and (max-width: 768px) {
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
		border-top-left-radius: 15px 15px;
		border-bottom-right-radius: 15px 15px;
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
		border-top-left-radius: 15px 15px;
		border-bottom-right-radius: 15px 15px;
		height:70px;

	}
}

@media screen and (min-width: 1025px) and (max-width: 1280px)  {
	#logo-yayasan{
		width:50px;
		heigth:auto;
		border-radius:100%;
		-ms-transform: translateY(50%);
		transform: translateY(50%);
	}
	.card-title{
  		-ms-transform: translateX(5%);
  		transform: translateX(5%);
		margin-top:23px;
		font-size: 14px;
	}
	#lable-sekolah{
		margin-top:15px;
		border-top-left-radius: 15px 15px;
		border-bottom-right-radius: 15px 15px;
		height:70px;
		margin-left: 40px;
    	left: 5%;

	}
}

/*desktop*/
@media screen and (min-width: 1281px) {

	#lable-sekolah{
		border-top-left-radius: 15px 15px;
		border-bottom-right-radius: 15px 15px;
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
		heigth:auto;
		border-radius:100%;
		-ms-transform: translateY(50%);
		transform: translateY(50%);

	}
}

</style>
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
									<h4 class="card-title">{{ $sekyayasan->title }}</h4>

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

<div id="colorlib-counter" class="colorlib-counters">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="about-desc">
                            @foreach($foto_ketua as $key => $foto)
							<div class="about-img-{{ $key + 1}} animate-box" style="background-image: url({{ asset($foto->file) }});"></div>
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



@endsection

	