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
                <h4 class="page-title">Pending Users</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>

<div class="row">
    <div class="col-12">
        @if(session('successmsg'))<div class="alert alert-success">{{session('successmsg')}}</div>@endif
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Pending Users</h4>
                <p class="text-muted mb-3">
                </p>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->type}}</td>
                        <td>{{$user->created_at}}</td>
                        <td><a title="Edit user information" href="{{route('edit.users',$user->id)}}" class="btn btn-primary"><i class="ti-pencil"></i></a>
                        @if($user->status==1) <a title="Deactivate the user" href="{{route('edit.users.deactive',[$user->id, 0])}}" class="btn btn-danger btn-small"><i class="ti ti-close"></i></a>
                        @else
                        <a title="Activate the user" href="{{route('edit.users.deactive',[$user->id, 1])}}" class="btn btn-primary btn-small"><i class="ti ti-check-box"></i></a>
                        @endif
                        <a title="Admin Approve the user" href="{{route('users.admin.approve',$user->id)}}" class="btn btn-success btn-small"><i class="ti ti-check-box"></i></a>
                        <a title="view user profile" href="{{route('users.details',$user->id)}}" class="btn btn-info btn-small"><i class="ti ti-eye"></i></a>
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
@endpush
