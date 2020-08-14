@extends('frontend.layouts.home')

@section('content')
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
<div class="row">
    
    <form method="post" action="{{route('password.change')}}">
        @csrf
        <!-- Dashboard Box -->
        <div class="col-xl-12">
            <div id="test1" class="dashboard-box">

                <!-- Headline -->
                <div class="headline">
                    <h3><i class="icon-material-outline-lock"></i> Password & Security</h3>
                </div>

                <div class="content with-padding">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="submit-field">
                                <h5>Current Password</h5>
                                <input type="password" name="old_password" value="{{old('old_password')}}" class="with-border">
                                @if($errors->has('old_password'))
                                    <span class="text-danger" style="color:red">{{$errors->first('old_password')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="submit-field">
                                <h5>New Password</h5>
                                <input type="password"  name="new_password" value="{{old('new_password')}}" class="with-border">
                                @if($errors->has('new_password'))
                                    <span class="text-danger" style="color:red">{{$errors->first('new_password')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="submit-field">
                                <h5>Repeat New Password</h5>
                                <input type="password" name="confirm_password" value="{{old('confirm_password')}}" class="with-border">
                                @if($errors->has('confirm_password'))
                                    <span class="text-danger" style="color:red">{{$errors->first('confirm_password')}}</span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="col-xl-12">
                            <div class="checkbox">
                                <input type="checkbox" id="two-step" checked>
                                <label for="two-step"><span class="checkbox-icon"></span> Enable Two-Step Verification via Email</label>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <button type="submit" class="button ripple-effect big margin-top-30">Save Changes</button>
        </div>
    </form>
</div>

@endsection
