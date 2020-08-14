@extends('frontend.layouts.master');
@push('css')

@endpush
<style>
	.custom {
    background-color: #f0f0f0;
    padding: 15px;
    font-size: 20px;
}
</style>
@section('content')
<!-- Titlebar
================================================== -->
<div class="single-page-header freelancer-header" data-background-image="{{asset('public/assets/images/single-freelancer.jpg')}}">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image freelancer-avatar">
							@if(!empty($user->userdetail->profile_img))
							<img src="{{asset('public/assets/images')}}/{{$user->userdetail->profile_img}}" alt="">
							@else
							<img src="{{asset('public/assets/images/profile.png')}}" alt="">
							@endif
						</div>
						<div class="header-details">
							<h3>{{$user->name ?: ''}} <span>{{ $user->userdetail->tagline ?? ''}}</span></h3>
							<ul>
								{{-- <li><div class="star-rating" data-rating="5.0"></div></li> --}}
								@if(!empty($user->userdetail->country))
								<li><img class="flag" src="{{asset('public/assets/images/flags')}}/{{$user->userdetail->country}}.svg" alt="">{{$user->userdetail->city}}, {{$user->userdetail->country_name}}</li>
								@endif
								<li><div class="verified-badge-with-title">Verified</div></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
			
			<!-- Page Content -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">About Me</h3>
				<p>@isset($user->userdetail->about){{$user->userdetail->about}}@endisset</p>

			</div>

			<div class="sidebar-widget">
					<h3 style="margin-bottom: 0px">Services </h3>
					<br>
					<div class="freelancer-indicators">
						<!-- Indicator -->
						@if(!empty($userservices))
						@forelse($userservices as $service)
						<div class="indicator custom">
							<span>{{$service->serviceName->name}}</span>
							 @forelse(App\UserService::manyServices($id,$service->service) as $ss)
							<strong>{{$ss->duration}}/{{$ss->budget_type}} - ${{$ss->price}}</strong>
							@empty

							@endforelse
							
						</div>
						@empty
						@endforelse
						@endif
						
					</div>
				</div>

			<div class="sidebar-widget">
					<h3 style="margin-bottom: 0px">Official Website</h3>
					<div class="freelancer-socials">
						<ul>
							<li style="font-size:15px !important"><a href="#">{{$user->userdetail->website ?? ''}}</a></li>
						
						</ul>
					</div>
				</div>
@if(!empty($user->userdetail->facebook) or !empty($user->userdetail->google) or !empty($user->userdetail->twitter) or !empty($user->userdetail->linkedin) or !empty($user->userdetail->instagram) or !empty($user->userdetail->behance) or !empty($user->userdetail->dribble) or !empty($user->userdetail->github))
			<div class="sidebar-widget">
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
		

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="sidebar-container">
				
				<div class="sidebar-widget">
					<div class="job-overview">
						<div class="job-overview-headline">Person Information</div>
						<div class="job-overview-inner">
							
								@forelse($user->userCustomforms as $form)
								<div class="row">
							<div class="col-sm-3"><b>{{ucfirst($form->label)}}:</b> </div>
							<div class="col-sm-6"><b>{{ucfirst($form->value)}}</b></div>
							</div>
							@empty
							no data available
							@endforelse
						</div>
						</div>
					</div>
				</div>
				
				

				<!-- Widget -->
				
<div class="sidebar-widget">
					<div class="job-overview">
						<div class="job-overview-headline">Contact Information</div>
						<div class="job-overview-inner">
							<ul>
								<li>
									<i class="icon-material-outline-email"></i>
									<span>Email</span>
									<h5>{{$user->email}}</h5>
								</li>

								<li>
									<i class="icon-material-outline-location-on"></i>
									<span>Address</span>
									<h5>London, United Kingdom, {{$user->userdetail->city ?? ''}}, {{$user->userdetail->country ?? ''}}</h5>
								</li>
								
								<li>
									<i class="icon-feather-phone"></i>
									<span>Phone</span>
									<h5>{{$user->userdetail->phone ?? ''}}</h5>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
				<!-- Widget -->
				{{-- <div class="sidebar-widget">
					<h3>Skills</h3>
					<div class="task-tags">
						<span>iOS</span>
						<span>Android</span>
						<span>mobile apps</span>
						<span>design</span>
						<span>Python</span>
						<span>Flask</span>
						<span>PHP</span>
						<span>WordPress</span>
					</div>
				</div> --}}

				<!-- Widget -->
				{{-- <div class="sidebar-widget">
					<h3>Attachments</h3>
					<div class="attachments-container">
						<a href="#" class="attachment-box ripple-effect"><span>Cover Letter</span><i>PDF</i></a>
						<a href="#" class="attachment-box ripple-effect"><span>Contract</span><i>DOCX</i></a>
					</div>
				</div> --}}

				<!-- Sidebar Widget -->
				{{-- <div class="sidebar-widget">
					<h3>Bookmark or Share</h3>

					<!-- Bookmark Button -->
					<button class="bookmark-button margin-bottom-25">
						<span class="bookmark-icon"></span>
						<span class="bookmark-text">Bookmark</span>
						<span class="bookmarked-text">Bookmarked</span>
					</button>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="#" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="#" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="#" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div> --}}

			</div>
		</div>

	</div>
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
<!-- Spacer / End-->
@endsection

@push('js')

@endpush