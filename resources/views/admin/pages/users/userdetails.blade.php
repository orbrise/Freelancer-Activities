@extends('admin.layout.master')
@section('description', 'Welcome to Admin Control Panel')
@section('title', 'Add New Company | Move Klang Admin Panel')
@push('css')
@include('admin.layout.datatable_css')
@endpush
@section('content')
<div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="float-right">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Crovex</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                                        <li class="breadcrumb-item active">Profile</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Profile</h4>
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div>
                    <!-- end page title end breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body  met-pro-bg">
                                    <div class="met-profile">
                                        <div class="row">
                                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                                <div class="met-profile-main">
                                                    <div class="met-profile-main-pic">
                                                        <img src="@if(isset($user->userdetail->profile_img)){{asset('public/assets/images/'.$user->userdetail->profile_img)}}@endisset" width="100" alt="" class="rounded-circle">
                                                        
                                                    </div>
                                                    <div class="met-profile_user-detail">
                                                        <h5 class="met-user-name">{{$user->name}}</h5>                                                        
                                                        <p class="mb-0 met-user-name-post">@if(!empty($user->userdetail->tagline)){{$user->userdetail->tagline}}@endif</p>
                                                    </div>
                                                </div>                                                
                                            </div><!--end col-->
                                            <div class="col-lg-4 ml-auto">
                                                <ul class="list-unstyled personal-detail">
                                                    <li class=""><i class="dripicons-phone mr-2 text-info font-18"></i> <b> phone </b> : {{$user->userdetail->phone ?? ''}}</li>
                                                    <li class="mt-2"><i class="dripicons-mail text-info font-18 mt-2 mr-2"></i> <b> Email </b> : {{$user->userdetail->contact_email ?? ''}}</li>
                                                    <li class="mt-2"><i class="dripicons-location text-info font-18 mt-2 mr-2"></i> <b>Location</b> : {{$user->userdetail->city ?? ''}}, {{$user->userdetail->country ?? ''}}</li>
                                                </ul>
                                                <div class="button-list btn-social-icon">                                                
                                                    <button type="button" class="btn btn-blue btn-circle">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </button>
            
                                                    <button type="button" class="btn btn-secondary btn-circle ml-2">
                                                        <i class="fab fa-twitter"></i>
                                                    </button>
            
                                                    <button type="button" class="btn btn-pink btn-circle  ml-2">
                                                        <i class="fab fa-dribbble"></i>
                                                    </button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div><!--end f_profile-->                                                                                
                                </div><!--end card-body-->
                                <div class="card-body">
                                           
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="tab-content detail-list" id="pills-tabContent">
                               

                                <div class="tab-pane fade show active" id="portfolio_detail">
                                    <div class="row">
                                        <div class="col-lg-12">
                                                                                   
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row container-grid nf-col-3  projects-wrapper">
                                                        <div class="col-lg-12 col-md-12 p-0 nf-item branding design coffee spacing">
                                                            <div class="item-box">
                                                               <h3>About</h3>
                                                               <p>{{$user->userdetail->about ?? ''}}</p>
                                                            </div><!--end item-box-->
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                        </div><!--end col-->
                                    
                                    </div><!--end row-->
                                </div><!--end portfolio detail-->

                                <div class="tab-pane fade show active" id="portfolio_detail">
                                    <div class="row">
                                        <div class="col-lg-12">
                                                                                   
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row container-grid nf-col-3  projects-wrapper">
                                                        <div class="col-lg-12 col-md-12 p-0 nf-item branding design coffee spacing">
                                                            <div class="item-box">
                                                               <h3>Services</h3>
                                                               <p></p>
                                                               @if(!empty($userservices))
                                                               <div class="row">
                        @forelse($userservices as $service)
                        <div class="col-sm-3">
                                                               <div class="card">
                                <h5 class="card-header bg-primary text-white mt-0">{{$service->serviceName->name ?? ''}}</h5>
                                <div class="card-body">
                                    @forelse(App\UserService::manyServices($id,$service->service) as $ss)
                                    <h4>For {{$ss->duration}} {{$ss->budget_type}} = ${{$ss->price}}</h4>
                            @empty

                            @endforelse                                        
                                </div><!--end card-body-->
                            </div>
                        </div>
                              @empty
                        @endforelse
                    </div>
                        @endif

                                                             
                                                            </div><!--end item-box-->
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                        </div><!--end col-->
                                    
                                    </div><!--end row-->
                                </div><!--end portfolio detail-->
                                
                                
                            </div><!--end tab-content--> 
                            
                        </div><!--end col-->
                    </div><!--end row-->

                </div><!-- container -->
                @endsection
@push('js')
@include('admin.layout.datatable_js')
@endpush