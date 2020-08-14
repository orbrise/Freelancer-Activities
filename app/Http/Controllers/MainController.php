<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\NewsCategory;
use App\Alldatauser;
use Auth;
use App\Service;
use App\UserService;
use App\Page;
use App\AppSetting;
use App\Subscriber;
use Validator;
use App\CustomForm;
use App\UserImage;

class MainController extends Controller
{
    public function index()
    {
        $services = Service::get();
        $locations = Alldatauser::where('city', '!=', '')->select('sloc')->groupBy('sloc')->get(); 
        $cats = NewsCategory::orderBy('name')->take(4)->get();
        $user = User::where(['admin_approved' => 1, 'status' => 1, 'is_featured' => 1])->get();
        //dd($user);
    	return view('frontend.pages.homepage',compact('user','cats','services', 'locations'));
    }

    public function login()
    {
    	return view('frontend.pages.login');
    }

    function profilePage($id = '', $username = '')
    {
        if(empty($id) or empty($username)) {return redirect()->back();}
        $user = User::find($id);
        // dd($user);
		$userimages = UserImage::where('user_id',$id)->get();
        $userservices = UserService::select('service')->where('user_id', $id)->groupBy(['service'])->get();
        return view('frontend.pages.profilepage',compact('user','userservices','id','userimages'));
    }

    public function Search(Request $req)
    {	
        $s = ''; $cityandcountry = '';
        $services = Service::get();
        $locations = Alldatauser::where('city', '!=', '')->select('sloc')->groupBy('sloc')->get(); 
        $forms = Alldatauser::where('customvalue', '!=', '')->select('label')->groupBy('label')->get();
        $cats = NewsCategory::orderBy('name')->get();
        $q = Alldatauser::query();
        $q->where(['admin_approved' => 1, 'status' => 1]);
        if(!empty($req->k)){ $q->where(function($query) use ($req){
			
            $query->orWhere('tagline', 'like', "%$req->k%")
                  ->orWhere('name', 'like', "%$req->k%")
                  ->orWhere('about', 'like', "%$req->k%")
                  ->orWhere('address', 'like', "%$req->k%")
                  ->orWhere('city', 'like', "%$req->k%")
                  ->orWhere('country_name', 'like', "%$req->k%")
                  ->orWhere('about', 'like', "%$req->k%")
                  ->orWhere('customvalue', 'like', "%$req->k%")
                  ->orWhere('cat_name', 'like', "%$req->k%")
                  ->orWhere('service_name', 'like', "%$req->k%");
        });}
        if(!empty($req->l)){ 
		$q->whereIn('sloc', $req->l);
		}
        if(!empty($req->c)){$q->whereIn('cat_id', $req->c);}
        if(!empty($req->ucf)){
        foreach($req->ucf as $k => $key){
            foreach ($key as $val){
                $allvalues[] = $val;
            }
        }
        $q->whereIn('customvalue', $allvalues);}
		
        if(!empty($req->s)){$q->where('service',$req->s);}
	        $freelancers = $q->groupBy('id')->paginate(20);
        return view('frontend.pages.search',compact('freelancers','cats','req','s','services','forms','allvalues','locations', 'cityandcountry'));
		
    }

   public function getServicesForSearch(Request $req)
    { if(!empty($req->mcatid)){
        if(!in_array('all',$req->mcatid)){
            $services = Service::whereIN('cat_id',$req->mcatid)->get();
        } else {
            $services = Service::get();
        }
    } else {
        $services = Service::get();
    }
        
        return view('frontend.pages.ajax', compact('services'));
    }

    public function Contact()
    {
        $page = Page::find(1);
        return view('frontend.pages.contact', compact('page'));
    }

    public function PostContact(Request $req)
    {
        $con = Page::find(1);
        $email = $con->email;
        $mail = \Mail::send('mails.contact', ['data' => $req->all()], function ($message) use ($email)
             {
                
                $message->from($email, AppSetting::AppName());
                $message->subject('Congrates You Received an Inquery!');
                $message->to($email);
            });

        return '<div class="notification success closeable">
                <p>Email is successfully delivered to us, we will contact with you by email in a while. Thank you for contacting us!</p>
                <a class="close"></a>
            </div>';
    }

    public function Pagec($slug)
    {
        $page = Page::where('pagename', $slug)->first();
        return view('frontend.pages.termandprivacy', compact('page'));
    }

    public function SubPosst(Request $req)
    {
        $attributes = [
            'email' => 'Email'
        ];
        $validator = Validator::make($req->all() ,[
            'email' => 'required|unique:subscribers,email',

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            if(!empty($validator->errors()->first('email'))){
            return '<span class="notification text-danger closeable">'.$validator->errors()->first('email')."</span>";
            }
        }

        $ins = new Subscriber;
        $ins->email = $req->email;
        if($ins->save()){
            return '<div class="notification success closeable">
                <p>Thank you for subscribe!</p>
                <a class="close"></a>
            </div>';
        }
    }
}
