@extends('frontend.layouts.searchlayout');
@push('css')
<style>
	.intro-search-field {
    padding: 0px;
    border-right:0px;
    flex: 1;
    align-items: left;
    display: block;
    position: relative;
}
.sidebar-widget {
    margin-bottom: 18px !important;
}
</style>
@endpush

@section('content')
<div class="full-page-container">

	<div class="full-page-sidebar">
		<div class="full-page-sidebar-inner" data-simplebar>
			<div class="sidebar-container">
				
				<!-- Location -->
				{{-- <div class="sidebar-widget">
					<h3>Location</h3>
					<div class="input-with-icon">
						<div id="autocomplete-container">
							<input id="autocomplete-input" type="text" placeholder="Location">
						</div>
						<i class="icon-material-outline-location-on"></i>
					</div>
				</div> --}}
				<form method="get" action="{{route('search')}}">
					{{csrf_field()}}
				<!-- Category -->

				<div class="intro-search-field with-autocomplete sidebar-widget">
						
						<div class="input-with-icon">
							<input id="autocomplete-input" name="l" type="text" value="@isset($req->l){{$req->l}}@endisset" placeholder="Where?">
							<i class="icon-material-outline-location-on"></i>
						</div>
					</div>

				<div class="sidebar-widget">
					
					<select name="c[]" id="maincat" class="selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" >
						<option value="">Select</option>
						@forelse($cats as $cat)
						<option value="{{$cat->id}}" @if(!empty($req->c)) @if(in_array($cat->id,$req->c)) selected="" @endif @endif>{{$cat->name}}</option>
						@empty
						@endforelse
						
					</select>
				</div>

				<div class="sidebar-widget" id="servicesinsert">
					<select name="s"> 
						<option value="">Select Service</option>
						@forelse($services as $service)
						<option value="{{$service->id}}" @if(!empty($s)) @if($service->id==$s) selected="" @endif @endif>{{$service->name}}</option>
						@empty
						@endforelse
						
					</select>
				</div>
				

				<!-- Keywords -->
				<div class="sidebar-widget">
					<div class="keywords-container">
						<div class="keyword-input-container">
							<input type="text" name="k" value="{{$req->k ?: ''}}" class="keyword-input" placeholder="e.g. task title any keyword"/>
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>


				<!-- Hourly Rate -->
				<div class="sidebar-widget">
					<h3>Hourly Rate</h3>
					<div class="margin-top-55"></div>

					<!-- Range Slider -->
					<input class="range-slider" name="r" type="text" value="" data-slider-currency="$" data-slider-min="1" data-slider-max="100" data-slider-step="5" data-slider-value="[{{$req->r ?: '1,100'}}]"/>
				</div>
				<div class="clearfix"></div>



<button type="submit" class="button ripple-effect" value="search" style="margin-bottom:10px">Search</button>

				<br>
				<!-- Tags -->
				
				<div class="row"><br>
							
                               @forelse($forms as $key => $val)
                                @if(!empty(App\Alldatauser::getCustomValues($val->label)))
                                <div class="col-xl-12">
                                    <div class="submit-field">
									<label>{{ucfirst($val->label)}}</label>
                                     <select name="ucf[]" class="form-control">
									 <option value="">Select</option>
                                     @forelse(App\Alldatauser::getCustomValues($val->label) as $c => $check)
									 
                                     <option value="{{$check->customvalue}}" @if(!empty($req->ucf)) @if(in_array($check->customvalue,$req->ucf)) selected="selected" @endif @endif>{{$check->customvalue}}</option>
                                                                          
                                     @empty
                                     @endforelse
										 </select>
                                    </div>
                                </div>
								@endif
                                @empty
                                @endforelse
									
								
                            </div>

                            <button type="submit" class="button ripple-effect" value="search">Search</button>
							
</form>
			</div>
			
			
		</div>
	</div>
	<!-- Full Page Sidebar / End -->
	
	<!-- Full Page Content -->
	<div class="full-page-content-container" data-simplebar>
		<div class="full-page-content-inner">

			<h3 class="page-title">Search Results</h3>

			<div class="notify-box margin-top-15">
				<div class="switch-container">
					<label class="switch"><input type="checkbox"><span class="switch-button"></span><span class="switch-text">Turn on email alerts for this search</span></label>
				</div>

				<!--<div class="sort-by">
					<span>Sort by:</span>
					<select class="selectpicker hide-tick">
						<option>Relevance</option>
						<option>Newest</option>
						<option>Oldest</option>
						<option>Random</option>
					</select>
				</div>-->
			</div>

			<!-- Freelancers List Container -->
			<div class="freelancers-container freelancers-grid-layout margin-top-35">
				
				@forelse($freelancers as $freelancer)
				<!--Freelancer -->
				<div class="freelancer">

					<!-- Overview -->
					<div class="freelancer-overview">
						<div class="freelancer-overview-inner">
							
							<!-- Bookmark Icon -->
							
							
							<!-- Avatar -->
							<div class="freelancer-avatar">
								<div class="verified-badge"></div>
								<a href="{{route('profile.page',[$freelancer->id,str_replace(' ','-',$freelancer->name)])}}">
									@if(!empty($freelancer->profile_img))
									<img src="{{asset('public/assets/images/')}}/{{$freelancer->profile_img}}" alt=""></a>
									@else
									<img src="{{asset('public/assets/images/profile.png')}}" alt="">
									@endif
							</div>

							<!-- Name -->
							<div class="freelancer-name">
								<h4><a href="{{route('profile.page',[$freelancer->id,str_replace(' ','-',$freelancer->name)])}}">{{$freelancer->name}} @if(!empty($freelancer->country))
<img class="flag" src="{{('public/assets/images/flags')}}/{{$freelancer->country}}.svg" alt="" title="United Kingdom" data-tippy-placement="top">@endif</a></h4>
								<span>{{$freelancer->tagline}}</span>
							</div>

							<!-- Rating -->
							{{-- <div class="freelancer-rating">
								<div class="star-rating" data-rating="4.9"></div>
							</div> --}}
						</div>
					</div>
					
					<!-- Details -->
					<div class="freelancer-details">
						<div class="freelancer-details-list">
							<ul>
								@isset($freelancer->country_name)
								@if(!empty($freelancer->country_name))
								<li>Location <strong><i class="icon-material-outline-location-on"></i>{{$freelancer->country_name}}</strong></li>
								@endif
								@endisset
								@if(!empty($freelancer->getUserServices->price))
								<li>Rate <strong>${{$freelancer->getUserServices->price}} / {{$freelancer->getUserServices->budget_type}}</strong></li>
								@endif
								{{-- <li>Job Success <strong>95%</strong></li> --}}
							</ul>
						</div>
						<a href="{{route('profile.page',[$freelancer->id,str_replace(' ','-',$freelancer->name)])}}" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
					</div>
				</div>
				@empty
				no data
				@endempty
			</div>
			<!-- Freelancers Container / End -->

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="pagination-container margin-top-20 margin-bottom-20">
				<nav class="pagination">
@if ($freelancers->lastPage() > 1)
<ul class="">
    <li class="pagination-arrow">
        <a class="{{ ($freelancers->appends($req->all())->currentPage() == 1) ? ' current-page ripple-effect ' : 'pagination-arrow' }}" href="{{ $freelancers->appends($req->all())->url(1) }}"><i class="icon-material-outline-keyboard-arrow-left"></i></a>
    </li>
    @for ($i = 1; $i <= $freelancers->appends($req->all())->lastPage(); $i++)
        <li>
            <a class="{{ ($freelancers->appends($req->all())->currentPage() == $i) ? ' ripple-effect current-page' : '' }}"href="{{ $freelancers->appends($req->all())->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="pagination-arrow">
        <a class=" {{ ($freelancers->appends($req->all())->currentPage() == $freelancers->appends($req->all())->lastPage()) ? 'current-page ripple-effect ' : 'pagination-arrow' }}" href="{{ $freelancers->appends($req->all())->url($freelancers->appends($req->all())->currentPage()+1) }}" ><i class="icon-material-outline-keyboard-arrow-right"></i></a>
    </li>
</ul>
@endif
				</nav>
			</div>
			<div class="clearfix"></div>
			<!-- Pagination / End -->

			<!-- Footer -->
			
			<!-- Footer / End -->

		
@endsection

@push('js')
<script>
// Snackbar for user status switcher
$('.status-switch label').click(function() { 
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
	$("#maincat").change(function(){
		var csrf = $("meta[name='_token']").attr('content');
		var mcatid = $(this).val();
		$.post("{{route('getservicessearch')}}",{_token:csrf, mcatid:mcatid}, function(data){
			$('#servicesinsert').html(data);
		});

	});
</script>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g&libraries=places&callback=initAutocomplete"></script>
@endpush