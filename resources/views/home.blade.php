@extends('frontend.layouts.home')

@section('content')


<div class="row">
    @if(!empty(session('successmsg'))) 
    <div class="notification success closeable">
                <p>{{session('successmsg')}} </p>
                <a class="close"></a>
            </div>
    @endif
    @if(!empty(session('errorsmsg'))) 
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{session('errorsmsg')}} 
        </div>
    @endif
    <form method="post" action="{{route('user.profile')}}" enctype="multipart/form-data">
        @csrf
        <!-- Dashboard Box -->
        <div class="col-xl-12">
            <div class="dashboard-box margin-top-0">
                @if(Auth::user()->admin_approved == 0)
                <div class="notification warning closeable">
                <p>Your account is under moderation, it will be publicly after mannual review by our team.</p>
            </div>
            <br>
            @endif
                <!-- Headline -->
                  <div class="container" style="background-color:#ffe6b4; padding:20px; top-margin:10px; font-size:14px"><span class="icon-feather-alert-octagon">
                
                </span> Hi, <b>{{ucwords(Auth::user()->name)}}</b> your subscription starts from <b>{{date("d-M-Y", strtotime(Auth::user()->start_date))}}</b>
    and end on <b>{{date("d-M-Y", strtotime(Auth::user()->end_date))}}</b></div>
                <div class="headline">
                    <h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
                </div>

                <div class="content with-padding padding-bottom-0">

                    <div class="row">

                        <div class="col-auto">
                            <div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
                               @if(!empty($userDetail->profile_img)) <img class="profile-pic" src="{{asset('public/assets/images/'.$userDetail->profile_img)}}" alt="" /> @else <img class="profile-pic" src="{{asset('public/assets/images/profile.png')}}" alt="" /> @endif
                                <div class="upload-button"></div>
                                <input class="file-upload" type="file" value="" name="profile_img" accept="image/*"/>
                            </div>
                        </div>

                        <div class="col">
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>First Name</h5>
                                        <input type="text" name="name" class="with-border" value="{{Auth::user()->name}}">
                                        @if($errors->has('name'))
                                            <span class="text-danger" style="color:red">{{$errors->first('name')}}<span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Last Name</h5>
                                        <input type="text" name="lastname" class="with-border" value="{{Auth::user()->lastname}}">
                                        @if($errors->has('lastname'))
                                        <span class="text-danger" style="color:red">{{$errors->first('lastname')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="submit-field">
                                        <h5>Email</h5>
                                        <input type="text" name="email" class="with-border" value="{{Auth::user()->email}}">
                                        @if($errors->has('email'))
                                        <span class="text-danger" style="color:red">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Dashboard Box -->
        <div class="col-xl-12">
            <div class="dashboard-box">

                <!-- Headline -->
                <div class="headline">
                    <h3><i class="icon-material-outline-face"></i> My Profile</h3>
                </div>

                <div class="content">
                    <ul class="fields-ul">
                        <li>
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Tagline</h5>
                                        <input type="text" name="tagline" class="with-border" value="@isset($userDetail->tagline){{$userDetail->tagline}}@endisset">
                                        @if($errors->has('tagline'))
                                        <span class="text-danger" style="color:red">{{$errors->first('tagline')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Nationality</h5>
                                        <select class="selectpicker with-border" data-size="7" title="Select Country" data-live-search="true" name="country">
										@isset($countries)
                                           @forelse($countries as $country)
                                            <option @if(!empty($userDetail->country)) @if($country->code == $userDetail->country) selected @endif @endif value="{{$country->code}}">{{$country->name}}</option>
                                            @empty
                                            @endforelse
												@endisset
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="submit-field">
                                        <h5>Introduce Yourself</h5>
                                        <textarea cols="30" rows="5" name="about" class="with-border">@isset($userDetail->about){{$userDetail->about ?? ''}}@endisset</textarea>
                                        @if($errors->has('about'))
                                        <span class="text-danger" style="color:red">{{$errors->first('about')}}</span>
                                        @endif

                                    </div>
                                </div>



                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="dashboard-box">

                <!-- Headline -->
                <div class="headline">
                    <h3><i class="icon-material-outline-face"></i> Personal Information</h3>
                </div>

                <div class="content">
                    <ul class="fields-ul">
                        <li>
                            <div class="row">
                                @forelse($forms as $key => $val)
								
                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>{{ucfirst($val->label)}}</h5>
                                        @if($val->type == 'text')
                                        <input type="text" name="usercustomform[{{$key}}][{{$val->field_name}}]" class="with-border" value="{{$val->getValue->value ?? ''}}">
                                        
                                        @elseif($val->type == 'list')
                                        <select class="selectpicker" name="usercustomform[{{$key}}][{{$val->field_name}}]" >
                                            <option value="">Select</option>
                                            @forelse(explode(",",$val->fvalues) as $option)
         <option value="{{$option}}" @if(!empty($val->getValue->value))@if(trim($option) == trim($val->getValue->value)) selected="" @endif @endif>{{ucfirst($option)}}</option>
                                        @empty
                                        @endforelse
                                        </select>

                                        @elseif($val->type == 'radio')
                                        @forelse(explode(",", $val->fvalues) as $r =>  $rad)
                                        <div class="radio form-check-inline">
										{{$val->getValue->value?? ''}}
                                  <input class="form-check-input" id="radio-{{$r.$rad}}" name="usercustomform[{{$key}}][{{$val->field_name}}]" type="radio" value="{{$rad}}" @if(!empty($val->getValue->value)) @if(trim($rad) == trim($val->getValue->value))checked @endif @endif>
								  <label for="radio-{{$r.$rad}}" class="form-check-label"><span class="radio-label"></span>{{ucfirst($rad)}} </label>
                                  
                                     </div>
                                     <br>
                                     @empty
                                     @endforelse
										 
                                     @elseif($val->type == 'checkbox')
                                     
                                     @forelse(explode(",", $val->fvalues) as $c => $check)
                                     <div class="col-sm-2 checkbox">
                                     <input type="checkbox" name="usercustomform[{{$key}}][{{$val->field_name}}][{{$check}}]" id="chekcbox{{$c.$check}}" value="{{$check}}"
                                     @if(!empty($val->getValue->value)) @if(in_array(trim($check), explode(",",$val->getValue->value))) checked="" 
                                     @endif @endif
                                     >
                                     <label for="chekcbox{{$c.$check}}"><span class="checkbox-icon"></span>{{ucfirst($check)}}</label>
                                     </div>
                                     @empty
                                     @endforelse

                                     @endif
                                    </div>
                                </div>
								
                                @empty
                                @endforelse
								
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-xl-12">
            <div class="dashboard-box">

                <!-- Headline -->
                <div class="headline">
                    <h3><i class="icon-material-outline-face"></i> Contact Information for Public</h3>
                </div>

                <div class="content">
                    <ul class="fields-ul">
                        <li>
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Email</h5>
                                        <input type="text" id="pemail" name="contact_email" class="with-border" value="@isset($userDetail->contact_email){{$userDetail->contact_email}}@endisset">
                                        @if($errors->has('contact_email'))
                                        <span class="text-danger" style="color:red">{{$errors->first('contact_email')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Phone Number</h5>
                                        <input type="text" name="phone" id="pphone" class="with-border" value="@isset($userDetail->phone){{$userDetail->phone}}@endisset">
                                        @if($errors->has('phone'))
                                        <span class="text-danger" style="color:red">{{$errors->first('phone')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="submit-field">
                                        <h5>Address</h5>
                                        <input type="text" name="address" id="paddress" class="with-border" value="@isset($userDetail->address){{$userDetail->address}}@endisset">
                                        @if($errors->has('address'))
                                        <span class="text-danger" style="color:red">{{$errors->first('address')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>City</h5>
                                        <input type="text" name="city" id="pcity" class="with-border" value="@isset($userDetail->city){{$userDetail->city}}@endisset">
                                        @if($errors->has('city'))
                                        <span class="text-danger" style="color:red">{{$errors->first('city')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Postal Code</h5>
                                        <input type="text" name="postal_code" id="ppostal" class="with-border" value="@isset($userDetail->postal_code){{$userDetail->postal_code}}@endisset">
                                        @if($errors->has('postal_code'))
                                        <span class="text-danger" style="color:red">{{$errors->first('postal_code')}}</span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="col-xl-6">
                                    <div class="checkbox">
                <input type="checkbox" id=isadmin >
                <label for="isadmin"><span class="checkbox-icon"></span> Use same info for Admin contact</label>
            </div>
                                </div>



                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<div class="col-xl-12">
            <div class="dashboard-box">

                <!-- Headline -->
                <div class="headline">
                    <h3><i class="icon-material-outline-face"></i> Contact Information for Admin</h3>
                </div>

                <div class="content">
                    <ul class="fields-ul">
                        <li>
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Email</h5>
                                        <input type="text" id="aemail" name="aemail" class="with-border" value="@isset($userDetail->contact_email){{$userDetail->admin_email}}@endisset">
                                        @if($errors->has('contact_email'))
                                        <span class="text-danger" style="color:red">{{$errors->first('contact_email')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Phone Number</h5>
                                        <input type="text" name="aphone" id="aphone" class="with-border" value="@isset($userDetail->phone){{$userDetail->admin_phone}}@endisset">
                                        @if($errors->has('phone'))
                                        <span class="text-danger" style="color:red">{{$errors->first('phone')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="submit-field">
                                        <h5>Address</h5>
                                        <input type="text" name="aaddress" id="aaddress" class="with-border" value="@isset($userDetail->address){{$userDetail->admin_address}}@endisset">
                                        @if($errors->has('address'))
                                        <span class="text-danger" style="color:red">{{$errors->first('address')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>City</h5>
                                        <input type="text" name="acity" id="acity" class="with-border" value="@isset($userDetail->city){{$userDetail->admin_city}}@endisset">
                                        @if($errors->has('city'))
                                        <span class="text-danger" style="color:red">{{$errors->first('city')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Postal Code</h5>
                                        <input type="text" name="apostal" id="apostal" class="with-border" value="@isset($userDetail->postal_code){{$userDetail->admin_zip}}@endisset">
                                        @if($errors->has('postal_code'))
                                        <span class="text-danger" style="color:red">{{$errors->first('postal_code')}}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <button type="submit" class="button ripple-effect big margin-top-30">Save Changes</button>
        </div>
    </form>
</div>

@endsection

@push('js')
<script>
    $("#isadmin").click(function() { 
                    if ($(this).is( 
                      ":checked")) { 
                        var paddress = $("#paddress").val();
                        var pcity = $("#pcity").val();
                        var ppostal = $("#ppostal").val();
                        var pemail = $("#pemail").val();
                        var pphone = $("#pphone").val();

                        var aaddress = $("#aaddress").val(paddress);
                        var acity = $("#acity").val(pcity);
                        var apostal = $("#apostal").val(ppostal);
                        var aemail = $("#aemail").val(pemail);
                        var aphone = $("#aphone").val(pphone);


                    } else { 
                        var aaddress = $("#aaddress").val("");
                        var acity = $("#acity").val("");
                        var apostal = $("#apostal").val("");
                        var aemail = $("#aemail").val("");
                        var aphone = $("#aphone").val("");
                    } 
                });
</script>
@endpush
