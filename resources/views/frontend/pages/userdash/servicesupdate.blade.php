@extends('frontend.layouts.home')

@section('content')
<div class="row">
    @if(!empty(session('successmsg'))) 
     <div class="notification success closeable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
        {{session('successmsg')}} 
    </div> 
    @endif
    @if(!empty(session('errorsmsg'))) 
    <div class="notification error closeable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
        {{session('errorsmsg')}} 
    </div>
    @endif
    <!-- Dashboard Box -->
    
    <div class="col-xl-12">
        <div id="test1" class="dashboard-box">

            <!-- Headline -->
            <div class="headline">
                <h3><i class="icon-material-outline-lock"></i> Services</h3>
            </div>

            <div class="content with-padding">
                @foreach($userServices as $userSer)
                <input type="hidden" name="cat" id="cat{{$userSer->id}}" value="{{$userSer->cat_id}}">
                <input type="hidden" name="cat" id="mservice{{$userSer->id}}" value="{{$userSer->service}}">
                <h4>Service: {{$userSer->servicesDetails->name}}</h4>
                            <div class="clearfix"></div>
                <div class="row">
                    <div class="col-xl-3 price_data">
                        <div class="submit-field">
                            <h5>Price</h5>
                            <input type="text" id="duration{{$userSer->id}}" name="duration" value="@isset($userSer->duration){{$userSer->duration}}@endisset" class="with-border price">
                            @if($errors->has('duration'))
                            <span class="text-danger" style="color:red">{{$errors->first('duration')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 budget_type_data">
                        <div class="submit-field">
                            <h5>Budget Type</h5>
                            <select name="budget_type" id="type{{$userSer->id}}">
                                @forelse($options as $option)
                                <option value="{{$option->name}}" @if($userSer->budget_type == $option->name) selected=""@endif>{{ucfirst($option->name)}}</option>
                                @empty
                                @endforelse
                        
                            </select>
                            
                            @if($errors->has('type'))
                            <span class="text-danger"  style="color:red">{{$errors->first('type')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-xl-3 price_data">
                        <div class="submit-field">
                            <h5>Price</h5>
                            <input type="text" id="price{{$userSer->id}}" name="price" value="@isset($userSer->price){{$userSer->price}}@endisset" class="with-border price">
                            @if($errors->has('price'))
                            <span class="text-danger" style="color:red">{{$errors->first('price')}}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-xl-1">
                        <button type="submit" id="updateuserservice" data="{{$userSer->id}}" class="button ripple-effect big margin-top-30"><i class="icon-feather-save"></i></button>
                    </div>
                    <div class="col-xl-1">
                        <a href="{{route('deleteservices', $userSer->id)}}" onclick="return confirm('are you sure to delete?')" class="button ripple-effect big margin-top-30"><i class="icon-feather-trash"></i></a>
                    </div>
                        
                    
                    <div class="col-xl-1 button ripple-effect big margin-top-30" id="res{{$userSer->id}}"></div>

                    </div>
                    <hr>
                @endforeach
                </div>
            </div>
        </div>

</div>

@endsection
@push('js')
    <script>

        $("button#updateuserservice").click(function(){
        var csrf = $('meta[name="_token"]').attr('content');
        var id = $(this).attr('data');
        var type = $("#type"+id).val();
        var duration = $("#duration"+id).val();
        var price = $("#price"+id).val();
        var cat = $("#cat"+id).val();
        var mservice = $("#mservice"+id).val();
        $.post("{{route('updateservices')}}", {_token:csrf,mservice:mservice,type:type,duration:duration,price:price,catid:cat}, function(data){
            $("div#res"+id).html(data); 
        });
    });

    </script>
@endpush