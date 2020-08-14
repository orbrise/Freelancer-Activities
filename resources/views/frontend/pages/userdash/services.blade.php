@extends('frontend.layouts.home')

@section('content')
<div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box">

                        <!-- Headline -->
                        <div class="headline">
                            <h3><i class="icon-line-awesome-gear"></i> Choose Services</h3>
                        </div>

                        <div class="content">
                            <ul class="fields-ul">
                            <li>
                                <div class="row">
                                   
                                    <div class="col-xl-4">
                                        <div class="submit-field">
                                            <h5>Select Category</h5>
                                            <select class="selectpicker with-border" id="cat" name="cat" data-size="7" title="Select Job Type" data-live-search="true">
                                                @forelse($allcats as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4" id="ddservices">
                                        <div class="submit-field" >
                                            <h5>Select Services</h5>
                                            <select class="selectpicker with-border" id="cat" name="cat" data-size="7" title="Select Job Type" data-live-search="true">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                    <button type="button" class="button ripple-effect big margin-top-30" id="search">Add</button>
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
                            <h3><i class="icon-line-awesome-gear"></i> Select Services</h3>
                        </div>

                        <div class="content">
                            @if(!empty(session('successmsg')))
                                <div class="notification success closeable">
                                <p>{{session('successmsg')}}</p>
                                <a class="close"></a>
                                </div>
                            @endif                            

                            <div id="res"></div>
                         <div id="data"></div>

                               
                        </div>
                    </div>
                </div>
 
                
            </div>

@endsection

@push('js')

@endpush