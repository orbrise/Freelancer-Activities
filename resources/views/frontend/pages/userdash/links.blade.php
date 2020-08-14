@extends('frontend.layouts.home')

@section('content')
 @if(!empty(session('successmsg'))) 
 <div class="notification success closeable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session('successmsg')}} 
</div> 
@endif
@if(!empty(session('errorsmsg'))) 
<div class="notification error closeable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session('errorsmsg')}} 
</div>
@endif
<div class="row">

<form method="post" action="{{route('social.link')}}">
    @csrf
    <!-- Dashboard Box -->
    <div class="col-xl-12">
        <div class="dashboard-box">

            <!-- Headline -->
            <div class="headline">
                <h3><i class="icon-material-outline-face"></i> Social Links</h3>
            </div>

            <div class="content">
                <ul class="fields-ul">
                    <li>
                        <div class="row">


                            <div class="col-xl-12">
                                <div class="submit-field">
                                    <h5>Website</h5>
                                    <input type="text" name="website" class="with-border" value="@isset($userDetail->website){{$userDetail->website}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Facebook</h5>
                                    <input type="text" name="facebook" class="with-border" value="@isset($userDetail->facebook){{$userDetail->facebook}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Twitter</h5>
                                    <input type="text" name="twitter" class="with-border" value="@isset($userDetail->twitter){{$userDetail->twitter}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Instagram</h5>
                                    <input type="text" name="instagram" class="with-border" value="@isset($userDetail->instagram){{$userDetail->instagram}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Youtube</h5>
                                    <input type="text" name="youtube" class="with-border" value="@isset($userDetail->youtube){{$userDetail->youtube}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Google Plus</h5>
                                    <input type="text" name="google" class="with-border" value="@isset($userDetail->google){{$userDetail->google}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Behance</h5>
                                    <input type="text" name="behance" class="with-border" value="@isset($userDetail->behance){{$userDetail->behance}}@endisset">
                                </div>
                            </div>


                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Dribble</h5>
                                    <input type="text" name="dribble" class="with-border" value="@isset($userDetail->dribble){{$userDetail->dribble}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Github</h5>
                                    <input type="text" name="github" class="with-border" value="@isset($userDetail->github){{$userDetail->github}}@endisset">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="submit-field">
                                    <h5>Linkedin</h5>
                                    <input type="text" name="linkedin" class="with-border" value="@isset($userDetail->linkedin){{$userDetail->linkedin}}@endisset">
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
