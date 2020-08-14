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
            
            <h4 class="page-title">App Settings</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">General Setup</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
            <form method="post" action="{{ route('update.settings') }}" enctype="multipart/form-data">
                {{ csrf_field()}}
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">App Name</label>
                        <input type="text" class="form-control" name="appname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter App Name" value="{{$setting->appname}}">
                    <small class="text-danger">@if($errors->has('appname')){{$errors->first('appname')}}@endif</small>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-lg-12">
                            <img src="{{asset('public/assets/images/applogo/')}}/{{$setting->logo}}">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="applogo" id="">
                        <label class="custom-file-label" for="customFile">App logo</label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                        <div class="form-group col-lg-12">
                            <img src="{{asset('public/assets/images/applogo/')}}/{{$setting->favicon}}">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="facicon" id="">
                        <label class="custom-file-label" for="customFile">Favicon</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="catdesc">SEO Description</label>
                        <textarea  class="form-control" name="desc" id="" aria-describedby="emailHelp" placeholder="Enter SEO description">{{$setting->description}}</textarea> 
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="catdesc">SEO Keywords</label>
                        <textarea  class="form-control" name="keywords" id="" aria-describedby="emailHelp" placeholder="Enter SEO Keywords">{{$setting->keywords}}</textarea> 
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