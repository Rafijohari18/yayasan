<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/veltrix/layouts/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Aug 2020 07:56:56 GMT -->
<head>
        <meta charset="utf-8" />
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Website Yayasan Nurul Ilmi" name="description" />
        <meta content="Rafi Johari" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('asset/temp_backend/images/favicon.ico') }}">

        <link href="{{ asset('asset/temp_backend/libs/chartist/chartist.min.css') }}" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href="{{ asset('asset/temp_backend/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('asset/temp_backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('asset/temp_backend/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('css')
        <link href="{{ asset('asset/temp_backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('asset/temp_backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('asset/temp_backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />    
        <link href="{{ asset('asset/temp_backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('asset/temp_backend/images/logo.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('asset/temp_backend/images/logo-dark.png')}}" alt="" height="17">
                                </span>
                            </a>

                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset($logo['value']) }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset($logo['value']) }}" alt="" height="60">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>

                      
                    </div>

                    <div class="d-flex">
                          <!-- App Search-->
                         

                       

                        <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen"></i>
                            </button>
                        </div>

                     

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ asset('asset/temp_backend/images/users/user-4.jpg')}}"
                                    alt="Header Avatar">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href=""><i class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i> Profile</a>
                             
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item text-danger" ><i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> &nbsp; Log Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                               
                            </div>
                        </div>

                       
            
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        @include('backend.sidebar')
                        <!-- Left Menu Start -->
                       
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-12">
                                © <script>document.write(new Date().getFullYear())</script> Yayasan Nurul Ilmi<span class="d-none d-sm-inline-block"> </span>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
     
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('asset/temp_backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('asset/temp_backend/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('asset/temp_backend/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('asset/temp_backend/libs/node-waves/waves.min.js') }}"></script>

        <!-- Peity chart-->
        <script src="{{ asset('asset/temp_backend/libs/peity/jquery.peity.min.js') }}"></script>

            <!-- Required datatable js -->
        <script src="{{ asset('asset/temp_backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('asset/temp_backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
      
        <!-- Responsive examples -->
        <script src="{{ asset('asset/temp_backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('asset/temp_backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('asset/temp_backend/js/pages/datatables.init.js') }}"></script> 


        <!-- Plugin Js-->
        <script src="{{ asset('asset/temp_backend/libs/chartist/chartist.min.js') }}"></script>
        <script src="{{ asset('asset/temp_backend/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js') }}"></script>

        <script src="{{ asset('asset/temp_backend/js/pages/dashboard.init.js') }}"></script>

        <script src="{{ asset('asset/temp_backend/js/app.js') }}"></script>

        <script src="{{ asset('asset/temp_backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Sweet alert init js-->
        <script src="{{ asset('asset/temp_backend/js/pages/sweet-alerts.init.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        @yield('jsfoot')
        
        
    </body>


<!-- Mirrored from themesbrand.com/veltrix/layouts/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Aug 2020 07:57:33 GMT -->
</html>