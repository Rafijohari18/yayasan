@extends('layouts.frontend')
@section('title','Visi Misi - Yayasan Nurul Ilmi')
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
										<h1>Visi Misi</h1>
										<h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>Visi Misi</span></h2>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		
		
		<div class="colorlib-about">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h3>{{ $sejarah->title }}</h3>
						<p>{{ strip_tags($sejarah->content ) }}</p>
					</div>
					<div class="col-md-6">
						<div class="fancy-collapse-panel">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> {{ $data['visi']->title }}
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12">
                                                    <p> {{ strip_tags($data['visi']->content) }} </p>
													
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">{{ $data['misi']->title }}
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
										<div class="panel-body">
                                            {!! $data['misi']->content !!}
											
											
										</div>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        
@endsection
