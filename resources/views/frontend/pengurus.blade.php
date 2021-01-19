@extends('layouts.frontend')
@section('title','Pengurus Yayasan - Yayasan Nurul Ilmi')
@section('css')
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
										<h1>Pengurus Yayasan</h1>
										<h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>Pengurus Yayasan</span></h2>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		
		
        <div class="colorlib-trainers">
			<div class="container">
				<div class="row row-pb-md">
                    @foreach($guru as $gurus)
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
							<div class="desc">
								<h3>{{ $gurus->title }}</h3>
								<span>{{ strip_tags($gurus->content) }}</span>
							</div>
							<div class="trainer-img" style="background-image: url({{ asset($gurus->cover) }})"></div>
							
						</div>
					</div>
                    @endforeach
				
					
				</div>
				
			</div>
		</div>
        
@endsection
