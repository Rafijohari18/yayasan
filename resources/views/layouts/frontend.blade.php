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
<meta property="og:image" content="{{ asset('asset/temp_backend/images/favicon.ico') }}" />
<meta property="og:url" content="" />
<meta property="og:site_name" content="" />
<meta property="og:description" content="" />
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

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
							<p>{{ $alamat->value }}</p>
						</div>
						<div class="col-xs-6 col-md-push-2 text-right">
					
							<p class="btn-apply">
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
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<div id="colorlib-logo"><a href="{{ url ('/') }}">{{ $app_name->value }}</a></div>
						</div>
						<div class="col-md-10 text-right menu-1">
							<ul>
								<li class="{{ $segment1 == null ? 'active' : '' }}"><a href="{{ url ('/') }}">Home</a></li>
								
								<li class="{{ $segment1 == 'tentang-kami' ? 'active' : '' }}"><a href="{{ route('tentang.index') }}">Tentang Kami</a></li>
								<li class="{{ $segment1 == 'profil-alumni' ? 'active' : '' }}"><a href="{{ route('profil-alumni.index') }} ">Profil Alumni</a></li>
								<li class="{{ $segment1 == 'gallery' ? 'active' : '' }}"><a href="{{ route('gallery.index') }}">Gallery</a></li>
								<li class="{{ $segment1 == 'news' ? 'active' : '' }}"><a href="{{ route('news.index') }}">News</a></li>
								<li class="{{ $segment1 == 'kontak' ? 'active' : '' }}"><a href="{{ route('kontak') }}">Kontak</a></li>
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
						<h4>Hubungi Kami</h4>
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
									Copyright &copy; 2021 - {{  $app_name->value }} 
								</small><br>
								
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>

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

	@yield('js')

</body>


</html>
