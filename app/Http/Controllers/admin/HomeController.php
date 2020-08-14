<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\NewsCategory;
use Validator;
use Image;
use App\Service;
use App\CustomForm;
use App\User;
use Hash;
use App\ServiceOption;
use App\AppSetting;
use App\Page;
use App\Subscriber;
use App\Alldatauser;
use App\UserDetail;
use App\UserService;
use App\UserCustomform;

class HomeController extends Controller
{
    public function __construct()
    {
            if(!Auth::check()) {
                return redirect()->route('admin.login');
            }


    }

    public function index()
    {
        $total_users = User::where('type','user')->get();
        $pending_users = User::where('admin_approved','0')->get();
        $total_cats = NewsCategory::get();
        $total_services = Service::get();
        $groupbycountries = Alldatauser::groupBy('country_name')->selectRaw('count(*) as total, country_name')->take(5)->get();
        return view('admin.pages.dashboard',compact('total_users','pending_users','total_cats','total_services','groupbycountries'));
    }

    public function CustomLogout()
    {
        if(Auth::logout()){
            return redirect()->route('admin.login');
        }
        return redirect()->route('admin.login');
    }

    public function NewsCat()
    {
        $cats = NewsCategory::where('parent_id', '0')->get();
        return view('admin.pages.news.category',['cats' => $cats]);
    }

    public function addNewsCat(Request $req)
    {
        $attributes = [
            'category' => 'Category',
            'parentcat' => 'Parent Category'
        ];
        $validator = Validator::make($req->only(['category']) ,[
            'category' => 'required|unique:news_categories,name'
        ])->setAttributeNames($attributes);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cat = new NewsCategory;
        $cat->name = $req->category;
        $cat->slug = str_replace(' ','-',$req->category);
        $cat->parent_id = 0;
        $cat->icon = $req->icon;
        $cat->description = $req->catdesc;
        if($req->hasFile('catimg'))
    	{
    		$file = $req->catimg;
    		$ext = $req->file('catimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($file)->fit(48);
                $image->save('public/assets/catimages/'.$newname, 60);
                $cat->logo = $newname;
 
            }
    	}
        if($cat->save()){
            return redirect()->back()->with('successmsg', 'Category has beed addes successfully');
        }
    }

    public function editNewsCat($id = '')
    {
        $cats = NewsCategory::where('parent_id', '0')->get();
        $catd = NewsCategory::find($id);
        return view('admin.pages.news.editcategories',['catd' => $catd, 'cats' => $cats]);
    }

    public function editNewsCatPost(Request $req)
    {
        $attributes = [
            'category' => 'Category',
            'parentcat' => 'Parent Category'
        ];
        $validator = Validator::make($req->only(['category']) ,[
            'category' => 'required'
        ])->setAttributeNames($attributes);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cat = NewsCategory::find($req->id);
        $cat->name = $req->category;
        $cat->slug = str_replace(' ','-',$req->category);
        $cat->parent_id = $req->parentcat;
        $cat->icon = $req->icon;
        $cat->parent_id = 0;
        $cat->description = $req->catdesc;
        if($req->hasFile('catimg'))
    	{
            if(!empty($cat->logo)){
            $file_path = base_path().'/public/assets/catimages/'.$cat->logo;
            if(file_exists($file_path)) {unlink($file_path);}
             }
    		$file = $req->catimg;
    		$ext = $req->file('catimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($file)->fit(48);
                $image->save('public/assets/catimages/'.$newname, 60);
                $cat->logo = $newname;
 
            }
    	}
        if($cat->save()){
            return redirect()->back()->with('successmsg', 'Category has beed updated successfully');
        }
    }

    public function deleteNewsCatPost($id = 0)
    {
        $data =  NewsCategory::find($id);
        if(!empty($data->logo)){
            $file_path = base_path().'/public/assets/catimages/'.$data->logo;
            if(file_exists($file_path)) {unlink($file_path);}
        }
        
        $del = NewsCategory::where('id', $id)->delete();
        return redirect()->back()->with('successmsg', 'Category has beed deleted successfully');
    }

        public function Services()
    {
        $services = Service::get();
         $cats = NewsCategory::where('parent_id', '0')->get();
        return view('admin.pages.services.services',['cats' => $cats, 'services'=>$services]);
    }

       public function ServicesOptions()
    {
        $servicesoptions = ServiceOption::get();
        return view('admin.pages.serviceoptions.create',['serviceoptions'=>$servicesoptions]);
    }

    public function addServicePost(Request $req)
    {
        $attributes = [
            'servicename' => 'Service Name',
            'parentcat' => 'Parent Category'
        ];
        $validator = Validator::make($req->all() ,[
            'servicename' => 'required|unique:services,name',
            'parentcat' => 'required'
        ])->setAttributeNames($attributes);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $service = new Service;
        $service->cat_id = $req->parentcat;
        $service->name = $req->servicename;
        $service->description = $req->servicedesc;
        if($service->save()){
            return redirect()->back()->with('successmsg', 'Service has beed addes successfully');
        }
    }

    public function addServiceoptionPost(Request $req)
    {
        $attributes = [
            'optionname' => 'Option Name',
        ];
        $validator = Validator::make($req->all() ,[
            'optionname' => 'required|unique:service_options,name'
        ])->setAttributeNames($attributes);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceopt = new ServiceOption;
        $serviceopt->name = $req->optionname;
        if($serviceopt->save()){
            return redirect()->back()->with('successmsg', 'option has beed addes successfully');
        }
    }



    public function editServices($id = '')
    {
        $cats = NewsCategory::where('parent_id', '0')->get();
        $serviced = Service::find($id);
        return view('admin.pages.services.editservice',['serviced' => $serviced, 'cats' => $cats]);
    }

    public function editServiceOptions($id = '')
    {
        $options = ServiceOption::find($id);
        return view('admin.pages.serviceoptions.editserviceoptions',['option' => $options]);
    }

    public function editServiceOptionsPost(Request $req)
    {
        
        $serviceopt =ServiceOption::find($req->id);
        $serviceopt->name = $req->optionname;
        if($serviceopt->save()){
            return redirect()->back()->with('successmsg', 'option has beed updated successfully');
        }
    }

    public function editServicePost(Request $req)
    {
        $attributes = [
            'servicename' => 'Service Name',
            'parentcat' => 'Parent Category'
        ];
        $validator = Validator::make($req->all() ,[
            'servicename' => 'required',
            'parentcat' => 'required'
        ])->setAttributeNames($attributes);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $service = Service::find($req->id);
        $service->cat_id = $req->parentcat;
        $service->name = $req->servicename;
        $service->description = $req->servicedesc;
        if($service->save()){
            return redirect()->back()->with('successmsg', 'Service has beed addes successfully');
        }
    }

    public function deleteService($id='')
    {
        $del = Service::where('id', $id)->delete();
        return redirect()->back()->with('successmsg', 'Service has beed deleted successfully');
    }
     public function deleteServiceOption($id='')
    {
        $del = ServiceOption::where('id', $id)->delete();
        return redirect()->back()->with('successmsg', 'Option has beed deleted successfully');
    }

    public function CustomForm()
    {
        $forms = CustomForm::all();
        return view('admin.pages.customform.customform', compact('forms'));
    }

    public function CustomFormPost(Request $req)
    {
        //dd($req->customform);
        foreach($req->customform as $val)
        {
            $data[] = [
                'label' => $val['label'],
                'field_name' => str_replace([" ", "-"], "_", $val['label']),
                'type' => $val['type'],
                'fvalues' => $val['value']
            ];
        }

        if(CustomForm::insert($data)){
            return redirect()->back()->with('successmsg', 'Fields has beed added successfully');
        }
    }

    public function DeleteCustomForm($id='')
    {
        if(CustomForm::where('id', $id)->delete())
        {
            return redirect()->back()->with('successmsg', 'Fields has beed deleted successfully');
        }
    }

    public function SaveCustomForm(Request $req)
    {
        $save = CustomForm::where('id', $req->id)->update(['label' => $req->label, 'field_name' => str_replace([" ", "-"], "_", $req->label), 'type' => $req->type, 'fvalues' => $req->value ]);
        if($save){return '<i class="alert alert-success fa fa-check"></i>';} else {return '<i class="alert alert-danger fa fa-times"></i>';}
    }

    public function AllUsers()
    {
        $users = User::all();
        return view('admin.pages.users.users',compact('users'));
    }

   public function AddUsersPost(Request $req)
    {
        $validator = Validator::make($req->all() ,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'usertype' => ['required'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $req->name;
        $user->email =$req->email;
        $user->password = Hash::make($req->password);
        $user->type = $req->usertype;
        $user->start_date = $req->start_date;
        $user->end_date = $req->end_date;
        if($user->save()):
            $userDetail = UserDetail::where('user_id',$user->id)->first();
            if(empty($userDetail)) { UserDetail::insert(['user_id' => $user->id]); }
        return redirect()->back()->with('successmsg', 'User has beed added successfully');
        endif;
    }

    public function EditUsers($id = '')
    {
        $user=User::find($id);
        $forms = CustomForm::all();
        $userforms = UserCustomform::where('user_id', Auth::user()->id)->get();
        return view('admin.pages.users.edituser',compact('user','forms','userforms'));
    }

   public function EditUsersPost(Request $req)
    {
        $user = User::find($req->id);
        $user->name = $req->name;
        if(!empty($req->password) and !empty($req->password_confirmation)):
        $user->password = Hash::make($req->password);
        endif;
        $user->type = $req->usertype;
        $user->start_date = $req->start_date;
        $user->end_date = $req->end_date;
        if($user->save()):
            //return $req->id;
            $userd = UserDetail::where('user_id', $req->id)->first();
            $userd->tagline = $req->tagline;
            $userd->about = $req->about;
            $userd->contact_email = $req->contact_email;
            $userd->phone = $req->phone;
            $userd->address = $req->address;
            $userd->city = $req->city;
             $userd->postal_code = $req->postal_code;
             $userd->save();

              if(!empty($req->usercustomform)){
                UserCustomform::where('user_id' , Auth::user()->id)->delete();
                 foreach($req->usercustomform as $custf)
            {
            foreach($custf as $col => $v){
                if(is_array($v)){
                    foreach($v as $n){$arraycompost[] = $v;}
                    $v = implode(",",$v);
                } 
                // $newdata[] = array(
                //     'user_id' => Auth::user()->id,
                //     'label' => $col,
                //     'value' =>  $v
                // );
                    
                 UserCustomform::updateOrCreate(
                    ['user_id' => Auth::user()->id,'label' => trim($col), 'value' => trim($v)],
                    ['user_id' => Auth::user()->id,'label' => trim($col), 'value' => trim($v)]);
            }  
        }
    }


        return redirect()->back()->with('successmsg', 'User has beed updated successfully');
        endif;
    }

    public function ADUsers($id, $action)
    {
        if($action == 0) {
            if(User::where('id',$id)->update(['status' => 0])){
                return redirect()->back()->with('successmsg', 'User has beed Deactivate successfully');
            }
        }
        if($action == 1) {
            if(User::where('id',$id)->update(['status' => 1])){
                return redirect()->back()->with('successmsg', 'User has beed Activate successfully');
            }
        }
        if($action == 2) {
            if(User::where('id',$id)->delete()){
                return redirect()->back()->with('successmsg', 'User has beed deleted successfully');
            }
        }
    }

    public function PendingApprovals()
    {
        $users = User::where('admin_approved', 0)->get();
        return view('admin.pages.users.pendingusers',compact('users'));
    }

    public function UserDetails($id)
    {
        $user = User::find($id);
		$userservices = UserService::select('service')->where('user_id', $id)->groupBy(['service'])->get();
        return view('admin.pages.users.userdetails',compact('user','userservices','id'));
    }

    public function UserAdminApprove($id='')
    {
        if(User::where('id', $id)->update(['admin_approved'=>1])){
             return redirect()->back()->with('successmsg', 'User has beed approved successfully');
        }
    }

    public function Userfeatured(Request $req)
    {
        if($req->action == 'yes'){
            User::where('id', $req->id)->update(['is_featured' => 1]);
        } else {
             User::where('id', $req->id)->update(['is_featured' => 0]);
        }
    }

    public function AllSettings()
    {
        $setting = AppSetting::find(1);
        return view('admin.pages.settings',compact('setting'));
    }

    public function updateAppSettings(Request $req)
    {
        
        $app = AppSetting::find(1);
        $app->appname = $req->appname;
$app->description = $req->desc;
$app->keywords = $req->keywords;
        if($req->hasFile('applogo'))
        {
            $file = $req->applogo;
            $ext = $req->file('applogo')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
                $newname = Auth::user()->id.date("His").'1.'.$ext;
                $image = Image::make($file);
                $image->save('public/assets/images/applogo/'.$newname, 60);
                $app->logo = $newname;
 
            }
        }

        if($req->hasFile('facicon'))
        {
            $file1 = $req->facicon;
            $ext1 = $req->file('facicon')->getClientOriginalExtension();
            if($ext1 == 'jpg' or $ext1 == 'png' or $ext1 == 'jpeg')
            {
                $newname1 = Auth::user()->id.date("His").'2.'.$ext;
                $image1 = Image::make($file1)->fit(48);
                $image1->save('public/assets/images/applogo/'.$newname1, 60);
                $app->favicon = $newname1;
 
            }
        }

        if($app->save()){
            return redirect()->back()->with('successmsg', 'Settings has beed Updated successfully');
        }
    }

    public function ContactPage()
    {
        $contact = Page::find(1);
        return view('admin.pages.contact', compact('contact'));
    }

     public function ContactPagePost(Request $req)
    {
        $con = Page::find(1);
        $con->address = $req->address;
        $con->phone = $req->phone;
        $con->email = $req->email;
        $con->map = $req->map;
        if($con->save()){
            return redirect()->back()->with('successmsg', 'page has beed Updated successfully');
        }
    }

    public function TermsPage()
    {
        $term = Page::find(2);
        return view('admin.pages.terms', compact('term'));
    }

     public function TermsPagePost(Request $req)
    {
        $con = Page::find(2);
        $con->content = $req->terms;
        if($con->save()){
            return redirect()->back()->with('successmsg', 'page has beed Updated successfully');
        }
    }

    public function PrivacyPage()
    {
        $privacy = Page::find(3);
        return view('admin.pages.privacy', compact('privacy'));
    }

     public function privacyPagePost(Request $req)
    {
        $con = Page::find(3);
        $con->content = $req->terms;
        if($con->save()){
            return redirect()->back()->with('successmsg', 'page has beed Updated successfully');
        }
    }

    public function Scribers()
    {
        $subs = Subscriber::get();
        return view('admin.pages.subscribers', compact('subs'));
    }

    public function Scribersdelete($id='')
    {
        if(Subscriber::where('id', $id)->delete()){
            return redirect()->back()->with('successmsg', 'subscriber has beed deleted successfully');
        }
    }
	
	public function UserDelete($id)
    {
        if(!empty($id)){
            if(User::where('id', $id)->delete()){
                UserDetail::where('user_id', $id)->delete();
                return redirect()->back()->with('successmsg', 'User has beed deleted successfully');
            }
        } else {
            return redirect()->back()->with('errormsg', 'Error! please try again there is some missing.');
        }
    }
    
   
}
