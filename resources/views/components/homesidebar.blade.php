
    <div class="dashboard-sidebar">
        <div class="dashboard-sidebar-inner" data-simplebar>
            <div class="dashboard-nav-container">

                <!-- Responsive Navigation Trigger -->
                <a href="#" class="dashboard-responsive-nav-trigger">
                    <span class="hamburger hamburger--collapse" >
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </span>
                    <span class="trigger-title">Dashboard Navigation</span>
                </a>
                
                <!-- Navigation -->
                <div class="dashboard-nav">
                    <div class="dashboard-nav-inner">

                        <ul data-submenu-title="Account">
                            <li @if(Request::segment(2) =='maininfo') class="active" @endif>
                                <a href="{{route('home')}}"><i class="icon-material-outline-group"></i> General Information</a></li>
                            <li  @if(Request::segment(2) =='services') class="active" @endif><a href="{{route('home.services')}}"><i class="icon-material-outline-settings"></i> Manage Services</a></li>
                            <li  @if(Request::segment(3) =='services') class="active" @endif><a href="{{route('home.user.services')}}"><i class="icon-material-outline-settings"></i>User Services</a></li>
                            {{--<li  @if(Request::segment(2) =='links') class="active" @endif><a href="{{route('home.links')}}"><i class="icon-feather-globe"></i> External Links</a></li>--}}
                            <li  @if(Request::segment(2) =='gallary') class="active" @endif><a href="{{route('gallary')}}"><i class="icon-material-outline-insert-photo"></i> User Album</a></li>
                            <li  @if(Request::segment(2) =='password') class="active" @endif><a href="{{route('home.password')}}"><i class="icon-material-outline-lock"></i> Change Password</a></li>
                            <li ><a href="{{route('customlogout')}}"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                        </ul>
                        
                    </div>
                </div>
                <!-- Navigation / End -->

            </div>
        </div>
    </div>
