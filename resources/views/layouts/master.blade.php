<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ __('Evil Technologies') }} - {{ __('Generateur de document') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- App css -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        @yield('css')
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
    
                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="pro-user-name ml-1">
                                    {{ Auth::user()->nom }} <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item" onclick="event.preventDefault();
                                document.getElementById('logout-form-2').submit();">
                                    <i class="fe-log-out mr-1"></i>
                                    <span>{{ __('Déconnexion') }}</span>
                                </a>
                                <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
    
                            </div>
                        </li>
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index.html" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="22">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-dark.png" alt="" height="20">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>
    
                        <a href="index.html" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-light.png" alt="" height="20">
                            </span>
                        </a>
                    </div>
    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>   

                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-toggle="dropdown">{{ Auth::user()->nom }}</a>
                            <div class="dropdown-menu user-pro-dropdown">
                                <!-- item-->
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item" onclick="event.preventDefault();
                                document.getElementById('logout-form-2').submit();">
                                    <i class="fe-log-out mr-1"></i>
                                    <span>{{ __('Déconnexion') }}</span>
                                </a>
                                <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </div>
                        
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li>
                                <a href="/home">
                                    <i class="mdi mdi-clover"></i>
                                    <span> {{ __('Tableau de bord') }} </span>
                                </a>
                            </li>

                            @if (isRoot())
                                <li>
                                    <a href="{{ route('documents.index') }}">
                                        <i data-feather="settings"></i>
                                        <span> Parametres </span>
                                    </a>
                                </li>
                            @endif
                                

                            @foreach ($templates as $template)
                                <li>
                                    <a href="{{ route('documents.show', $template->slug) }}">
                                        <i class="mdi mdi-bookmark-multiple-outline"></i>
                                        <span> {{ $template->nom }} </span>
                                    </a>
                                </li>
                            @endforeach

                            <li>
                                <a href="{{ route('utilisateurs.index') }}">
                                    <i class="mdi mdi-account-cog"></i>
                                    <span> {{ __('Administrateurs') }} </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('compte.index') }}">
                                    <i class="mdi mdi-account"></i>
                                    <span> {{ __('Mon compte') }} </span>
                                </a>
                            </li>

                            @if (isRoot())
                                <li>
                                    <a href="/mise-a-jours">
                                        <i class="mdi mdi-update"></i>
                                        <span> {{ __('Mise a jours') }} </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/reset-db">
                                        <i class="mdi mdi-update"></i>
                                        <span> {{ __('Renitialiser') }} </span>
                                    </a>
                                </li>
                            @endif
                                
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    @yield('content')

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                2015 - <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="">Coderthemes</a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        @yield('script')
        
    </body>
</html>