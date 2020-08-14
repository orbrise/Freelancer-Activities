@if($action == 'getservices')
<div class="content">
	<div class="container">
		<div class="col-sm-12"><br>
			<form method="post" action="{{route('saveservices')}}">
				{{csrf_field()}}

<fieldset>
                                            <div class="repeater-default">
                                                <div data-repeater-list="serviceform">
                                                    <div class="form-group mb-0 row">
                                                    <div class="col-sm-12">
                                                        <button type="button" data-repeater-create="" class="button dark ripple-effect">
                                                            <i class="icon-feather-plus"></i> Add
                                                        </button>
                                                        <input type="hidden" name="catid" value="{{$catid}}">
                                                       <input type="hidden" name="serviceid" value="{{$serviceid}}">
                                                        <input type="submit" value="Submit" class="button ripple-effect">
                                                    </div><!--end col-->
                                                </div><!--end row-->  

                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex align-items-end">
                                                        <div class="col-sm-3">
                                                         <label class="control-label">Select Hours</label>
                                                                <input type="text" class="form-control" name="serviceform[0][duration]" required="">
                                                                 
                                                            </div><!--end col-->

                                                            <div class="col-sm-3">
                                                                <label class="control-label">Select Type</label>
                                                                <select class="form-control" name="serviceform[0][type]" required>
                                                                    @forelse($options as $option)
                                                                    <option value="{{$option->name}}" selected="">{{$option->name}}</option>
                                                                    @empty
                                                                    @endforelse
                                                                    
                                                                    
                                                                </select>
                                                            </div><!--end col-->

                                                           

                                                            <div class="col-sm-3">
                                                                <label class="control-label">US $</label>
                                                                <input name="serviceform[0][price]"
                                                               class="form-control" required>
                                                            </div><!--end col-->
                                                
                                                            <div class="col-sm-1">

                                                                <span data-repeater-delete="" class="button red ripple-effect ico">
                                                                    <i class="icon-feather-trash-2"></i>
                                                                </span>
                                                            </div><!--end col-->
                                                        </div><!--end row-->
                                                    </div><!--end /div-->
                                            
                                                    
                                                
                                                                                       
                                            </div> <!--end repeter-->                                           
                                        </fieldset><!--end fieldset-->
                                    </div>
                          </div></div>


<script src="{{ asset('public/admin/plugins/repeater/jquery.repeater.min.js')}}"></script>
        <script src="{{ asset('public/admin/assets/pages/jquery.form-repeater.js')}}"></script>
@endif


@if($action == 'getddservices')
                                            <div class="submit-field" >
                                            <h5>Select Services</h5>
                                            <select class=" form-control" id="service" name="service" data-size="7" title="Select Job Type" data-live-search="true" style="display:block!important">
                                                @forelse($services as $service)
                                                <option value="{{$service->id}}">{{$service->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
@endif