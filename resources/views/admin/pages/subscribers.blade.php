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
                <h4 class="page-title">All Subscribers</h4>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <p class="text-muted mb-3">
                </p>
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
   
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($subs as $sub)
                        <tr>
                        <td>{{$sub->email}}</td>
                        <td>{{$sub->created_at}}</td>
                        <td>
                        <a onclick="return confirm('are you sure to delete')" title="view user profile" href="{{route('subscribersdelete',$sub->id)}}" class="btn btn-danger btn-small"><i class="ti ti-trash"></i></a>
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
