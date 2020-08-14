<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Auth;
use App\NewsCategory;
use App\Company;
use App\Location;
use App\NewsPromotion;
use App\BusinessNature;
use App\StaticFunctions;

class CompanyController extends Controller
{
    public function __construct()
    {
            if(!Auth::check()) {
                return redirect()->route('admin.login');
            }
    }

    public function index()
    {
        # code...
    }

    public function CompanyAdd()
    {   
        $locs = Location::where('parent_id', '0')->get();
        $cats = NewsCategory::where('parent_id', '0')->get();
        $btypes = BusinessNature::get();
        return view('admin.pages.company.addcompany', ['cats' => $cats, 'locs' => $locs, 'btypes' => $btypes]);
    }

    public function CompanyAddPost(Request $req)
    {
        $attributes = [
            'companyname' => 'Company Name',
            'email' => 'Email',
            'companyaddress' => 'Company Address',
            'companycontact' => 'Company Contact Number',
            'weblinks' => 'Web Links',
            'categories' => 'Categories',
            'featuredimage' => 'Featured Image',
            'companylogo' => 'Company Logo',
            'businesstype' => 'Business Type'
        ];
        $validator = Validator::make($req->all() ,[
            'companyname' => 'required|unique:companies,company_name',
            'email' => 'required|email|unique:users,email',
            'companyaddress' => 'required',
            'companycontact' => 'required|numeric',
            'categories' => 'required',
            'featuredimage' => 'required',
            'companylogo' => 'required',
            'businesstype' => 'required',

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        
        $com = new Company;
        $com->company_name = $req->companyname;
        $com->slug = str_replace(' ','-',$req->companyname);
        $com->description = $req->description;
        $com->company_address = $req->companyaddress;
        $com->locations = json_encode($req->locations);
        $locationsname = StaticFunctions::arrayToStringLocation($req->locations);
        $com->primary_phone = $req->companycontact;
        $com->company_links = $req->weblinks;
        $com->categories = json_encode($req->categories);
        $categoriesnames = StaticFunctions::arrayToStringCats($req->categories);
        $com->primary_email = $req->email;
        $com->fbmessenger = $req->messenger;
        $com->whatsapp = $req->whatsapp;
        if($req->hasFile('companylogo'))
    	{
    		$file = $req->companylogo;
    		$ext = $req->file('companylogo')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newnamelogo = Auth::user()->id.date("His").'.'.$ext;
                $companylogo = Image::make($file);
                $companylogo->save('public/assets/logos/'.$newnamelogo, 60);
                $com->company_logo = $newnamelogo;
            }
        }
        if($req->hasFile('featuredimage'))
    	{
    		$fimage = $req->featuredimage;
    		$ext = $req->file('featuredimage')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($fimage);
                $image->save('public/assets/featuredimages/'.$newname, 60);
                $com->featured_img = $newname;
 
            }
        }
        $com->type = json_encode($req->businesstype);
        $typesnames = StaticFunctions::arrayToStringTypes($req->businesstype);
        $search = array_merge($typesnames,$categoriesnames, $locationsname);
        $com->search_tags = json_encode($search);
        $com->facebook = $req->fblink;
        $com->twitter = $req->twitter;
        $com->instagram = $req->instagram;
        $com->youtube = $req->youtube;
        $com->linkedin = $req->linkedin;
        $com->pinterest = $req->pintrest;
        $com->thumbler = $req->thumbler;
        $com->googleplus = $req->googleplus;

        if($com->save()){
            return redirect()->back()->with('successmsg', 'Company has been added successfully');
        }
    }

    public function CompanyList()
    {
        $comps = Company::get();
        return view('admin.pages.company.companylist',['comps' => $comps]);
    }

    public function CompanyEdit($id = '')
    {
        $data = Company::where('id', $id)->first();
        $locs = Location::where('parent_id', '0')->get();
        $cats = NewsCategory::where('parent_id', '0')->get();
        $btypes = BusinessNature::get();
        return view('admin.pages.company.companyedit', ['cats' => $cats, 'locs' => $locs, 'data' => $data, 'btypes' => $btypes]);
    }

    public function CompanyEditPost(Request $req)
    {
        $attributes = [
            'companyname' => 'Company Name',
            'email' => 'Email',
            'companyaddress' => 'Company Address',
            'companycontact' => 'Company Contact Number',
            'weblinks' => 'Web Links',
            'categories' => 'Categories',
            'featuredimage' => 'Featured Image',
            'companylogo' => 'Company Logo'
        ];
        $validator = Validator::make($req->all() ,[
            'companyname' => 'required',
            'email' => 'required',
            'companyaddress' => 'required',
            'companycontact' => 'required|numeric',
            'categories' => 'required',
            'locations' => 'required'

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        
        $com = Company::find($req->id);
        $com->company_name = $req->companyname;
        $com->slug = str_replace(' ','-',$req->companyname);
        $com->description = $req->description;
        $com->company_address = $req->companyaddress;
        $com->locations = json_encode($req->locations);
        $locationsname = StaticFunctions::arrayToStringLocation($req->locations);
        $com->primary_phone = $req->companycontact;
        $com->company_links = $req->weblinks;
        $com->categories = json_encode($req->categories);
        $categoriesnames = StaticFunctions::arrayToStringCats($req->categories);
        $com->primary_email = $req->email;
        $com->fbmessenger = $req->messenger;
        $com->whatsapp = $req->whatsapp;
        if($req->hasFile('companylogo'))
    	{
    		$file = $req->companylogo;
    		$ext = $req->file('companylogo')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newnamelogo = Auth::user()->id.date("His").'.'.$ext;
                $companylogo = Image::make($file);
                $companylogo->save('public/assets/logos/'.$newnamelogo, 60);
                $com->company_logo = $newnamelogo;
            }
        }
        if($req->hasFile('featuredimage'))
    	{
    		$fimage = $req->featuredimage;
    		$ext = $req->file('featuredimage')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($fimage);
                $image->save('public/assets/featuredimages/'.$newname, 60);
                $com->featured_img = $newname;
 
            }
        }
        $com->type = $req->businesstype;
        $typesnames = StaticFunctions::arrayToStringTypes($req->businesstype);
        $search = array_merge($typesnames,$categoriesnames, $locationsname);
        $com->search_tags = json_encode($search);
        $com->facebook = $req->fblink;
        $com->twitter = $req->twitter;
        $com->instagram = $req->instagram;
        $com->youtube = $req->youtube;
        $com->linkedin = $req->linkedin;
        $com->pinterest = $req->pintrest;
        $com->thumbler = $req->thumbler;
        $com->googleplus = $req->googleplus;
        if($com->save()){
            return redirect()->back()->with('successmsg', 'Company has been added successfully');
        }
    }

    public function CompanyDeactivate($id = '')
    {
        if(empty($id)) {return redirect()->back();}
        $del = Company::find($id);
        $del->status = 0;
        if($del->save()){
            return redirect()->back()->with('successmsg', 'Company has been Deactivate successfully');
        } 
     }

     public function CompanyAactivate($id = 0)
     {
        if(empty($id)) {return redirect()->back();}
        $del = Company::find($id);
        $del->status = 1;
        if($del->save()){
            return redirect()->back()->with('successmsg', 'Company has been Deactivate successfully');
        } 
     }

     public function getCompanyDetails($id = '')
    {
        $data = Company::where('id', $id)->first();
        $cats = NewsCategory::where('parent_id', '0')->get();
        $news = NewsPromotion::where('company_id', $id)->get();
        return view('admin.pages.company.companynewsdetails', ['data' => $data, 'cats' => $cats, 'news' => $news]);
    }

    public function CompanyAddNewsPost(Request $req)
    {
        $attributes = [
            'title' => 'Title',
            'categories' => 'Categories'
        ];
        $validator = Validator::make($req->all() ,[
            'title' => 'required',
            'categories' => 'required'

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = new NewsPromotion;
        $news->company_id = $req->id;
        $news->title = $req->title;
        $news->description = $req->description;
        $news->categories = $req->categories;
        if($req->hasFile('featuredimg'))
    	{
    		$file = $req->featuredimg;
    		$ext = $req->file('featuredimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newnamelogo = Auth::user()->id.date("His").'.'.$ext;
                $companylogo = Image::make($file);
                $companylogo->save('public/assets/featuredimages/'.$newnamelogo, 60);
                $news->featured_image = $newnamelogo;
            }
        }

        if($news->save())
        {
            return redirect()->back()->with('successmsg', 'News has been Added successfully');
        }
    }

    public function getCompanyDetailsEdit($id = '')
    {
        $details = NewsPromotion::find($id);
        $cats = NewsCategory::where('parent_id', '0')->get();
        return view('admin.pages.company.editnews', ['data' => $details, 'cats' => $cats]);
    }

    public function getCompanyDetailsEditPost(Request $req)
    {
        $attributes = [
            'title' => 'Title',
            'categories' => 'Categories'
        ];
        $validator = Validator::make($req->all() ,[
            'title' => 'required',
            'categories' => 'required'

        ])->setAttributeNames($attributes);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = NewsPromotion::find($req->id);
        $news->title = $req->title;
        $news->description = $req->description;
        $news->categories = $req->categories;
        if($req->hasFile('featuredimg'))
    	{
            $file = $req->featuredimg;
            $file_path = base_path().'/public/assets/featuredimages/'.$req->oldimage;
            if(file_exists($file_path)) {unlink($file_path);}
    		$ext = $req->file('featuredimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newnamelogo = Auth::user()->id.date("His").'.'.$ext;
                $companylogo = Image::make($file);
                $companylogo->save('public/assets/featuredimages/'.$newnamelogo, 60);
                $news->featured_image = $newnamelogo;
            }
        }

        if($news->save())
        {
            return redirect()->back()->with('successmsg', 'News has been Updated successfully');
        }
    }

    public function getCompanyDetailsAdDeactive($id = '')
    {
        if(empty($id)) {return redirect()->back();}
        $del = NewsPromotion::find($id);
        $del->status = 0;
        if($del->save()){
            return redirect()->back()->with('successmsg', 'News/Promotion has been Deactivate successfully');
        } 
    }

    public function getCompanyDetailsAdactive($id = '')
    {
        if(empty($id)) {return redirect()->back();}
        $del = NewsPromotion::find($id);
        $del->status = 1;
        if($del->save()){
            return redirect()->back()->with('successmsg', 'News/Promotion has been Deactivate successfully');
        } 
    }

    public function getCompanyDetailsAddelete($id = '')
    {
        if(empty($id)) {return redirect()->back();}
        $del = NewsPromotion::find($id)->delete();
        if($del){
            return redirect()->back()->with('successmsg', 'News/Promotion has been Deactivate successfully');
        } 
    }
}
