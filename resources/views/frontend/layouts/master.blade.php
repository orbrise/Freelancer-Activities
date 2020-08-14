<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Welcome to {{App\AppSetting::AppName()}}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="_token" content="{{csrf_token()}}" />
<meta name="description" content="{{App\AppSetting::AppDesc()}}" />
<meta name="keywords" content="{{App\AppSetting::AppKeywords()}}" />
 <link rel="shortcut icon" href="{{ asset('public/assets/images/applogo')}}/{{App\AppSetting::AppIcon()}}">
<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('public/assets/css/colors/blue.css')}}">
<style>
	.header-notifications-trigger, .header-notifications-trigger a {
    top: 50%;
}.user-avatar img {
    max-height: 42px;
}

}.user-avatar img {
    max-height: 42px;
}
#navigation {
    margin-top: 9px !important;
}
#header {
    height: 50px !important;
}
.intro-banner {
    margin-top: -32px;
}

@media (max-width: 1099px){
#header {
    height: 76px !important;
}}
.freelancers-grid-layout .freelancer-details a.button {
    z-index: 0;
}
.verified-badge { z-index: 0!important;}

@if(Auth::check())
@media (max-width: 1099px){
.mmenu-trigger {
    top: 15px !important;
}}
@else
	@media (max-width: 1099px){
.mmenu-trigger {
    top: -58px;
	margin: 0 16px 0 23px !important;
}
}
@endif

.footer-links ul {
    text-align: center;
}

.footer-bottom-section {
    padding: 10px 0 !important;
}
.footer-middle-section {
    padding: 20px 0 !important;
}


</style>
@stack('css')
</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="{{route('main.page')}}"><img src="{{asset('public/assets/images/applogo')}}/{{App\AppSetting::AppLogo()}}" alt=""></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">

					{{--<li><a href="{{route('main.page')}}" class="current">Home</a></li>--}}
						<li><a href="{{route('search')}}">Browse Freelancers</a></li>
						<li><a href="{{route('page','privacy')}}"><span>Privacy Policy</span></a></li>
						<li><a href="{{route('page','terms')}}"><span>Terms of Use</span></a></li>
						<li>@if(Auth::check()) <a href="{{route('customlogout')}}"><span>Log out</span></a> @else <a href="{{route('login')}}"><span>Log In</span></a> @endif</li>
						<li><a href="{{route('home')}}"><span>My Account</span></a></li>
						<li><a href="{{route('register')}}"><span>Signup</span></a></li>
						<li><a href="{{route('contact')}}"><span>Contact</span></a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			

				<!--  User Notifications -->
				@if(!Auth::check())
				{{--<div class="header-widget hide-on-mobile">
						<div class="header-notifications-trigger">
							<a href="{{route('login')}}">Login</a>
						</div>
				</div>--}}
				@endif
				<!--  User Notifications / End -->

				<!-- User Menu -->
				

					<!-- Messages -->
					@if(!Auth::check())
					{{--<div class="header-notifications-trigger">
							<a href="{{route('register')}}">Register</a>
					</div>--}}
					@else
						<div class="right-side">
						<div class="header-widget">
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online">
							@if(!empty(Auth::user()->userdetail->profile_img))
							<img src="{{asset('public/assets/images')}}/{{Auth::user()->userdetail->profile_img}}" alt="">
							@else
							<img src="{{asset('public/assets/images/profile.png')}}" alt="">
						@endif
							</div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online">
									@if(!empty(Auth::user()->userdetail->profile_img))
									<img src="{{asset('public/assets/images')}}/{{Auth::user()->userdetail->profile_img}}" alt="">
									@else 
									<img src="{{asset('public/assets/images/profile.png')}}" alt="">
								@endif</div>
									<div class="user-name">
										{{Auth::user()->name ?:''}} <span>Freelancer</span>
									</div>
								</div>
								
								<!-- User Status Switcher -->
								
						</div>
						
						<ul class="user-menu-small-nav">
						
							<li><a href="{{route('home')}}"><i class="icon-material-outline-settings"></i> Dashboard</a></li>
							<li><a href="{{route('customlogout')}}"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>

						</div>
					</div>
					@endif

				</div>
				<!-- User Menu / End -->

				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->


@yield('content')


<!-- Footer
================================================== -->
<div id="footer">
	
	<!-- Footer Top Section -->
	<!-- Footer Top Section / End -->

	<!-- Footer Middle Section -->
	
	<!-- Footer Middle Section / End -->
	
	<!-- Footer Copyrights -->
	<div class="footer-bottom-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					© {{date('Y')}} <strong>{{App\AppSetting::AppName()}}</strong>. All Rights Reserved.
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Copyrights / End -->

</div>
<!-- Footer / End -->

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="{{ asset('public/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('public/assets/js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{ asset('public/assets/js/mmenu.min.js')}}"></script>
<script src="{{ asset('public/assets/js/tippy.all.min.js')}}"></script>
<script src="{{ asset('public/assets/js/simplebar.min.js')}}"></script>
<script src="{{ asset('public/assets/js/bootstrap-slider.min.js')}}"></script>
<script src="{{ asset('public/assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('public/assets/js/snackbar.js')}}"></script>
<script src="{{ asset('public/assets/js/clipboard.min.js')}}"></script>
<script src="{{ asset('public/assets/js/counterup.min.js')}}"></script>
<script src="{{ asset('public/assets/js/magnific-popup.min.js')}}"></script>
<script src="{{ asset('public/assets/js/slick.min.js')}}"></script>
<script src="{{ asset('public/assets/js/custom.js')}}"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->

@stack('js')

<script>
	$("#sub").click(function(){
		var csrf = $("meta[name='_token']").attr('content');
		var email = $("input#semail").val();
		$.post("{{route('subpost')}}",{_token:csrf,email:email}, function(data){
			$('#resinsert').html(data);
		});

	});
</script>

</body>
</html>