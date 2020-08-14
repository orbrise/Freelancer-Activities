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
                <h4 class="mt-0 header-title">Add New Category</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
            <form method="post" action="{{ route('news.add.cat') }}" enctype="multipart/form-data">
                {{ csrf_field()}}
                <div class="col-md-6">
               <!--  <div class="form-group col-lg-12">
                        <label class="mb-3">Single select</label>
                        <select name="parentcat" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                            <option value="0">Select</option>
                            @forelse($cats as $opt)
                        <option value="{{$opt->id}}">{{$opt->name}}</option>
                            @empty
                            @endforelse

                        </select>
                    </div>  -->
                </div>
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" class="form-control" name="category" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category Name">
                    <small class="text-danger">@if($errors->has('category')){{$errors->first('category')}}@endif</small>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="catimg" id="catimg">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                        <div class="form-group col-lg-12">
                    <div class="custom-file mb-3">
                        <label class="icon" for="customFile">Choose Icon</label>
                        <input type="text" class="form-control" name="icon">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="catdesc">Category Description</label>
                        <textarea  class="form-control" name="catdesc" id="catdesc" aria-describedby="emailHelp" placeholder="Enter category description"></textarea> 
                    </div>
                    </div>
                <button type="submit" class="btn btn-gradient-primary">Submit</button>
            </form>                                           
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    @forelse($cats as $key => $cat)
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                @if(!empty($cat->logo)) <img class="float-left" width="48px" src="{{url('public/assets/catimages')}}/{{$cat->logo}}"> @endif 
            <div class="float-left col-md-8">
                <h4 class="mt-0 header-title"><a class="btn btn-default btn-block" data-toggle="collapse" href="#collapse{{$key}}" role="button" aria-expanded="false" aria-controls="collapse{{$key}}">{{$cat->name}}</a></h4></div>
                
            <div class="float-right"><a href="{{route('edit.news.categories', [$cat->id])}}"><i class="mdi mdi-pencil-outline"></i></a> <a onclick="return confirm('Are you sure to delete? It will delete sub categories as well')" href="{{route('delete.news.categories', [$cat->id])}}"><i class="mdi mdi-trash-can-outline"></i></a>
                
                </div>
                    <div class="clearfix"></div>
                @forelse($cat->subCats as $subcat)
            <div class="col-lg-12 collapse" id="collapse{{$key}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-left"><h4 class="mt-0 header-title">@if(!empty($subcat->logo)) <img width="48px" src="{{url('public/assets/catimages')}}/{{$subcat->logo}}"> @endif {{$subcat->name}}</h4></div>
                            <div class="float-right"><a href="{{route('edit.news.categories', [$subcat->id])}}"><i class="mdi mdi-pencil-outline"></i></a> <a href="{{route('delete.news.categories', [$subcat->id])}}" onclick="return confirm('Are you sure to delete?')"><i class="mdi mdi-trash-can-outline"></i></a></div>
                        </div>
                    </div>
                </div>
                    @empty
                @endforelse
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    @empty
    @endforelse


</div>
</div>

@endsection

@push('js')
@include('admin.layout.forms_js')
@endpush