@extends('admin.layout.master')
@section('description', 'Welcome to Admin Control Panel')
@section('title', 'Move Klang Admin Panel')
@push('css')
@include('admin.layout.forms_css')
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            
            <h4 class="page-title">Manage Services</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Edit Service Information</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
            <form method="post" action="{{route('edit.servicepost')}}">
                {{ csrf_field()}}
            <input type="hidden" name="id" value="{{$serviced->id}}">
                <div class="form-group col-lg-12">
                    <div class="col-md-6">
                        <label class="mb-3">Single select</label>
                        <select name="parentcat" id="select2" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                            <option value="0">Select</option>

                            @forelse($cats as $opt)
                        <option value="{{$opt->id}}" @if($serviced->cat_id==$opt->id) selected="selected" @endif>{{$opt->name}}</option>
                            @empty
                            @endforelse

                        </select>
                    </div> <br>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Service Name</label>
                    <input type="text" class="form-control" name="servicename" value="{{$serviced->name}}" placeholder="Enter Category Name">
                    <small class="text-danger">@if($errors->has('category')){{$errors->first('category')}}@endif</small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="servicedesc">Service Description</label>
                        <textarea  class="form-control" name="servicedesc" id="servicedesc" aria-describedby="emailHelp" placeholder="Enter service description">{{$serviced->description}}</textarea> 
                    <small class="text-danger">@if($errors->has('servicename')){{$errors->first('servicename')}}@endif</small>
                    </div>
                    </div>
                    <br>
                    <!-- <div class="col-md-6">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="catimg" id="catimg">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div> -->
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