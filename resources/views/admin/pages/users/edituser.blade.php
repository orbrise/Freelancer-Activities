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
                <h4 class="page-title">Manage Users</h4>
				<a href="{{route('all.users')}}" class="btn btn-primary" style="float: right;margin-top: -25px">Back</a>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Edit User</h4>
                @if(!empty(session('successmsg'))) <div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session('successmsg')}} </div> @endif
                <p></p>
            <form method="post" action="{{route('edit.users.post')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">user Name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}" >
                                @if(!empty($errors->first('name'))) <span class="text-danger">{{$errors->first('name')}}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input type="email" name="email" value="{{$user->email}}"  class="form-control" readonly>
                                @if(!empty($errors->first('email'))) <span class="text-danger">{{$errors->first('email')}}</span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Password</label>
                                <input type="password" name="password" value="{{old('password')}}"  class="form-control" >
                                @if(!empty($errors->first('password'))) <span class="text-danger">{{$errors->first('password')}}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Confirm Password</label>
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"  class="form-control" id="useremail" >
                                @if(!empty($errors->first('password_confirmation'))) <span class="text-danger">{{$errors->first('password_confirmation')}}</span> @endif
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">Start Date</label>
                                <input type="date" name="start_date" value="@if(!empty($user->start_date)){{date('Y-m-d', strtotime($user->start_date))}}@else{{date('Y-m-d')}}@endif" class="form-control" required>
                                @if(!empty($errors->first('start_date'))) <span class="text-danger">
                                    {{$errors->first('start_date')}}</span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">End Date</label>
                                <input type="date" name="end_date" value="@if(!empty($user->end_date)){{date('Y-m-d', strtotime($user->end_date))}}@else{{date('Y-m-d')}}@endif" class="form-control" id="useremail" required>
                                @if(!empty($errors->first('end_date'))) <span class="text-danger">
                                    {{$errors->first('end_date')}}</span> @endif
                            </div>
                        </div>
                    </div>
                        

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="useremail">User Type</label>
                                <select class="form-control" name="usertype">
                                    <option>Select</option>
                                    <option value="user" @if($user->type == 'user') selected @endif>User</option>
                                    <option value="Admin" @if($user->type == 'Admin') selected @endif>Admin</option>
                                </select>
                                @if(!empty($errors->first('usertype'))) <span class="text-danger">{{$errors->first('usertype')}}</span> @endif
                            </div>
                        </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Tagline</h5>
                                        <input type="text" name="tagline" class="form-control" value="@isset($user->userdetail->tagline){{$user->userdetail->tagline}}@endisset">
                                        @if($errors->has('tagline'))
                                        <span class="text-danger" style="color:red">{{$errors->first('tagline')}}</span>
                                        @endif
                                    </div>
                                </div>

                                

                                <div class="col-xl-12">
                                    <div class="submit-field">
                                        <h5>Introduce Yourself</h5>
                                        <textarea cols="30" rows="5" name="about" class="form-control">@isset($user->userdetail->about){{$user->userdetail->about ?? ''}}@endisset</textarea>
                                        @if($errors->has('about'))
                                        <span class="text-danger" style="color:red">{{$errors->first('about')}}</span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                           <div class="row">

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Public Email</h5>
                                        <input type="text" id="pemail" name="contact_email" class="form-control" value="@isset($user->userdetail->contact_email){{$user->userdetail->contact_email}}@endisset">
                                        @if($errors->has('contact_email'))
                                        <span class="text-danger" style="color:red">{{$errors->first('contact_email')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Phone Number</h5>
                                        <input type="text" name="phone" id="pphone" class="form-control" value="@isset($user->userdetail->phone){{$user->userdetail->phone}}@endisset">
                                        @if($errors->has('phone'))
                                        <span class="text-danger" style="color:red">{{$errors->first('phone')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="submit-field">
                                        <h5>Address</h5>
                                        <input type="text" name="address" id="paddress" class="form-control" value="@isset($user->userdetail->address){{$user->userdetail->address}}@endisset">
                                        @if($errors->has('address'))
                                        <span class="text-danger" style="color:red">{{$errors->first('address')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>City</h5>
                                        <input type="text" name="city" id="pcity" class="form-control" value="@isset($user->userdetail->city){{$user->userdetail->city}}@endisset">
                                        @if($errors->has('city'))
                                        <span class="text-danger" style="color:red">{{$errors->first('city')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="submit-field">
                                        <h5>Postal Code</h5>
                                        <input type="text" name="postal_code" id="ppostal" class="form-control" value="@isset($user->userdetail->postal_code){{$user->userdetail->postal_code}}@endisset">
                                        @if($errors->has('postal_code'))
                                        <span class="text-danger" style="color:red">{{$errors->first('postal_code')}}</span>
                                        @endif
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
                                        <input type="text" name="usercustomform[{{$key}}][{{$val->field_name}}]" class="with-border form-control" value="{{$val->getValue->value ?? ''}}">
                                        
                                        @elseif($val->type == 'list')
                                        <select class="selectpicker form-control" name="usercustomform[{{$key}}][{{$val->field_name}}]" >
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

                            <br>
                        <div class="row">
                            <div class="col-sm-12">
                            <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-gradient-primary px-5 py-2">Update User</button>
                            </div>
                        </div>

            </form>
                      
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

</div>
@endsection
@push('js')
@include('admin.layout.datatable_js')
@endpush
