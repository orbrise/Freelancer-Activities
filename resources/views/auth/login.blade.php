@extends('frontend.layouts.master')

@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Log In</h2>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Log In</li>
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
                    <h3>We're glad to see you again!</h3>
                    <span>Don't have an account? <a href="{{ route('register') }}">Sign Up!</a></span>
                </div>
                    
                <!-- Form -->
                <form method="post" id="login-form" action="{{ route('login') }}">
                    {{csrf_field()}}
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="email" value="{{ old('email') }}" id="emailaddress" placeholder="Email Address" required/>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" required autocomplete="current-password"  id="password" placeholder="Password" required/>
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                     @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                
                </form>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
                
                <br>
            </div>

        </div>
    </div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
@endsection
