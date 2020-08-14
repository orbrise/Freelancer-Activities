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
            
            <h4 class="page-title">Manage News Categories</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Edit Category Information</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
            <form method="post" action="{{ route('news.edit.cat') }}" enctype="multipart/form-data">
                {{ csrf_field()}}
            <input type="hidden" name="id" value="{{$catd->id}}">
                <div class="form-group col-lg-12">
                    <!-- <div class="col-md-6">
                        <label class="mb-3">Single select</label>
                        <select name="parentcat" id="select2" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                            <option value="0">Select</option>

                            @forelse($cats as $opt)
                        <option value="{{$opt->id}}" @if($catd->parent_id==$opt->id) selected="selected" @endif>{{$opt->name}}</option>
                            @empty
                            @endforelse

                        </select>
                    </div> --> <br>
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" name="category" value="{{$catd->name}}" placeholder="Enter Category Name">
                    <small class="text-danger">@if($errors->has('category')){{$errors->first('category')}}@endif</small>
                    </div><br>
                    <div class="col-md-6">
                        <img src="{{asset('public/assets/catimages/')}}/{{$catd->logo}}">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="catimg" id="catimg">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group col-lg-12">
                    <div class="custom-file mb-3">
                        <label class="icon" for="customFile">Choose Icon</label>
                        <input type="text" class="form-control" value="{{$catd->icon}}" name="icon">
                        
                    </div>
                </div>
            </div>
                 <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="catdesc">Category Description</label>
                        <textarea  class="form-control" name="catdesc" id="catdesc" aria-describedby="emailHelp" placeholder="Enter category description">{{$catd->description}}</textarea> 
                    </div>
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