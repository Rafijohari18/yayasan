@extends('layouts.frontend')
@section('title','Kontak - Yayasan Nurul Ilmi')
@section('css')
<style>
    .bungkus-iframe {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
    }

    /* Then style the iframe to fit in the container div with full height and width */
    .responsive-iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
    }

    

    .ts-service-box-bg{
        background: #252525;
        color: #fff;
        padding: 30px;
    }

    .ts-service-box-bg h4,
    .ts-service-box-bg h3{
        color: #fff;
    }


    .ts-service-icon.icon-round i {
        font-size: 24px;
        color: #fff;
        background: #ffb600;
        text-align: center;
        border-radius: 100%;
        width: 60px;
        height: 60px;
        line-height: 60px;
        margin-bottom: 20px;
        position: relative;
        float: none;
    }


    /* Icon left */

    .ts-service-box.icon-left .ts-service-box-icon {
        float: left;
    }

    .ts-service-box.icon-left .ts-service-box-icon i {
        background: #ffb600;
        color: #fff;
    }

    .ts-service-box.icon-left .ts-service-box-info {
        margin-left: 90px;
    }

    .ts-service-box.icon-left .ts-service-box-info h3 {
        margin-top: 0;
        margin-bottom: 5px;
    }


    /* Service no box */

    .service-no {
        font-size: 48px;
        color: #dbdbdb;
        float: left;
        margin-top: 10px;
    }

    .ts-service-box-content .ts-service-box-info {
        margin-left: 90px;
    }


    /* Service Image */

    .ts-service-image-wrapper {
        margin-bottom: 30px;
    }

    .ts-service-icon i {
        float: left;
        font-size: 28px;
        margin-right: 15px;
        margin-top: 2px;
    }

    .ts-service-info {
        margin-left: 85px;
    }

    .ts-service-info h3 {
        font-size: 16px;
    }


    /* Service Classic */

    .ts-service-classic .ts-service-icon i {
        font-size: 24px;
        float: left;
        color: #fff;
        background: #ffb600;
        border-radius: 100%;
        width: 60px;
        height: 60px;
        line-height: 60px;
        text-align: center;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }

    .ts-service-classic .ts-service-box-info {
        margin-left: 80px;
    }

    .ts-service-classic:hover .ts-service-icon i {
        background: #ffb600;
    }


</style>
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
                                <h1>Kontak</h1>
                                <h2 class="breadcrumbs"><span><a href="{{ url('/') }}">Home</a></span> | <span>Kontak</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<div class="colorlib-contact">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-12 animate-box">
						<h2>Kontak Informasi</h2>
                           
                        <div class="row">
                           

                            <div class="col-md-4">
                            <div class="ts-service-box-bg text-center">
                                <span class="ts-service-icon icon-round">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <div class="ts-service-box-content">
                                    <h4>Alamat Email</h4>
                                    <p>{{ $email->value }}</p>
                                </div>
                            </div>
                            </div><!-- Col 2 end -->

                            <div class="col-md-4">
                            <div class="ts-service-box-bg text-center">
                                <span class="ts-service-icon icon-round">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <div class="ts-service-box-content">
                                    <h4>Lokasi</h4>
                                    <p>{{ $alamat->value }}</p>
                                </div>
                            </div>
                            </div><!-- Col 1 end -->

                            <div class="col-md-4">
                            <div class="ts-service-box-bg text-center">
                                <span class="ts-service-icon icon-round">
                                    <i class="fa fa-phone-square"></i>
                                </span>
                                <div class="ts-service-box-content">
                                    <h4>No Telepon</h4>
                                    <p>{{ $no_hp->value }}</p>
                                </div>
                            </div>
                            </div><!-- Col 3 end -->

                        </div><!-- 1st row end -->

						
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-12">
                        <div class="bungkus-iframe">
                            <iframe src="{{  $data['kontak']->value }}" class="responsive-iframe"></iframe>
                        </div>
					</div>
				</div>
			</div>
		</div>
@endsection

@section('js')

@endsection