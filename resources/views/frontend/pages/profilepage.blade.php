@extends('frontend.layouts.master')
@push('css')
<style>
.hiddenmd{display:none;}
	.card {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		max-width: 300px;
		margin: auto;
		border-radius: 20px;
		font-family: arial;
		background-color: white;
	}
	.gallery-card
	{
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		max-width: 1000px;
		margin: auto;
		border-radius: 20px;
		font-family: arial;
	}

	.title {
		color: grey;
		font-size: 18px;
	}

	

	button:hover, a:hover {
		opacity: 0.7;
	}
	
	.freelancer-indicators .indicator {
    padding: 20px 20px;
}

.gallery{max-height: 150px; max-width: 200px; overflow: hidden; margin-right:10px}

.desktopabout{
    display:block;
}

.mobileabout{
    display:none;
}

@media (max-width: 900px){
.card {
    max-width:100% !important;
} 
.gallery{max-height: 122px; max-width: 123px;}

.single-page-section {
    margin-bottom: 17px !important;
}

.sidebar-widget {
	margin-bottom: 17px !important;
}
.mobpad {
	margin-top:46px;
}

.hiddenmd{display:block;}

.desktopabout{
    display:none;
}

.mobileabout{
    display:block;
}

.mobilemargin{
    margin-top:-30px;
    margin-bottom:40px;
}

}



#lightbox { 
position: fixed; 
top: 0; 
left: 0; 
width: 100%; 
height: 100%; 
//background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA9JREFUeNpiYGBg2AwQYAAAuAC01qHx9QAAAABJRU5ErkJggg==) repeat; 
background: rgba(0, 0, 0, .8);
z-index: 9;
}

#lightbox p { 
position:fixed; 
z-index:999; 
cursor:pointer; 
right:10px; 
top:10px ;
text-align:  right; 
padding: .25em .5em;  
color: #fff; 
margin-right: 20px; 
font-size: 20px;  
background: rgba(100, 100, 100, .5); 
    border-radius:7px;
    -moz-border-radius:7px;
    -webkit-border-radius:7px;
}

#slideshow { 
position: relative; 
z-index: 100; 
text-align:center; 
width: 95%; 
height:95%; 
margin: 10 auto;
padding: 0px; 
background-color: transparent;red; 
//box-shadow: 0 0 20px rgba(0,0,0,0.4); 
}

#slideshow img { 
position: absolute; 
top: 5%; 
left: 0px; 
right: 0px; 
bottom:5%;
align:center; 
max-width:90%; 
max-height:90%; 
margin:auto;
}

.nav { display: block; z-index:999; }
.prev, .next { 
position: absolute; 
top: 50%; 
z-index:999; 
cursor:pointer; 
background: rgba(100, 100, 100, .5); 
padding: .25em .5em; 
color: #fff; text-decoration: none; 
    border-radius:7px;
    -moz-border-radius:7px;
    -webkit-border-radius:7px;
}

.next { right: 10px; }
.prev { left: 10px; }

.thumb{
width: 150px;
height: auto;
margin:5px;
}


</style>
@endpush

@section('content')
  
<div class="container" style="background-color: #ececec !important; margin-bottom: 40px;padding-top:30px" >

	<div class="row">
	
		<div class="col-md-4 col-xs-12">
			<div class="card">
				@if(!empty($user->userdetail->profile_img))
				<div style="max-height: 200px; max-height: 300px;
    object-fit: cover;
    overflow: hidden;">
				<img src="{{asset('public/assets/images/'.$user->userdetail->profile_img)}}" alt="" style="width: 100%; border-radius: 20px 20px 0px 0px;">
			</div>
				@else
				<img src="{{asset('public/assets/images/profile.png')}}" alt="">
				@endif
				<br>
				<h3 style="font-weight: bold; text-align: center;">{{ ucwords($user->name ?: '')}}</h3>
				<h5  style="text-align: center;">{{ ucwords($user->userdetail->tagline ?? '')}}</h5>
				<p class="title"></p>
				<div class="job-overview-inner">
					<ul style="list-style-type: none; padding-bottom: 15px;padding-right:5px">
						<li style="padding-bottom: 15px;">
							<i class="icon-material-outline-email"></i>
							<span>Email</span>
							<h5><b>{{$user->email}}</b></h5>
						</li>
						<li style="padding-bottom: 15px;">
							<i class="icon-material-outline-location-on"></i>
							<span>Address</span>
							<h5><b>{{$user->userdetail->address ?? 'Address Not Available'}}, {{$user->userdetail->city ?? ''}}, {{$user->userdetail->country ?? ''}}</b></h5>
						</li>
						<li style="padding-bottom: 15px;">
							<i class="icon-feather-phone"></i>
							<span>Phone</span>
							<h5><b>{{$user->userdetail->phone ?? 'Not Available'}}</b></h5>
						</li>
					</ul>
				</div>
			</div>
			<br>
			<div class="card desktopabout" >
				<div class="single-page-section">
					<div class="sidebar-widget " style="padding: 20px;">
					<h3 class="margin-bottom-10">About Me</h3>
					<div class="sidebar-widget">
						<p>{{ $user->userdetail->tagline ?? 'No Details Added'}}</p>
					</div>
				</div>
				</div>
			</div>
			<br>
		</div>
		<div class="col-md-8">
			<div class="card gallery-card mobilemargin">
				<div class="single-page-section">
					<div class="sidebar-widget " style="padding: 20px;">
					<h3 class="" style="padding:0px">Gallery</h3>
					<div id="imageSet" style="padding: 10px;">
						
						@foreach($userimages as $images)

						<a href="{{URL::to('public/assets/userimages',$images->image_name)}}" class="lightboxTrigger">
							
							<img class="gallery" src="{{URL::to('public/assets/userimages',$images->image_name)}}" class="thumb" >
						
						</a>
					
						@endforeach
						 
					</div> 
				</div>
			</div>
			</div>
			
			<div class="card mobileabout" >
				<div class="single-page-section">
					<div class="sidebar-widget " style="padding: 20px;">
					<h3 class="margin-bottom-10">About Me</h3>
					<div class="sidebar-widget">
						<p>{{ $user->userdetail->tagline ?? 'No Details Added'}}</p>
					</div>
				</div>
				</div>
			</div>
			
			
									<div class="card gallery-card">
										<div class="single-page-section">
											<div class="sidebar-widget mobpad" style="padding: 20px;">
												<h3 style="margin-bottom: 0px">Services </h3>
												<br>
												<div class="freelancer-indicators ">
													<!-- Indicator -->
													@if(!empty($userservices))
													@forelse($userservices as $service)
													<div class="indicator custom card ">
														<h5>{{$service->serviceName->name}}</h5>
														@forelse(App\UserService::manyServices($id,$service->service) as $ss)
														<strong>{{$ss->duration}} {{$ss->budget_type}} - ${{$ss->price}}</strong><br class="hiddenmd">
														@empty
														@endforelse
													</div>
													@empty
													@endforelse
													@endif
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							{{--<div class="row">
							@if(!empty($user->userdetail->website) && isset($user->userdetail->website))
								<div class="col-xl-6 col-lg-6 content-right-offset">
									<div class="sidebar-widget" style="text-align: center;">
										<h3 style="margin-bottom: 0px">Official Website</h3>
										<div class="freelancer-socials">
											<ul>
												<li style="font-size:15px !important"><a href="#">{{$user->userdetail->website ?? ''}}</a></li>

											</ul>
										</div>
									</div>
								</div>
								@endif
								<div class="col-xl-6 col-lg-6 content-right-offset">
									@if(!empty($user->userdetail->facebook) or !empty($user->userdetail->google) or !empty($user->userdetail->twitter) or !empty($user->userdetail->linkedin) or !empty($user->userdetail->instagram) or !empty($user->userdetail->behance) or !empty($user->userdetail->dribble) or !empty($user->userdetail->github))
									<div class="sidebar-widget" style="text-align: center;">
										<h3>Social Profiles</h3>
										<div class="freelancer-socials margin-top-25">
											<ul>
												@if(!empty($user->userdetail->facebook))	
												<li><a href="//{{$user->userdetail->facebook}}" target="_blank" title="Facebook" data-tippy-placement="top"><i class="icon-feather-facebook"></i></a></li>
												@endif
												@if(!empty($user->userdetail->google))	
												<li><a href="//{{$user->userdetail->google}}" target="_blank" title="Google" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
												@endif
												@if(!empty($user->userdetail->twitter))	
												<li><a href="//{{$user->userdetail->twitter}}" target="_blank" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
												@endif
												@if(!empty($user->userdetail->youtube))	
												<li><a href="//{{$user->userdetail->youtube}}" target="_blank" title="Youtube" data-tippy-placement="top"><i class="icon-brand-youtube"></i></a></li>
												@endif
												@if(!empty($user->userdetail->linkedin))	
												<li><a href="//{{$user->userdetail->linkedin}}" target="_blank" title="LinkedIn" data-tippy-placement="top"><i class="icon-feather-linkedin"></i></a></li>
												@endif
												@if(!empty($user->userdetail->instagram))	
												<li><a href="//{{$user->userdetail->instagram}}" target="_blank" title="Instagram" data-tippy-placement="top"><i class="icon-line-awesome-instagram"></i></a></li>
												@endif
												@if(!empty($user->userdetail->behance))	
												<li><a href="//{{$user->userdetail->behance}}" target="_blank" title="behance" data-tippy-placement="top"><i class="icon-line-awesome-behance"></i></a></li>
												@endif
												@if(!empty($user->userdetail->dribble))	
												<li><a href="//{{$user->userdetail->dribble}}" target="_blank" title="Dribbble" data-tippy-placement="top"><i class="icon-line-awesome-dribbble"></i></a></li>
												@endif
												@if(!empty($user->userdetail->github))	
												<li><a href="//{{$user->userdetail->github}}" target="_blank" title="Github" data-tippy-placement="top"><i class="icon-line-awesome-github"></i></a></li>
												@endif
											</ul>
										</div>
									</div>
									@endif
								</div>

							</div> --}}
						</div>
						@endsection

						@push('js')
						<script type="text/javascript">

							jQuery(document).ready(function($) {

  // global variables for script
  var current, size;
  
  $('.lightboxTrigger').click(function(e) {

    // prevent default click event
    e.preventDefault();
    
    // grab href from clicked element
    var image_href = $(this).attr("href");  
    
    // determine the index of clicked trigger
    var slideNum = $('.lightboxTrigger').index(this);
    
    // find out if #lightbox exists
    if ($('#lightbox').length > 0) {        
      // #lightbox exists
      $('#lightbox').fadeIn(300);
      // #lightbox does not exist - create and insert (runs 1st time only)
  } else {                                
      // create HTML markup for lightbox window
      var lightbox =
      '<div id="lightbox">' +
      '<p>Close X</p>' +
      '<div id="slideshow">' +
      '<div class="nav">' +
      '<a class="prev slide-nav">prev</a>' +
      '<a class="next slide-nav">next</a>' +
      '</div>' +
      '</div>' +
      '</div>';
      
      //insert lightbox HTML into page
      $('body').append(lightbox);
      
      // fill lightbox with .lightboxTrigger hrefs in #imageSet
      $('#imageSet').find('.lightboxTrigger').each(function() {
      	var $href = $(this).attr('href');
      	$('#slideshow').append(
      		'<img src="' + $href + '">'
      		);
      });
      
  }

    // setting size based on number of objects in slideshow
    size = $('#slideshow img').length;
    
    // hide all slide, then show the selected slide
    $('#slideshow img').hide();
    $('#slideshow img:eq(' + slideNum + ')').show();
    
    // set current to selected slide
    current = slideNum;
});
  
  //Click anywhere on the page to get rid of lightbox window
  $('body').on('click', '#lightbox', function() { // using .on() instead of .live(). more modern, and fixes event bubbling issues
  	$('#lightbox').fadeOut(300);
  });
  
  // show/hide navigation when hovering over #slideshow
  $('body').on(
  	{ mouseenter: function() {
  		$('.nav').fadeIn(300);
  	}, mouseleave: function() {
  		$('.nav').fadeOut(300);
  	}
  },'#slideshow');
  
  // navigation prev/next
  $('body').on('click', '.slide-nav', function(e) {

    // prevent default click event, and prevent event bubbling to prevent lightbox from closing
    e.preventDefault();
    e.stopPropagation();
    
    var $this = $(this);
    var dest;
    
    // looking for .prev
    if ($this.hasClass('prev')) {
    	dest = current - 1;
    	if (dest < 0) {
    		dest = size - 1;
    	}
    } else {
      // in absence of .prev, assume .next
      dest = current + 1;
      if (dest > size - 1) {
      	dest = 0;
      }
  }

    // fadeOut curent slide, FadeIn next/prev slide
    $('#slideshow img:eq(' + current + ')').fadeOut(100);
    $('#slideshow img:eq(' + dest + ')').fadeIn(100);
    
    // update current slide
    current = dest;
});
  
});
</script>

@endpush



