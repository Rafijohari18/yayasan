@extends('layouts.frontend')
@section('title', $data['content']->title)
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
                                <h1>{{ $data['content']->title }}</h1>
                                <h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>{{ $data['content']->title }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div class="colorlib-classes">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="row row-pb-lg">
							<div class="col-md-12 animate-box">
								<div class="classes class-single">
									<div class="classes-img" style="background-image: url({{ asset($data['content']->cover) }});">
									</div>
									<div class="desc desc2">
										<h3><a href="#">{{ $data['content']->title }}</a></h3>
										    {!! $data['content']->content !!}
									</div>
								</div>
							</div>
						</div>
					
						
					</div>

					<div class="col-md-4 animate-box">
						<div class="sidebar">
							
							<div class="side">
								<h3 class="sidebar-heading">Latest Posts</h3>
								@foreach($data['content_news'] as $content_news)
                                <div class="f-blog">
									<a href="{{ route('berita.detail',['slug' => $content_news->slug]) }}" class="blog-img" style="background-image: url({{ asset($content_news->cover) }});">
									</a>
									<div class="desc">
										<p class="admin"><span>{{ Carbon\Carbon::parse($content_news->created_at)->translatedFormat('d F Y') }}</span></p>
										<h2><a href="{{ route('berita.detail',['slug' => $content_news->slug]) }}">{{ $content_news->title }}</a></h2>
										
									</div>
								</div>
                                @endforeach
								
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection