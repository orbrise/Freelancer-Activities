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
            
            <h4 class="page-title">Privacy Policy</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title"></h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
            <form method="post" action="{{ route('page.privacypost') }}" enctype="multipart/form-data">
                {{ csrf_field()}}
                    <div class="col-md-12">
                        <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Privacy</label>
                        <textarea id="elm1"  class="form-control" name="terms" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" value="{{$privacy->content}}">
                        </textarea>
                    
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
<script src="{{asset('public/admin/plugins/tinymce/tinymce.min.js')}}"></script>
        <script src="{{asset('public/admin/assets/pages/jquery.form-editor.init.js')}}"></script> 
@endpush