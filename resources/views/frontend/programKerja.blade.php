@extends('layouts.frontend')
@section('title',$data['title'])
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
                                <h1>{{ $data['title'] }}</h1>
                                <h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>{{ $data['title'] }}</span></h2>
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
            <div class="col-md-12">
                <div class="row row-pb-lg">
                    <div class="col-md-12 animate-box">
                       
                        <div class="desc desc2">
                            <h3><a href="#">{{ $data['program']->title }}</a></h3>
                                {!! $data['program']->content !!}
                        </div>
                        </div>
                    </div>
                </div>
            
                
            </div>

            
        </div>
    </div>
</div>

@endsection