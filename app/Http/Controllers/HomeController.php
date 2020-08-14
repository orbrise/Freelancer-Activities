<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Company;
use Auth;
use App\NewsCategory;
use App\Service;
use App\UserService;
use App\UserDetail;
use App\CustomForm;
use App\UserCustomform;
use App\Country;
use App\ServiceOption;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $userDetail = UserDetail::where('user_id',Auth::user()->id)->first();
        if(empty($userDetail)) { UserDetail::insert(['user_id' =>Auth::user()->id]); }
        $forms = CustomForm::all();
        $countries = Country::all();
        $userforms = UserCustomform::where('user_id', Auth::user()->id)->get();
        
        return view('home',compact('userDetail','forms','userforms','countries'));
    }

    public function Services()
    {
        $allcats = NewsCategory::get();
        $options = ServiceOption::get();
        $userDetail = UserDetail::where('user_id',Auth::user()->id)->first();
        return view('frontend.pages.userdash.services', ['allcats' => $allcats, 'options' => $options, 'userDetail' => $userDetail]);
    }

    public function Links()
    {   $userDetail = UserDetail::where('user_id',Auth::user()->id)->first();
        return view('frontend.pages.userdash.links', compact('userDetail'));
    }

    public function Password()
    {
        $userDetail = UserDetail::where('user_id',Auth::user()->id)->first();
        return view('frontend.pages.userdash.changepassword', compact('userDetail'));
    }

    public function getServices(Request $req)
    {
        $options = ServiceOption::get();
        $services = Service::where('cat_id', $req->cat)->get();
        return view('frontend.pages.userdash.getservicesajax',['services' => $services, 'action' => $req->action,  'catid' => $req->cat, 'serviceid' => $req->serviceid, 'options' => $options]);
    }

    public function allServices()
    {
        $userDetail = UserDetail::where('user_id',Auth::user()->id)->first();
        $userServices = UserService::with('user','userservice')->where('user_id', Auth::user()->id)->get();
        $options = ServiceOption::get();
        return view('frontend.pages.userdash.servicesupdate',compact('userServices','options', 'userDetail'));
    }

    public function saveServices(Request $req)
    {
        $catname = NewsCategory::getCategoryName($req->catid);
        $servicename = Service::getServiceName($req->serviceid);
        //dd($req->serviceform);
        foreach($req->serviceform as $key => $service){
            UserService::updateOrCreate(
        ['user_id' => Auth::user()->id, 'cat_id' => $req->catid, 'service' => $req->serviceid,'duration' => $service['duration'],'budget_type' => 
     $service['type']],
        ['user_id' => Auth::user()->id, 'cat_id' => $req->catid,
        'service' => $req->serviceid, 'duration' => $service['duration'],'budget_type' => 
        $service['type'], 'price' => $service['price'], 'cat_name' => $catname, 'service_name' => $servicename]);
        }

        return redirect()->back()->with('successmsg', 'Successfully updated');
    }

    public function UpdateServices(Request $req)
    {
       
            UserService::updateOrCreate(['user_id' => Auth::user()->id,'cat_id' => $req->catid, 'service' => $req->mservice],
                                ['user_id' => Auth::user()->id, 'cat_id' => $req->catid, 'service' => $req->mservice, 'duration' => $req->duration, 'budget_type' => $req->type, 'price' => $req->price]);

        return '<div class="verified-badge"></div>';
    }

    public function DeleteServices($id)
    {
        if(!empty($id)){
            UserService::where('id', $id)->delete();
        return redirect()->back()->with('successmsg', 'Successfully updated');
        }
       return redirect()->back();
    }    
}
