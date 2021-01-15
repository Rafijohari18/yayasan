@extends('layouts.frontend')
@section('title','Profil - Alumni')
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
										<h1>Profil Alumni</h1>
										<h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>Profil Alumni</span></h2>
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
                    @foreach($data['alumni'] as $alumni)
					<div class="col-md-3 col-sm-3 animate-box">
						<div class="trainers-entry">
							<div class="desc">
								<h3>{{ $alumni->nama }} - ( {{ $alumni->angkatan }} )</h3>
								<span>{{ $alumni->pekerjaan}}</span>
							</div>
							<div class="trainer-img" style="background-image: url({{ asset($alumni->foto) }})"></div>
							<div class="desc ">
                                <p></p>

                                <p> 
                                    <strong> Moto Hidup </strong>  : {{ $alumni->moto_hidup }} 
		                        </p>

                                <p> 
                                    <strong>Pesan & Kesan </strong>  : {{ $alumni->pesan_kesan }} 
		                        </p>
							</div>
						</div>
					</div>
                    @endforeach
					
				</div>
				
			</div>
		</div>

@endsection