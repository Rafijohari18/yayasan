<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/veltrix/layouts/vertical/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Aug 2020 07:59:03 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/temp_backend/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('asset/temp_backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('asset/temp_backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('asset/temp_backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="home-btn d-none d-sm-block">
        <a href="" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Halaman Administrator</h5>
                                <p class="text-white-50">Silahkan Login.</p>
                                <a href="" class="logo logo-admin">
                                    <img src="{{ asset($logo['value']) }}" style="width:80px;height:auto;" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form class="form-horizontal mt-4" method="POST" action="{{  route('login.user') }}">
                                @csrf

                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="email" class="form-control" name="email"  placeholder="Masukan Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" name="password"  id="userpassword" placeholder="Masukan password">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </div>

                                   

                                </form>



                            </div>
                        </div>

                    </div>

                 

                   


                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('asset/temp_backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/temp_backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/temp_backend/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('asset/temp_backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('asset/temp_backend/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('asset/temp_backend/js/app.js') }}"></script>

</body>


<!-- Mirrored from themesbrand.com/veltrix/layouts/vertical/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Aug 2020 07:59:03 GMT -->
</html>