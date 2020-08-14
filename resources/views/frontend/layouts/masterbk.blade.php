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

						<li><a href="{{route('main.page')}}" class="current">Home</a></li>
						<li><a href="{{route('search')}}">Browse Freelancers</a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">

				<!--  User Notifications -->
				@if(!Auth::check())
				<div class="header-widget hide-on-mobile">
						<div class="header-notifications-trigger">
							<a href="{{route('login')}}">Login</a>
						</div>
				</div>
				@endif
				<!--  User Notifications / End -->

				<!-- User Menu -->
				<div class="header-widget hide-on-mobile">

					<!-- Messages -->
					@if(!Auth::check())
						<div class="header-notifications-trigger">
							<a href="{{route('register')}}">Register</a>
						</div>
					@else
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
	<div class="footer-middle-section">
		<div class="container">
			<div class="row">

				<!-- Links -->
			
				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Most Useable</h3>
						<ul>
							<li><a href="{{route('search')}}"><span>Browse Freelancers</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Helpful Links</h3>
						<ul>
							<li><a href="{{route('contact')}}"><span>Contact</span></a></li>
							<li><a href="{{route('page','privacy')}}"><span>Privacy Policy</span></a></li>
							<li><a href="{{route('page','terms')}}"><span>Terms of Use</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Account</h3>
						<ul>
							<li>@if(Auth::check()) <a href="{{route('logout')}}"><span>Log out</span></a> @else <a href="{{route('login')}}"><span>Log In</span></a> @endif</li>
							<li><a href="{{route('home')}}"><span>My Account</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Newsletter -->
				<div class="col-xl-6 col-lg-6 col-md-12">
					<h3><i class="icon-feather-mail"></i> Sign Up For a Newsletter</h3>
					<p>Weekly breaking news, analysis and cutting edge advices on job searching.</p>
					<form action="#" method="get" class="newsletter">
						<input type="text" id="semail" name="semail" placeholder="Enter your email address">
						<button id="sub" type="button"><i class="icon-feather-arrow-right"></i></button>
					</form>
					<div id="resinsert"></div>
				</div>
			</div>
		</div>
	</div>
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