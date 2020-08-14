@extends('admin.layout.master')
@section('description', 'Welcome to Admin Control Panel')
@section('title', App\AppSetting::AppName())
@push('css')
@include('admin.layout.forms_css')
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            
            <h4 class="page-title">Contact Page Info</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Contact Info</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
            <form method="post" action="{{ route('page.contactpost') }}" enctype="multipart/form-data">
                {{ csrf_field()}}
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" value="{{$contact->address}}">
                    <small class="text-danger">@if($errors->has('address')){{$errors->first('address')}}@endif</small>
                    </div>
                    </div>
            <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{$contact->email}}">
                    <small class="text-danger">@if($errors->has('email')){{$errors->first('email')}}@endif</small>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone" value="{{$contact->phone}}">
                    <small class="text-danger">@if($errors->has('phone')){{$errors->first('phone')}}@endif</small>
                    </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Map</label>
                        <input type="text" class="form-control" name="map" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address or company name" value="{{$contact->map}}">
                    <small class="text-danger">@if($errors->has('map')){{$errors->first('map')}}@endif</small>
                    </div>
                    </div>
            
                    
                <button type="submit" class="btn btn-gradient-primary">Submit</button>
            </form>                                           
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    

</div>
</div>

@endsection

@push('js')
@include('admin.layout.forms_js')
@endpush