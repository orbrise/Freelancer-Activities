@extends('admin.layout.master')
@section('description', 'Welcome to Admin Control Panel')
@section('title', 'Admin Panel')
@push('css')
@include('admin.layout.forms_css')
@endpush
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            
            <h4 class="page-title">Manage Service Options</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Add New Options</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
            <form method="post" action="{{ route('add.servicesoption') }}" enctype="multipart/form-data">
                {{ csrf_field()}}
                    <div class="col-md-6">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Option Name</label>
                        <input type="text" class="form-control" name="optionname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter option  Name">
                    <small class="text-danger">@if($errors->has('optionname')){{$errors->first('optionname')}}@endif</small>
                    </div>
                    </div>
                   
                <button type="submit" class="btn btn-gradient-primary">Submit</button>
            </form>                                           
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">All Options</h4>
                <p class="text-muted mb-3">
                </p>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($serviceoptions as $option)
                        <tr>
                        <td>{{$option->name}}</td>
                        <td><a title="Edit option information" href="{{route('edit.serviceoptions',$option->id)}}" class="btn btn-primary"><i class="ti-pencil"></i></a>
                       
                        <a onclick="return confirm('are you sure to delete?')" title="delete option" href="{{route('delete.serviceoption',$option->id)}}" class="btn btn-danger btn-small"><i class="ti ti-trash"></i></a>
                    </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>        
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

</div>

@endsection

@push('js')
@include('admin.layout.forms_js')
@include('admin.layout.datatable_js')
@endpush