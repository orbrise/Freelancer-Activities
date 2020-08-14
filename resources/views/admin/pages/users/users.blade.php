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
                <h4 class="page-title">All Users</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Add User</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session('successmsg')}} </div> @endif
                <p></p>
            <form method="post" action="{{route('add.users.post')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">user Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                                @if(!empty($errors->first('name'))) <span class="text-danger">{{$errors->first('name')}}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input type="email" name="email" value="{{old('email')}}"  class="form-control" required>
                                @if(!empty($errors->first('email'))) <span class="text-danger">{{$errors->first('email')}}</span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Password</label>
                                <input type="password" name="password" value="{{old('password')}}"  class="form-control" required>
                                @if(!empty($errors->first('password'))) <span class="text-danger">{{$errors->first('password')}}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Confirm Password</label>
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"  class="form-control" id="useremail" required>
                                @if(!empty($errors->first('password_confirmation'))) <span class="text-danger">{{$errors->first('password_confirmation')}}</span> @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Start Date</label>
                                <input type="date" name="start_date" value="{{date('Y-m-d')}}" class="form-control" required>
                                @if(!empty($errors->first('start_date'))) <span class="text-danger">
                                    {{$errors->first('start_date')}}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">End Date</label>
                                <input type="date" name="end_date" value="{{date('Y-m-d')}}" class="form-control" id="useremail" required>
                                @if(!empty($errors->first('end_date'))) <span class="text-danger">
                                    {{$errors->first('end_date')}}</span> @endif
                            </div>
                        </div>
                    </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">User Type</label>
                                <select class="form-control" name="usertype" required="">
                                    <option value="">Select</option>
                                    <option value="user">User</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                @if(!empty($errors->first('usertype'))) <span class="text-danger">{{$errors->first('usertype')}}</span> @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-gradient-primary px-5 py-2">Add User</button>
                            </div>
                        </div>

            </form>
                      
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">All Users</h4>
                <p class="text-muted mb-3">
                </p>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Featured</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->type}}</td>
                        <td>@if(!empty($user->start_date)){{date('d-m-Y', strtotime($user->start_date))}}@endif</td>
                        <td>@if(!empty($user->end_date)){{date('d-m-Y', strtotime($user->end_date))}}@endif</td>
                        <td><input type="checkbox" id="isfeatured" value="{{$user->id}}" @if($user->is_featured == 1) checked="" @endif></td>
                        <td><a title="Edit company information" href="{{route('edit.users',$user->id)}}" class="btn btn-primary"><i class="ti-pencil"></i></a>
                        @if($user->status==1) <a title="Deactivate the company" href="{{route('edit.users.deactive',[$user->id, 0])}}" class="btn btn-danger btn-small"><i class="ti ti-close"></i></a>
                        @else
                        <a title="Activate the company" href="{{route('edit.users.deactive',[$user->id, 1])}}" class="btn btn-primary btn-small"><i class="ti ti-check-box"></i></a>
                        @endif
						<a style="color: white" title="view user profile" target="_blank" href="{{url('profile',[$user->id,str_replace(' ','-',$user->name)])}}"  class="btn btn-info btn-small" ><i class="ti ti-eye"></i></a>
                        
						<a onclick="return confirm('are you sure to delete?')" title="delete user" href="{{route('users.delete',$user->id)}}" class="btn btn-danger btn-small"><i class="ti ti-trash"></i></a>
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
@include('admin.layout.datatable_js')
<script>
$("input#isfeatured").click(function(){
    var id = $(this).val();
    var csrf = $('meta[name="_token"]').attr('content');
    if ($(this).is(":checked")) {
        $.post("{{route('userfeatured')}}",{_token:csrf, id:id, action:'yes'}, function(yes){

        });
        $(this).addCss('color','green');
     } else {
        $.post("{{route('userfeatured')}}",{_token:csrf, id:id, action:'no'}, function(no){
            
        });
     }
});
</script>
@endpush
