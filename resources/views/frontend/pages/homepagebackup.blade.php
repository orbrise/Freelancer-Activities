@extends('frontend.layouts.master');
@push('css')

@endpush

@section('content')
<!-- Intro Banner
================================================== -->
<!-- add class "disable-gradient" to enable consistent background overlay -->
<div class="intro-banner" data-background-image="{{asset('public/assets/images/home-background.jpg')}}">
	<div class="container">
		
		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-12">
				<div class="banner-headline">
					<h3>
						<strong>Hire experts or be hired for any job, any time.</strong>
						<br>
						<span>Thousands of small businesses use <strong class="color">{{App\AppSetting::AppName()}}</strong> to turn their ideas into reality.</span>
					</h3>
				</div>
			</div>
		</div>
		
		<!-- Search Bar -->
		<div class="row">
			<div class="col-md-12">
				<form method="get" action="{{route('search')}}">
					{{csrf_field()}}
				<div class="intro-banner-search-form margin-top-95">

					<!-- Search Field -->
					<div class="intro-search-field with-autocomplete">
						<label for="autocomplete-input" class="field-title ripple-effect">Where?</label>
						<div class="input-with-icon">
							<input id="autocomplete-input" name="l" type="text" placeholder="Online Job">
							<i class="icon-material-outline-location-on"></i>
						</div>
					</div>

					<!-- Search Field -->
					<div class="intro-search-field">
						<label for ="intro-keywords" class="field-title ripple-effect">What job you want?</label>
						<input id="intro-keywords" type="text" name="k" placeholder="Job Title or Keywords">
					</div>

					<!-- Button -->
					<div class="intro-search-button">
						<button class="button ripple-effect" onclick="window.location.href='jobs-list-layout-full-page-map.html'">Search</button>
					</div>
				</div>
			</form>
			</div>
		</div>

		<!-- Stats -->
		<div class="row">
			<div class="col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px">
					<li>
						<strong class="counter">1,586</strong>
						<span>Jobs Posted</span>
					</li>
					<li>
						<strong class="counter">3,543</strong>
						<span>Tasks Posted</span>
					</li>
					<li>
						<strong class="counter">1,232</strong>
						<span>Freelancers</span>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<!-- Category Boxes -->
<div class="section margin-top-65">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">

				<div class="section-headline centered margin-bottom-15">
					<h3>Popular Categories</h3>
				</div>

				<!-- Category Boxes Container -->
				<div class="categories-container">

					@forelse($cats as $cat)
					<a href="{{route('search','?c%5B%5D='.$cat->id)}}" class="category-box">
						<div class="category-box-icon" style="padding:5px">
							@if(!empty($cat->logo))
							<img width="48" height="48" src="{{asset('public/assets/catimages')}}/{{$cat->logo}}">
							@else
							<i class="{{$cat->icon}}"></i>
							@endif
						</div>
						<div class="category-box-counter">612</div>
						<div class="category-box-content">
							<h3>{{$cat->name}}</h3>
							<p>{{$cat->description}}</p>
						</div>
					</a>
					@empty
					no categories exists
					@endforelse

				</div>

			</div>
		</div>
	</div>
</div>
<!-- Category Boxes / End -->


<!-- Highest Rated Freelancers -->
<div class="section gray padding-top-65 padding-bottom-70 full-width-carousel-fix">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-25">
					<h3>Featured Freelancers</h3>
					<a href="{{route('search')}}" class="headline-link">Browse All Freelancers</a>
				</div>
			</div>

			<div class="col-xl-12">
				<div class="default-slick-carousel freelancers-container freelancers-grid-layout">

					<!--Freelancer -->
					@foreach($user as $user)
					<div class="freelancer">
						<!-- Overview -->
						<div class="freelancer-overview">
							<div class="freelancer-overview-inner">
								
								<!-- Bookmark Icon -->
								
								
								<!-- Avatar -->
								<div class="freelancer-avatar">
									<div class="verified-badge"></div>
									<a href="{{route('profile.page',[$user->id,str_replace(" ","-",$user->name)])}}">
										@if(!empty($user->userdetail->profile_img))
										<img src="{{asset('public/assets/images/'.$user->userdetail->profile_img)}}" alt="">
										@else
										<img src="{{asset('public/assets/images/profile.png')}}" alt="">
									@endif</a>
								</div>

								<!-- Name -->
								<div class="freelancer-name">
									<h4><a href="{{route('profile.page',[$user->id,str_replace(" ","-",$user->name)])}}">
										@isset($user->name) {{$user->name}} @endisset @isset($user->lastname){{$user->lastname}}@endisset 
										@if(!empty($user->userdetail->country))
										<img class="flag" src="{{('public/assets/images/flags')}}/{{$user->userdetail->country}}.svg" alt="" title="United Kingdom" data-tippy-placement="top">
									@endif</a></h4>
									<span>{{$user->userdetail->tagline ?: ''}}</span>
								</div>

								<!-- Rating 
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="5.0"></div>
								</div><!-- Rating -->
							</div>
						</div>
						
						<!-- Details -->
						<div class="freelancer-details">
							<div class="freelancer-details-list">
								<ul>
									 @if(!empty($user->userdetail->city))
									<li>Location <strong><i class="icon-material-outline-location-on"></i>{{$user->userdetail->city}}</strong></li>
									@endif
									@if(!empty($user->getUserServices->price))
								<li>Rate <strong>${{$user->getUserServices->price}} / {{$user->getUserServices->budget_type}}</strong></li>
								@endif
								</ul>
							</div>
							<a href="{{route('profile.page',[$user->id,str_replace(" ","-",$user->name)])}}" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>
					@endforeach

				</div>
			</div>

		</div>
	</div>
</div>
<!-- Highest Rated Freelancers / End-->
@endsection

@push('js')
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() { 
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	}); 
}); 
</script>


<!-- Google Autocomplete -->
<script>
	function initAutocomplete() {
		 var options = {
		  types: ['(cities)'],
		  // componentRestrictions: {country: "us"}
		 };

		 var input = document.getElementById('autocomplete-input');
		 var autocomplete = new google.maps.places.Autocomplete(input, options);
	}

	// Autocomplete adjustment for homepage
	if ($('.intro-banner-search-form')[0]) {
	    setTimeout(function(){ 
	        $(".pac-container").prependTo(".intro-search-field.with-autocomplete");
	    }, 300);
	}

</script>

<!-- Google API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvRR71Dz73_s87Q_I5mUBy5ar4q33QDjU&libraries=places&callback=initAutocomplete"></script>
@endpush