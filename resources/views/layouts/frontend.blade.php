@php
    $segment1 = Request::segment(1);
    $segment2 = Request::segment(2);
    $segment3 = Request::segment(3);
    $segment4 = Request::segment(4);
@endphp

<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="Website Yayasan Nurul Ilmi" name="description" />
<meta name="keywords" content="nurul ilmi,yayasan nurul ilmi" />
<meta name="author" content="Rafi Johari" />

<meta property="og:title" content="" />
<meta property="og:image" content="{{  asset('asset/temp_frontend/images/favicon.png')}}" />
<meta property="og:url" content="" />
<meta property="og:site_name" content="" />
<meta property="og:description" content="" />
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

<link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/temp_frontend/images/favicon.png')}}">

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/animate.css') }}">

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/icomoon.css') }}">

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/bootstrap.css') }}">

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/magnific-popup.css') }}">

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/flexslider.css') }}">

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/owl.theme.default.min.css') }}">

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/fonts/flaticon/font/flaticon.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

<link rel="stylesheet" href="{{ asset('asset/temp_frontend/css/style.css') }}">
<!-- FontAwesome -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Animation -->
<link rel='stylesheet' id='preloader-plus-css'  href="{{ asset('asset/temp_frontend/css/preloader.css') }}" media='all' />


<style>

@media screen and (min-width: 769px)  {
	.hide-font-header{
		display:none;
	}
}

@media screen and (max-width: 768px){
	.colorlib-nav-toggle {
		position : fixed;
	}

}

#colorlib-logo img {
	width:65px;
	height:auto;
}
/* sticky */
.sticky{
	position: fixed;
    top: 0;
  	left: 0;
  	width: 100%;
  	background-color: #32CD32;
	z-index:9999;
}


/* end */

.yayasan-title{
	margin: 0;
	color:white;
}

#colorlib-logo img{
	margin-left:20%;	
    margin-top: -15px;
}

@media screen and (max-width: 768px) {
	#colorlib-logo img{
		margin-left:0;
		margin-top: 0px;
		float:left;
		width:50px;

	}
}

.owl-nav{
	display:none;
}

.scrollwa {
	background-color: green;
	border-radius: 100%;
	bottom: 90px;
	color: #ffffff;
	font-size: 24px;
	height: 50px;
	line-height: 50px;
	position: fixed;
	right: 20px;
	text-align: center;
	width: 50px;
	z-index: 99;
}
</style>

@yield('css')


<script src="{{ asset('asset/temp_frontend/js/modernizr-2.6.2.min.js') }}"></script>
</head>
<body>
	<div class="colorlib-loader"></div>
	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="upper-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-4">
							
							<p>Kunjungi Web Kami : Yayasan | SD | SMP | SMA</p>
						</div>
						<div class="col-xs-6 col-md-push-2 text-right">
							
							<p class="btn-apply">
								<a title="Login" href="{{ route('login') }}">
									<i class="fa fa-user"></i> Login | 
								</a>
								<a title="Telephon" href="">
									<i class="fa fa-phone"></i> Hubungi Kami |  {{ $no_hp->value }} (WA dan Phone)
								</a>
								<a title="Facebook" href="{{ $fb->value }}">
									<i class="icon-facebook"></i>
								</a>
								<a title="Instagram" href="{{ $ig->value }}">
									<i class="icon-instagram"></i>
								</a>
								<a title="Twitter" href="{{ $tw->value }}">
									<i class="icon-twitter"></i>
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="top-menu" id="top-menus">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div id="colorlib-logo">
								<img src="{{  asset('asset/temp_frontend/images/logo.png')}}" id="img-title"><br>
								<h5 class="text-white yayasan-title" id="yayasan-title">Yayasan Pendidikan Islam BM MUDA</h5>
								<a href="{{ url ('/') }}">{{ $app_name->value }}</a>
								
								<h5 class="text-white yayasan-title" id="yayasan-title" style="font-size:10px;">SD-IT,SMP,SMA Nurul 'Ilmi - Boarding / Full Days School</h5>
							
							</div>
						</div>
						<div class="col-md-9 text-right menu-1">
							<ul >
								<li class="{{ $segment1 == null ? 'active' : '' }}"><a href="{{ url ('/') }}">Home</a></li>
								
								<li class="has-dropdown {{ $segment1 == 'tentang-kami' || $segment1 == 'pengurus' || $segment1 == 'program-kerja' ? 'active' : '' }}">
									<a href="javascript:void(0);">Tentang Kami</a>
									<ul class="dropdown">
										<li class="{{ $segment1 == 'visi-misi' ? 'active' : '' }}"><a href="{{ route('tentang.index') }}">Visi Misi</a></li>
										<li class="{{ $segment1 == 'pengurus' ? 'active' : '' }}"><a href="{{  route('pengurus.index') }}">Pengurus Yayasan</a></li>						
										<li class="{{ $segment1 == 'program-kerja' ? 'active' : '' }}"><a href="{{  route('program.kerja.index') }}">Program Kerja Yayasan</a></li>						
									</ul>
								</li>
								
								<li class="{{ $segment1 == 'profil-alumni' ? 'active' : '' }}"><a href="{{ route('profil-alumni.index') }} ">Profil Alumni</a></li>
								<li class="{{ $segment1 == 'gallery' ? 'active' : '' }}"><a href="{{ route('gallery.index') }}">Gallery</a></li>
								<li class="{{ $segment1 == 'news' ? 'active' : '' }}"><a href="{{ route('news.index') }}">Berita</a></li>
								<li class="{{ $segment1 == 'pengumuman' ? 'active' : '' }}"><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
								<li class="{{ $segment1 == 'kontak' ? 'active' : '' }}"><a href="{{ route('kontak') }}">Kontak</a></li>
								
								<li class="has-dropdown {{ $segment1 == 'panduan-ppdb' || $segment1 == 'pengumuman-hasil' ? 'active' : '' }}">
									<a href="javascript:void(0);">PPDB Online</a>
									<ul class="dropdown">
										<li><a href="https://www.ppdb.ypibmmudanurulilmi.or.id/" target="_black">Daftar Online</a></li>
										<li class="{{ $segment1 == 'panduan-ppdb' ? 'active' : '' }}"><a href="{{  route('panduan.ppdb.index') }}">Panduan Daftar Ulang</a></li>						
										<li class="{{ $segment1 == 'pengumuman-ppdb' ? 'active' : '' }}"><a href="{{  route('pengumuman.ppdb.index') }}">Pengumuman Hasil PPDB</a></li>						
									</ul>
								</li>
								<li><a href="https://docs.google.com/forms/d/1j1C1Vzcl8WFjKygCbqFzkJM4AZyu61OYu8Kt6GZEXQs/edit?usp=sharing" target="_blank">Kotak Saran</a></li>
								<!-- <li class="btn-cta"><a href="#"><span>Get started</span></a></li> -->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>

		@yield('content')


		
		<footer id="colorlib-footer">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-3 colorlib-widget">
						<h4 class="font-dark">Hubungi Kami</h4>
						<ul class="colorlib-footer-links">
							<li>{{ $alamat->value }}</li>
							<li><a href="tel://{{ $no_hp->value }}"><i class="icon-phone"></i> + {{ $no_hp->value }}</a></li>
							<li><a href=""><i class="icon-envelope"></i> <span class="__cf_email__" data-cfemail="1b72757d745b62746e6968726f7e35787476">{{ $email->value }}</span></a></li>
						
						</ul>
					</div>
					<div class="col-md-3 colorlib-widget">
						<h4>Menu</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="{{ route('tentang.index') }}"><i class="icon-check"></i> Tentang Kami</a></li>
								<li><a href="{{ route('profil-alumni.index') }}"><i class="icon-check"></i> Profil Alumni</a></li>
								<li><a href="{{ route('gallery.index') }} "><i class="icon-check"></i> Gallery</a></li>
								<li><a href="{{ route('news.index') }}"><i class="icon-check"></i> News</a></li>
								
							</ul>
						</p>
					</div>

					<div class="col-md-3 colorlib-widget">
						<h4>Sekolah</h4>
						<p>
							<ul class="colorlib-footer-links">
								@foreach($sekolah_yayasan as $sekyayasan)
								<li><a href="{{ strip_tags($sekyayasan->content) }}"><i class="icon-check"></i> {{ $sekyayasan->title }}</a></li>
								
								@endforeach
							</ul>
						</p>
					</div>
					
					<div class="col-md-3 colorlib-widget">
						<h4>Recent Post</h4>
						@foreach($berita_terbaru_2 as $berita)

							<div class="f-blog">
								<a href="" class="blog-img" style="background-image: url({{ asset($berita->cover)}});">
								</a>
								<div class="desc">
									<h2><a href="">{{ $berita->title }}</a></h2>
									<p class="admin"><span>{{ Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span></p>
								</div>
							</div>
						@endforeach

					
					</div>
				</div>
			</div>
			<div class="copy">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<p>
								<small class="block"> 
									Copyright &copy; 2021 - {{  $app_name->value }} <br>
									Powered By : <a class="text-dark" href="https://api.whatsapp.com/send?phone=6282285178213&text=Hallo!%20Saya%20ingin%20mengetahui%20informasi%20lebih%20lanjut" target="_blank">CV Hidayah Jaya Techno</a> 
								</small><br>
								
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<a href="https://api.whatsapp.com/send?phone=6281269222129&text=Hallo!%20Saya%20ingin%20mengetahui%20informasi%20lebih%20lanjut" target="_blank" class="scrollwa">
		<i class="fa fa-whatsapp"></i>
	</a>
		

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>


	<div class="preloader-plus"> 			 
		<div class="preloader-content">   	 					
				<img class="preloader-custom-img" src="{{ asset('asset/temp_frontend/images/logo.png')}}" /> 
		</div>
	</div>

	<script>
		// scroll
		window.onscroll = function() {myFunction()};

			var navbar 		= document.getElementById("top-menus");
			var logo  		= document.getElementById("colorlib-logo");
			var sticky 		= navbar.offsetTop;

			function myFunction() {
			if (window.pageYOffset >= sticky) {
				navbar.classList.add("sticky")
				logo.classList.add("hide-font-header")
			} else {
				navbar.classList.remove("sticky");
				logo.classList.remove("hide-font-header");
			}
			}
	</script>
	<script src="{{ asset('asset/temp_frontend/js/jquery.min.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/jquery.easing.1.3.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/bootstrap.min.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/jquery.waypoints.min.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/jquery.stellar.min.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/jquery.flexslider-min.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/owl.carousel.min.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('asset/temp_frontend/js/magnific-popup-options.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/jquery.countTo.js') }}"></script>

	<script src="{{ asset('asset/temp_frontend/js/main.js') }}"></script>
	<script id='preloader-plus-js-extra'>
		var preloader_plus = {"animation_delay":"500","animation_duration":"1000"};
	</script>
	
	<script src="{{ asset('asset/temp_frontend/js/preloader.js') }}" id='preloader-plus-js'></script>
	
	
	@yield('js')

</body>


</html>
