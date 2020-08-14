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
            
            <h4 class="page-title">Manage Services</h4>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Add New Service</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{session('successmsg')}} </div> @endif
                <div class="col-md-12">
                <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Default Repeater</h4>
                                    <p class="text-muted mb-3">An interface to add and remove a repeatable group of input elements.</p>

                                    <form method="POST" action="{{route('custom.formspost')}}" class="form-horizontal well">
                                        {{ csrf_field()}}

                                        <fieldset>
                                            <div class="repeater-default">
                                                <div data-repeater-list="customform">
                                                    <div class="form-group mb-0 row">
                                                    <div class="col-sm-12">
                                                        <span data-repeater-create="" class="btn btn-gradient-secondary">
                                                            <span class="fas fa-plus"></span> Add
                                                        </span>
                                                        <input type="submit" value="Submit" class="btn btn-gradient-primary">
                                                    </div><!--end col-->
                                                </div><!--end row-->  

                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">
                                                             
                                                             <div class="col-sm-3">
                                                                <label class="control-label">Label</label>
                                                                <input type="text" name="customform[0][label]"  class="form-control">
                                                            </div><!--end col-->

                                                            <div class="col-sm-3">
                                                                <label class="control-label">Type</label>
                                                                <select name="customform[0][type]" class="form-control">
                                                                    <option value="text" selected="">Text Field</option>
                                                                    <option value="list">List Option</option>
                                                                    <option value="checkbox">Checkbox</option><option value="radio">Radio</option>
                                                                </select>
                                                            </div><!--end col-->
                                                            
                                                            <div class="col-sm-3">
                                                                <label class="control-label">Values</label>
                                                                <textarea name="customform[0][value]" value="Beetle" class="form-control"></textarea>
                                                            </div><!--end col-->
                                                
                                                            <div class="col-sm-1">
                                                                <span data-repeater-delete="" class="btn btn-gradient-danger btn-sm">
                                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                                </span>
                                                            </div><!--end col-->
                                                        </div><!--end row-->
                                                    </div><!--end /div-->
                                            
                                                    
                                                
                                                                                       
                                            </div> <!--end repeter-->                                           
                                        </fieldset><!--end fieldset-->
                                    </form><!--end form-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div>
                </div>
                    
                    
                <button type="submit" class="btn btn-gradient-primary">Submit</button>
            </form>                                           
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->


     <div class="col-md-12">
                <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Manage Fields</h4>
                                   @forelse($forms as $key => $form)
                                    <div class="form-group row d-flex align-items-end">
                                                             
                                                             <div class="col-sm-3">
                                                                <label class="control-label">Label</label>
                                                                <input id="label{{$form->id}}" type="text" value="{{$form->label}}" name="customform[{{$key}}][label]"  class="form-control">
                                                            </div><!--end col-->

                                                            <div class="col-sm-3">
                                                                <label class="control-label">Type</label>
                                                                <select id="type{{$form->id}}" name="customform[{{$key}}][type]" class="form-control">
     <option value="text" @if($form->type == 'text') selected="" @endif>Text Field</option>
      <option value="list" @if($form->type == 'list') selected="" @endif>List Option</option>
 <option value="checkbox" @if($form->type == 'checkbox') selected="" @endif>Checkbox</option>
 <option value="radio" @if($form->type == 'radio') selected="" @endif>Radio</option>
   </select>
                                                            </div><!--end col-->
                                                            
                                                            <div class="col-sm-3">
                                                                <label class="control-label">Values</label>
                                                                <textarea id="values{{$form->id}}" name="customform[{{$key}}][value]" class="form-control">{{$form->fvalues}}</textarea>
                                                            </div><!--end col-->
                                                
                                                            <div class="col-sm-3">
                                                                <button id="save" data="{{$key}}" mark="{{$form->id}}" class="btn btn-success"><i class="fa fa-save"></i></button>
                                                                <a class="btn btn-danger" href="{{route('deletecustom.forms', $form->id)}}" onclick="return confirm('are you sure to delete?')"> <i class="fa fa-trash"></i> </a>
                                                                <div id="res{{$form->id}}"></div>
                                                            </div><!--end col-->
                                                        </div><!--end row-->
                                        @empty
                                        @endforelse
                                    
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div>
                </div>

   

</div>
</div>

@endsection

@push('js')
@include('admin.layout.forms_js')
<script src="{{ asset('public/admin/plugins/repeater/jquery.repeater.min.js')}}"></script>
        <script src="{{ asset('public/admin/assets/pages/jquery.form-repeater.js')}}"></script>

<script>

    $("button#save").click(function(){
        var id = $(this).attr('mark');
        var label = $("#label"+id).val();
        var type = $("#type"+id).val();
        var value = $("#values"+id).val();
        var csrf = $("meta[name='_token']").attr('content');
        if(label == '' || type == '' || value == ''){alert("feilds can not be empty"); return false;}

        $.post("{{route('savecustom.forms')}}",{_token:csrf,id:id,label:label,type:type,value:value}, function(data){
            $("#res"+id).html(data);
        });
    });
</script>
@endpush