<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{App\AppSetting::AppName(). ' Admin Panel'}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="" name="description" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="_token" content="{{csrf_token()}}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/assets/images/applogo')}}/{{App\AppSetting::AppIcon()}}">

        @stack('css')
        <link href="{{ asset('public/admin/assets/css/style.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body>
        
         <!-- Top Bar Start -->
         <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{route('admin.dashbaord')}}" class="logo">
                    <span>
                        
                    </span>
                    <span>
                        <img src="{{ asset('public/assets/images/applogo')}}/{{App\AppSetting::AppLogo()}}" alt="logo-large" class="logo-lg logo-light">
                        <img src="{{ asset('public/assets/images/applogo')}}/{{App\AppSetting::AppLogo()}}" alt="logo-large" class="logo-lg">
                    </span>
                </a>
            </div>
            <!--end logo-->
            <!-- Navbar -->
            <nav class="navbar-custom">    
                <ul class="list-unstyled topbar-nav float-right mb-0"> 
                    

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('public/admin/assets/images/users/user-1.png')}}" alt="profile-user" class="rounded-circle" /> 
                            <span class="ml-1 nav-user-name hidden-sm">{{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            
                            <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="ti-power-off text-muted mr-2"></i> Logout</a>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->

        
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <ul class="metismenu left-sidenav-menu">
                <li @if(Request::segment(2) =='dashboard') class="mm-active" @endif>
                <a href="{{url('admin/dashboard')}}"><i class="ti-bar-chart"></i><span>Dashboard</span></a>
                </li>
                
                <li @if(Request::segment(2) =='categories') class="mm-active" @endif>
                    <a href="{{route('news.categories')}}"><i class="ti-layers"></i><span>Manage Categories</span></a> 
                </li>
                <li @if(Request::segment(2) =='services') class="mm-active" @endif>
                    <a href="{{route('list.services')}}"><i class="ti-pulse"></i><span>Manage Services</span></a> 
                </li>


                <li @if(Request::segment(2) =='customforms') class="mm-active" @endif>
                    <a href="{{route('custom.forms')}}"><i class="ti-notepad"></i><span>Custom Form</span></a> 
                </li>

                <li @if(Request::segment(2) =='users') class="mm-active" @endif>
                    <a href="{{route('all.users')}}"><i class="ti-user"></i><span>Manage Users</span></a> 
                </li>

                <li @if(Request::segment(2) =='pendings') class="mm-active" @endif>
                    <a href="{{route('pending.users')}}"><i class="ti-timer"></i><span>Pending Approvals</span></a> 
                </li>
                <li @if(Request::segment(2) =='options') class="mm-active" @endif>
                    <a href="{{route('list.servicesoptions')}}"><i class="ti-panel"></i><span>Manage Options</span></a> 
                </li>
                <li @if(Request::segment(2) =='settings') class="mm-active" @endif>
                    <a href="{{route('all.settings')}}"><i class="ti-harddrives"></i><span>Setup</span></a> 
                </li>

                <li @if(Request::segment(2) =='subscribers') class="mm-active" @endif>
                    <a href="{{route('subscribers')}}"><i class="ti-comments-smiley"></i><span>Subscribers</span></a> 
                </li>

                <li @if(Request::segment(2) =='pages') class="mm-active" @endif>
                    <a href="javascript: void(0);"><i class="ti-files"></i><span>Static Pages</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false" style="">
                        <li class="nav-item"><a class="nav-link" href="{{route('page.contact')}}"><i class="ti-control-record"></i>Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('page.terms')}}"><i class="ti-control-record"></i>Terms</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('page.privacy')}}"><i class="ti-control-record"></i>Privacy Policy</a></li> 
                    </ul>
                </li>


            </ul>
        </div>
        <!-- end left-sidenav-->

        <div class="page-wrapper">
            <!-- Page Content-->
            <div class="page-content">

                @yield('content')

                <footer class="footer text-center text-sm-left">
                    &copy; 2020 {{App\AppSetting::AppName()}} </span>
                </footer><!--end footer-->
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        

        @stack('js')
       
        
    </body>

</html>