@extends('admin.layout.master')
@section('description', 'Welcome to Admin Control Panel')
@section('title', 'Hiro Admin Panel')
@push('css')
<link href="{{ asset('public/admin/plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">

        <!-- App css -->
        <link href="{{ asset('public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin/assets/css/jquery-ui.min.css')}}" rel="stylesheet">
        <link href="{{ asset('public/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin/assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="float-right">
                                    <!--<ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Crovex</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">CRM</li>
                                    </ol>-->
                                </div>
                                <h4 class="page-title">Dashboard</h4>
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div>
                    <!-- end page title end breadcrumb -->
                    <div class="row">
                        
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <img src="{{ asset('public/admin/assets/images/users/user-1.png')}}" alt="" class="thumb-md rounded-circle mr-2">                                       
                                        <div class="media-body align-self-center">
                                            <h4 class="mt-0 mb-1">Welcome back, {{ucfirst(Auth::user()->name)}}</h4>
                                            <p class="text-muted mb-0 font-14 pr-5">There are many things you can setup and check the performance.</p>
                                        </div><!--end media-body-->
                                    </div><!--end media-->
                                    <div class="welcome-img">
                                        <img src="{{ asset('public/admin/assets/images/widgets/w-2.svg')}}" alt="" height="120" class="mt-n4 mr-5 d-none d-lg-block">    
                                    </div>                                       
                                </div><!--end card-body--> 
                            </div><!--end card-->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card crm-data-card">
                                        <div class="card-body"> 
                                            <div class="row">
                                                <div class="col-4 align-self-center">
                                                    <div class="icon-info">
                                                        <i class="far fa-smile rounded-circle bg-soft-success"></i>
                                                    </div>
                                                </div><!-- end col-->
                                                <div class="col-8 text-right">
                                                    <p class="text-muted font-14">Total Freelancers</p>
                                                    <h3 class="mb-0">{{count($total_users)}}</h3>
                                                </div><!-- end col-->
                                            </div><!-- end row-->                                                                                  
                                        </div><!--end card-body--> 
                                    </div><!--end card-->
                                </div><!--end col-->
                                <div class="col-sm-3">
                                    <div class="card crm-data-card">
                                        <div class="card-body"> 
                                            <div class="row">
                                                <div class="col-4 align-self-center">
                                                    <div class="icon-info">
                                                        <i class="far fa-user rounded-circle bg-soft-pink"></i>
                                                    </div>
                                                </div><!-- end col-->
                                                <div class="col-8 text-right">
                                                    <p class="text-muted font-14">Pending Freelancers</p>
                                                    <h3 class="mb-0">{{count($pending_users)}}</h3>                                            
                                                </div><!-- end col-->
                                            </div><!-- end row-->
                                        </div><!--end card-body--> 
                                    </div><!--end card-->
                                </div><!--end col-->
                                <div class="col-sm-3">
                                    <div class="card crm-data-card">
                                        <div class="card-body"> 
                                            <div class="row">
                                                <div class="col-4 align-self-center">
                                                    <div class="icon-info">
                                                        <i class="far fa-handshake rounded-circle bg-soft-purple"></i>
                                                    </div>
                                                </div><!-- end col-->
                                                <div class="col-8 text-right">
                                                    <p class="text-muted font-14">Total Services</p>
                                                    <h3 class="mb-0">{{count($total_services)}}</h3>                                            
                                                </div><!-- end col-->
                                            </div><!-- end row-->                                                                                     
                                        </div><!--end card-body--> 
                                    </div><!--end card--> 
                                </div><!--end col-->
                                <div class="col-sm-3">
                                    <div class="card crm-data-card">                                        
                                        <div class="card-body"> 
                                            <div class="row">
                                                <div class="col-4 align-self-center">
                                                    <div class="icon-info">
                                                        <i class="far fa-registered rounded-circle bg-soft-warning"></i>
                                                    </div>
                                                </div><!-- end col-->
                                                <div class="col-8 text-right">
                                                    <p class="text-muted font-14">Total Categories</p>
                                                    <h3 class="mb-0">{{count($total_cats)}}</h3>
                                                    
                                                </div><!-- end col-->
                                            </div><!-- end row-->
                                        </div><!--end card-body--> 
                                    </div><!--end card-->
                                </div><!--end col-->
                            </div><!--end row-->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0">Leads and Vendors</h4>
                                    <div id="CrmDashChart" class="flot-chart"></div>                                
                                </div><!--end card-body--> 
                            </div><!--end card-->  
                        </div><!-- end col-->
                    </div><!--end row-->

                    <div class="row">                        
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0">Leads By Country</h4>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div id="world-map-markers" class="crm-dash-map drop-shadow-map"></div>
                                        </div><!--end col-->
                                        <div class="col-lg-4 align-self-center">   
                                         @forelse($groupbycountries as $cont)                           
                                            <div class="">
                                                <span class="text-secondary">{{$cont->country_name}}</span>
                                                <small class="float-right text-muted ml-3 font-13">{{$cont->total}}%</small>
                                                <div class="progress mt-2" style="height:3px;">
                                                    <div class="progress-bar bg-pink" role="progressbar" style="width: {{$cont->total}}%; border-radius:5px;" aria-valuenow="{{$cont->total}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            @empty
                                            @endforelse
       
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                            </div><!--end card-->                            
                        </div><!--end col-->

                                                                          
                    </div><!--end row-->  
                    
                    

                </div><!-- container -->
    
@endsection

@push('js')
     <!-- jQuery  -->
     <script src="{{ asset('public/admin/assets/js/jquery.min.js')}}"></script>
     <script src="{{ asset('public/admin/assets/js/bootstrap.bundle.min.js')}}"></script>
     <script src="{{ asset('public/admin/assets/js/metismenu.min.js')}}"></script>
     <script src="{{ asset('public/admin/assets/js/waves.js')}}"></script>
     <script src="{{ asset('public/admin/assets/js/feather.min.js')}}"></script>
     <script src="{{ asset('public/admin/assets/js/jquery.slimscroll.min.js')}}"></script>
     <script src="{{ asset('public/admin/assets/js/jquery-ui.min.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/moment/moment.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/apexcharts/apexcharts.min.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.canvaswrapper.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.colorhelpers.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.flot.js')}}"></script>        
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.flot.saturated.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.flot.browser.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.flot.drawSeries.js')}}"></script> 
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.flot.uiConstants.js')}}"></script>
     <script src="{{ asset('public/admin/plugins/flot-chart/jquery.flot-dataType.js')}}"></script>
     <script src="{{ asset('public/admin/assets/pages/jquery.crm_dashboard.init.js')}}"></script>

     <!-- App js -->
     <script src="{{ asset('public/admin/assets/js/app.js')}}"></script>
@endpush