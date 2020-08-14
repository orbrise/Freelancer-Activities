@extends('frontend.layouts.master')

@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Register</h2>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Register</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
    <div class="row">
        <div class="col-xl-5 offset-xl-3">

            <div class="login-register-page">
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3 style="font-size: 26px;">Let's create your account!</h3>
                    <span>Already have an account? <a href="{{route('login')}}">Log In!</a></span>
                </div>

                <!-- Account Type -->
                
                    
                <!-- Form -->
                <form method="post" action="{{ route('register') }}" id="register-account-form">
                    {{csrf_field()}}

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-group"></i>
                        <input type="text" class="input-text with-border" name="name" placeholder="First Name" required/>
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="email" class="input-text with-border" name="email" id="emailaddress-register" placeholder="Email Address" required/>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" id="password-register" placeholder="Password" required/>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password_confirmation" id="password-repeat-register" placeholder="Repeat Password" required/>
                    </div>
                
                <button type="submit" class="button full-width button-sliding-icon ripple-effect margin-top-10">
                    Register <i class="icon-material-outline-arrow-right-alt"></i>
                </button>
                </form>
                <br>
            </div>

        </div>
    </div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
@endsection
