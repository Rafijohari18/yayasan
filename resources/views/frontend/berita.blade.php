@extends('layouts.frontend')
@section('title', Request::segment(1) == "news" ? "Berita" : "Pengumuman" )
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
                                <h1>{{ Request::segment(1) == "news" ? "Berita" : "Pengumuman" }} Nurul 'Ilmi</h1>
                                <h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>{{ Request::segment(1) == "news" ? "Berita" : "Pengumuman" }} Nurul 'Ilmi</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div class="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						@foreach($data['news'] as $news)
                        <div class="block-21 d-flex animate-box">
							<a href="{{ route('berita.detail',['slug' => $news->slug]) }}" class="blog-img" style="background-image: url({{ asset($news->cover) }});"></a>
							<div class="text">
								<h3 class="heading"><a href="{{ route('berita.detail',['slug' => $news->slug]) }}">{{ $news->title }}</a></h3>
								<p>{!! Str::limit(strip_tags($news->content), 90) !!}</p>
								<div class="meta">
									<div><a href="{{ route('berita.detail',['slug' => $news->slug]) }}"><span class="icon-calendar"></span> {{ Carbon\Carbon::parse($news->created_at)->translatedFormat('d F Y') }}</a></div>
									<div><a href="{{ route('berita.detail',['slug' => $news->slug]) }}"><span class="icon-user2"></span> {{ $news->user->name }}</a></div>
									
								</div>
							</div>
						</div>
                        @endforeach
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